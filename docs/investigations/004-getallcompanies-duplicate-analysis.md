# Analiză: GROUP BY din getAllCompanies() — Duplicare și soluții

**Fișier:** `application/models/Company_actions.php`  
**Metodă:** `Company_actions::getAllCompanies()`  
**Data:** 2026-06-10  

---

## 1. Scopul actual al GROUP BY

**DA** — `GROUP BY f.id_firma` există exclusiv pentru eliminarea duplicatelor produse de INNER JOIN-ul cu `firma_activitate`.

### Mecanismul de duplicare

```sql
FROM firma AS f
INNER JOIN firma_activitate AS c_a ON c_a.id_firma = f.id_firma
```

Tabelul `firma_activitate` conține câte un rând per pereche (companie, activitate). Dacă o companie are N activități, INNER JOIN-ul produce N rânduri pentru acea companie. GROUP BY colapsează toate acele N rânduri înapoi la unul singur.

### Date reale din dump

```
firma_activitate (din fideliza_loyaltyclub_ro.sql):

id_firma=41 → 1 activitate  (id_activitate: 55)
id_firma=42 → 2 activități  (id_activitate: 43, 54)
id_firma=44 → 2 activități  (id_activitate: 62, 57)
id_firma=45 → 2 activități  (id_activitate: 77, 69)
id_firma=46 → 2 activități  (id_activitate: 40, 65)
id_firma=47 → 2 activități  (id_activitate: 40, 60)
```

---

## 2. Câte rânduri apar fără GROUP BY

### Per firmă, în funcție de numărul de activități

| Activități firmă | Rânduri fără GROUP BY | Rânduri cu GROUP BY | Duplicate eliminate |
|---|---|---|---|
| **1** | 1 | 1 | 0 |
| **2** | 2 | 1 | 1 |
| **3** | 3 | 1 | 2 |
| **N** | N | 1 | N − 1 |

### Concret pe datele existente

| id_firma | Companie | Activități | Rânduri fără GROUP BY |
|---|---|---|---|
| 41 | Brysel Beauty Studio | 1 | 1 |
| 42 | Loyalty Club Romania | 2 | 2 |
| 44 | Ava Solutions 4You | 2 | 2 |
| 45 | Pro Caffe Tehnika | 2 | 2 |
| 46 | Auto Tudor SRL | 2 | 2 |
| 47 | Car Wash | 2 | 2 |
| **TOTAL** | | | **11 rânduri** (față de 6) |

### De ce rândurile duplicate sunt identice în SELECT

SELECT-ul conține:

```sql
SELECT
    (correlated subquery WHERE c_a_m.id_firma = f.id_firma) AS mainActivity,
    f.nome_firma,
    u.data,
    us.settings_value AS logo,
    f.id_firma
```

**Nicio coloană nu depinde de `c_a` (firma_activitate).** Toate vin din `f`, `u`, `us`. Subquery-ul `mainActivity` este corelat pe `f.id_firma`, nu pe `c_a.id_activitate`. Astfel, pentru o companie cu 2 activități, ambele rânduri proiectate sunt **identice** în tot ce contează pentru view.

---

## 3. Cele trei variante de deduplicare

---

### Varianta A — GROUP BY extins

**Idee:** adaugă în GROUP BY toate coloanele selectate (în loc să lași coloane non-agregate).

```sql
GROUP BY f.id_firma, f.nome_firma, u.data, us.settings_value, f.id
```

```php
// CodeIgniter
$this->db->group_by('f.id_firma, f.nome_firma, u.data, us.settings_value, f.id');
$this->db->order_by('f.id', 'desc');
```

**Avantaje:**
- Schimbare minimă față de codul actual
- Nu necesită restructurarea query-ului

**Dezavantaje:**
- `us.settings_value` poate fi NULL (LEFT JOIN) → NULL-urile se grupează împreună în MySQL, ceea ce este corect în cazul de față, dar semantica e forțată
- `(subquery) mainActivity` nu poate fi pus în GROUP BY prin alias — este acceptat implicit de MySQL ca scalar subquery fără să apară în GROUP BY, dar comportamentul depinde de versiune
- Schimbă semantica grupării: în loc de „unic per id_firma", devine „unic per combinație de valori" — deși în practică echivalent, este mai fragil
- `f.id` (PK real al tabelului `firma`) trebuie adăugat în GROUP BY pentru ORDER BY — dar nu este în SELECT, ceea ce poate genera avertismente pe unele versiuni

**Rating compatibilitate:** ✅ funcționează pe MySQL 5.7+ / MariaDB

---

### Varianta B — DISTINCT

**Idee:** înlocuiește GROUP BY cu DISTINCT. Rândurile identice în proiecție sunt eliminate automat.

```sql
SELECT DISTINCT
    (subquery) AS mainActivity,
    f.nome_firma, u.data, us.settings_value AS logo,
    f.id_firma, f.id   -- f.id adăugat pentru ORDER BY
FROM firma AS f
INNER JOIN firma_activitate AS c_a ON c_a.id_firma = f.id_firma
...
ORDER BY f.id DESC
-- fără GROUP BY
```

```php
// CodeIgniter
$this->db->distinct();
$this->db->select('(subquery) AS mainActivity, f.nome_firma, u.data,
                   us.settings_value AS logo, f.id_firma, f.id', FALSE);
// ... joins ...
// NU se mai apelează group_by()
$this->db->order_by('f.id', 'desc');
```

**Avantaje:**
- Fără GROUP BY → fără ONLY_FULL_GROUP_BY
- Semantică clară: elimină rânduri identice
- Schimbare mică față de codul actual

**Dezavantaje:**
- `ORDER BY f.id` necesită `f.id` în SELECT — când se folosește DISTINCT, MySQL impune ca ORDER BY să conțină doar coloane din SELECT
- Adăugarea `f.id` în SELECT returnează o coloană în plus în array-ul de rezultate (inofensiv, dar nu este folosit în view)
- Când se filtrează după categorie (`WHERE cp.id = X`), LEFT JOIN devine implicit INNER JOIN — comportamentul este identic cu cel actual, dar necesită verificare

**Condiție critică:** DISTINCT funcționează corect **doar dacă** rândurile duplicate sunt identice pe toate coloanele selectate. Aceasta este garantată deoarece nicio coloană din SELECT nu depinde de `c_a` (firma_activitate).

**Rating compatibilitate:** ✅ funcționează pe MySQL 5.7+ / MariaDB

---

### Varianta C — Subquery pentru firma_activitate (recomandată)

**Idee:** elimină sursa duplicatelor din JOIN înlocuind INNER JOIN firma_activitate cu un subquery care returnează doar `DISTINCT id_firma`. Filtrul de categorie se mută în subquery.

**Fără filtru de categorie:**
```sql
SELECT
    (subquery) AS mainActivity,
    f.nome_firma, u.data, us.settings_value AS logo, f.id_firma
FROM firma AS f
INNER JOIN (
    SELECT DISTINCT id_firma FROM firma_activitate
) AS c_a ON c_a.id_firma = f.id_firma
INNER JOIN user AS u ON f.id_firma = u.id
LEFT JOIN user_settings AS us
    ON f.id_firma = us.settings_user_id
    AND us.settings_name = 'avatar-image'
ORDER BY f.id DESC
-- fără GROUP BY, fără LEFT JOIN categorii-produse în main query
```

**Cu filtru de categorie (`$categoryName` prezent):**
```sql
INNER JOIN (
    SELECT DISTINCT fa.id_firma
    FROM firma_activitate fa
    INNER JOIN `categorii-produse` cp
        ON fa.id_activitate = cp.id
        AND cp.status = 1
        AND cp.deleted = 0
    WHERE cp.id = {id_categorie}
) AS c_a ON c_a.id_firma = f.id_firma
```

```php
// CodeIgniter — necesită raw SQL sau restructurare
// Varianta cu query raw:
if ($categoryName) {
    $parts = explode("-", $categoryName);
    $categoryId = count($parts) ? $parts[0] : 0;
    $joinSql = "(SELECT DISTINCT fa.id_firma FROM firma_activitate fa
                 INNER JOIN `categorii-produse` cp
                     ON fa.id_activitate = cp.id AND cp.status=1 AND cp.deleted=0
                 WHERE cp.id = " . (int)$categoryId . ")";
} else {
    $joinSql = "(SELECT DISTINCT id_firma FROM firma_activitate)";
}
$this->db->join($joinSql . " AS c_a", "c_a.id_firma = f.id_firma", "INNER", FALSE);
// fără LEFT JOIN categorii-produse
// fără group_by
$this->db->order_by('f.id', 'desc');
```

**Avantaje:**
- Elimină duplicatele la sursă — înainte de JOIN
- Nu necesită GROUP BY → zero ONLY_FULL_GROUP_BY
- ORDER BY `f.id` funcționează fără restricții
- Semantică corectă și explicită
- Elimină LEFT JOIN `categorii-produse` din main query (reduce complexitatea)
- Se poate folosi `(int)$categoryId` pentru sanitizare directă (securitate)

**Dezavantaje:**
- Necesită restructurare mai semnificativă a query-ului
- CodeIgniter Query Builder nu suportă nativ subqueries în FROM/JOIN — necesită string raw sau `$this->db->query()` cu parametri

**Rating compatibilitate:** ✅ funcționează pe orice MySQL/MariaDB

---

## 4. Comparație finală

| Criteriu | A: GROUP BY extins | B: DISTINCT | C: Subquery (rec.) |
|---|---|---|---|
| Modificare cod | minimă | mică | medie |
| Elimină ONLY_FULL_GROUP_BY | ✅ | ✅ | ✅ |
| Semantică corectă | ⚠️ forțată | ✅ | ✅ |
| ORDER BY `f.id` corect | ⚠️ necesită f.id în GROUP BY | ⚠️ necesită f.id în SELECT | ✅ fără modificare |
| Compatibilitate MySQL 5.6 | ✅ | ✅ | ✅ |
| Compatibilitate MySQL 5.7+ | ✅ | ✅ | ✅ |
| Risc de regresie | scăzut | scăzut | scăzut |
| Claritate intenție | ❌ ascunsă | ✅ | ✅ |

---

## 5. Recomandare

**Varianta C — Subquery pentru firma_activitate** este soluția cu cel mai mic risc de regresie pe termen lung și cea mai corectă semantic:
- Elimină sursa problemei (JOIN care multiplică rânduri), nu simptomul (GROUP BY ineficient)
- Nu modifică outputul final al metodei față de comportamentul actual corect
- Nu introduce nicio ambiguitate în GROUP BY sau DISTINCT

**Alternativă cu modificare minimă:** Varianta B (DISTINCT) dacă se dorește o schimbare rapidă — necesită doar:
1. `$this->db->distinct()`
2. Adăugarea `f.id` în SELECT
3. Eliminarea `$this->db->group_by(...)`

Ambele variante produc același rezultat final în view: 1 rând per companie, cu toate cele 5 câmpuri necesare (`id_firma`, `nome_firma`, `data`, `logo`, `mainActivity`).
