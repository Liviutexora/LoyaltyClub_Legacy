<?php
class Admin_actions extends CI_model
{
    var $table_users = 'user as u';
    var $column_order_users = array(
                                    'u.id',
                                    's.nume',
                                    'u.email',
                                    'u.telefon`',
                                    'iban',
                                    'u.adresa',
                                    'u.status'
                             ); //set column field database for datatable orderable
    var $column_search_users = array(
                                    'u.nume',
                                     's.nume',
                                     'u.email',
                                     'u.telefon`',
                                     'iban',
                                     'u.adresa',
                                     'u.status',
                                    
                               ); //set column field database for datatable searchable 
    var $column_search_type_users = array('where','where','where','where','where','where','where','where'); //set where or having clause for each column
    var $order_users = array('u.id' => 'desc'); // default order 
    
    function _get_datatables_users_query() {
      
		$this->db->select(' u.nume as userName,
						    s.nume as referrerName,
							u.email,
							u.telefon as phone,
							c.iban,
                            u.adresa as address,
                            u.status,
                            u.id
                          '); 
        $this->db->from($this->table_users);
        $this->db->join('contact as c',"u.id = c.id_user","LEFT");
        $this->db->join('user as s',"c.sponsor = s.id","LEFT");
        $i = 0;
       
        foreach ($this->column_search_users as $column_search_key => $item) { // loop column 
             $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
             switch ($item) {
                case 'u.status':
                    switch (strtolower($search_value)) {
                        case 'e':
                        case 'en':
                        case 'ena':
                        case 'enab':
                        case 'enabl':
                        case 'enable':
                        case 'enabled':
                            $search_value = 1;
                        break;

                        case 'd':
                        case 'di':
                        case 'dis':
                        case 'disa':
                        case 'disab':
                        case 'disabl':
                        case 'disable':
                        case 'disabled':
                            $search_value = 0;
                        break;
                    }
                   
                    break;
                default:
                
                break;
              }

           
             
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if(!empty($search_value) || $search_value == 0) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open brackeu. query Where with OR clause better with brackeu. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_users[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_users[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
          $this->users_datatables_where_conditions();
                 
        if(isset($_POST['order'])) {  // here order processing
            $this->db->order_by($this->column_order_users[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)) {
            $order = $this->order_users;
            $this->db->order_by(key($order), $order[key($order)]);
        } 
    }

    function get_users_datatables() {
		$this->_get_datatables_users_query();
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function users_datatables_where_conditions() {
        $this->db->where_in('u.tip',1);
        $this->db->where('u.deleted',0);
    }
 
    function count_users_filtered() {
        $this->_get_datatables_users_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_users_all() {
        $this->db->from($this->table_users);
        $this->users_datatables_where_conditions();
        //$this->db->where('u.id_firma', $this->session->userdata('user')['id']);
        return $this->db->count_all_results();
    }
    
    function _get_datatables_companies_query() {
        $this->amountSql = "(SELECT SUM(`valoare`*`reducere`/100) AS `suma` FROM `tickets` 
        WHERE `status`=2  AND `id_firma`=comp.id_firma and id_factura = 0)";
        $this->table_companies = 'user as u';
        $this->column_order_companies = array(
                'comp.nume_firma',
                'u.nume',
                ''.$this->amountSql.'',
                'u.email',
                'u.telefon`',
                'comp.iban',
                'comp.nr_orc',
                'comp.cui',
                'comp.sponsor_id',
                'comp.street',
                'u.status'
        ); //set column field database for datatable orderable
        $this->column_search_companies = array(
            'comp.nume_firma',
            'u.nume',
            ''.$this->amountSql.'',
            'u.email',
            'u.telefon`',
            'comp.iban',
            'comp.nr_orc',
            'comp.cui',
            'comp.sponsor_id',
            'comp.street',
            'u.status'
            
       ); //set column field database for datatable searchable 
       $this->column_search_type_companies = array('where','where','where','where','where','where','where','where','where','where','where'); //set where or having clause for each column
       $this->order_companies = array('u.id' => 'desc'); // default order 

        $this->db->select(' comp.nume_firma as companyName,
                            u.nume as userName,
                            u.email,
                            '.$this->amountSql.' as amount,
							u.telefon as phone,
							comp.iban,
                            comp.nr_orc,
                            comp.cui,
                            comp.sponsor_id as reference,
                            comp.street,
                            u.status,
                            u.id
                          '); 
        $this->db->from($this->table_companies);
        $this->db->join('firma as comp',"u.id = comp.id_firma","INNER");
        $i = 0;
       
        foreach ($this->column_search_companies as $column_search_key => $item) { // loop column 
             $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
             switch ($item) {
                case 'u.status':
                    switch (strtolower($search_value)) {
                        case 'e':
                        case 'en':
                        case 'ena':
                        case 'enab':
                        case 'enabl':
                        case 'enable':
                        case 'enabled':
                            $search_value = 1;
                        break;

                        case 'd':
                        case 'di':
                        case 'dis':
                        case 'disa':
                        case 'disab':
                        case 'disabl':
                        case 'disable':
                        case 'disabled':
                            $search_value = 0;
                        break;
                    }
                   
                    break;
                default:
                
                break;
              }

           
             
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if(!empty($search_value) || $search_value === 0) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open brackeu. query Where with OR clause better with brackeu. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_companies[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_companies[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
          $this->companies_datatables_where_conditions();
                 
        if(isset($_POST['order'])) {  // here order processing
            $this->db->order_by($this->column_order_companies[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)) {
            $order = $this->order_companies;
            $this->db->order_by(key($order), $order[key($order)]);
        } 
    }

    function get_companies_datatables() {
		$this->_get_datatables_companies_query();
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function companies_datatables_where_conditions() {
        $this->db->where_in('u.tip',2);
        $this->db->where('u.deleted',0);
    }
 
    function count_companies_filtered() {
        $this->_get_datatables_companies_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_companies_all() {
        $this->db->from($this->table_companies);
        $this->companies_datatables_where_conditions();
        //$this->db->where('u.id_firma', $this->session->userdata('user')['id']);
        return $this->db->count_all_results();
    }


    function _get_datatables_pages_query($pagesType = "",$userType = "") {
        $this->table_pages = 'pagini as p';
        $this->column_order_pages = array(
                'p.titlu_eng',
                'p.status'
        ); //set column field database for datatable orderable
        $this->column_search_pages = array(
            'p.titlu_eng',
            'p.status'
            
       ); //set column field database for datatable searchable 
       $this->column_search_type_pages = array('where','where'); //set where or having clause for each column
       $this->order_pages = array('p.id' => 'desc'); // default order 

        $this->db->select(' p.id,
                            p.titlu_eng,
                            p.status
                          '); 
        $this->db->from($this->table_pages);

        $i = 0;
       
        foreach ($this->column_search_pages as $column_search_key => $item) { // loop column 
             $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
             switch ($item) {
                case 'p.status':
                    switch (strtolower($search_value)) {
                        case 'e':
                        case 'en':
                        case 'ena':
                        case 'enab':
                        case 'enabl':
                        case 'enable':
                        case 'enabled':
                            $search_value = 1;
                        break;

                        case 'd':
                        case 'di':
                        case 'dis':
                        case 'disa':
                        case 'disab':
                        case 'disabl':
                        case 'disable':
                        case 'disabled':
                            $search_value = 0;
                        break;
                    }
                   
                    break;
                default:
                
                break;
              }

           
             
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if(!empty($search_value) || $search_value === 0) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open brackeu. query Where with OR clause better with brackeu. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_pages[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_pages[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
          $this->pages_datatables_where_conditions($pagesType,$userType);
                 
        if(isset($_POST['order'])) {  // here order processing
            $this->db->order_by($this->column_order_pages[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)) {
            $order = $this->order_pages;
            $this->db->order_by(key($order), $order[key($order)]);
        } 
    }

    function get_pages_datatables($pagesType = "",$userType = "") {
		$this->_get_datatables_pages_query($pagesType,$userType);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        //echo $this->db->last_query();die();
        return $query->result();
    }

    function pages_datatables_where_conditions($pagesType = "",$userType = "") {
        $this->db->where('p.page_type',$pagesType);
        $this->db->where('p.user_type',$userType);
        $this->db->where('p.deleted',0);
    }
 
    function count_pages_filtered($pagesType = "",$userType = "") {
        $this->_get_datatables_pages_query($pagesType,$userType);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_pages_all($pagesType = "",$userType = "") {
        $this->db->from($this->table_pages);
        $this->pages_datatables_where_conditions($pagesType,$userType);
        //$this->db->where('u.id_firma', $this->session->userdata('user')['id']);
        return $this->db->count_all_results();
    }

    function insertPage($data) {
		$this->db->insert('pagini', $data);
    }
    
    function getPageDetails($id){
		return $this->db->select('*', FALSE)->where('id',$id)->get('pagini')->row_array();
    }

    function updatePageDetails($data,$id) {
		$this->db->where('id', $id);
		$this->db->update('pagini', $data);
    }
    
    function getAllPages($pageType = "",$userType = ""){
		return $this->db->select('*', FALSE)->where('deleted',0)->where('status',1)->where('page_type',$pageType)->where('user_type',$userType)->order_by("titlu_eng","asc")->get('pagini')->result_array();
    }

    function _get_datatables_domains_query() {
        
        $this->table_domains = 'categorii-produse as d';
        $this->column_order_domains = array(
                'd.titlu_eng',
                'd.pozitia',
                'd.status'
        ); //set column field database for datatable orderable
        $this->column_search_domains = array(
            'd.titlu_eng',
            'd.pozitia',
            'd.status'
            
       ); //set column field database for datatable searchable 
       $this->column_search_type_domains = array('where','where','where'); //set where or having clause for each column
       $this->order_domains = array('d.id' => 'desc'); // default order 

        $this->db->select(' d.titlu_eng as domainName,
                            d.pozitia as domainOrder,
                            d.status as domainStatus,
                            d.id
                          '); 
        $this->db->from($this->table_domains);
        $i = 0;
       
        foreach ($this->column_search_domains as $column_search_key => $item) { // loop column 
             $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
             switch ($item) {
                case 'd.status':
                    switch (strtolower($search_value)) {
                        case 'e':
                        case 'en':
                        case 'ena':
                        case 'enab':
                        case 'enabl':
                        case 'enable':
                        case 'enabled':
                            $search_value = 1;
                        break;

                        case 'd':
                        case 'di':
                        case 'dis':
                        case 'disa':
                        case 'disab':
                        case 'disabl':
                        case 'disable':
                        case 'disabled':
                            $search_value = 0;
                        break;
                    }
                   
                    break;
                default:
                
                break;
              }
             
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if(!empty($search_value) || $search_value === 0) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open brackeu. query Where with OR clause better with brackeu. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_domains[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_domains[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
          $this->domains_datatables_where_conditions();

        if(isset($_POST['order'])) {  // here order processing
            $this->db->order_by($this->column_order_domains[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)) {
            $order = $this->order_domains;
           
            $this->db->order_by(key($order), $order[key($order)]);
        } 
    }

    function get_domains_datatables() {
		$this->_get_datatables_domains_query();
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    function domains_datatables_where_conditions() {
        $this->db->where('d.deleted',0);
    }
 
    function count_domains_filtered() {
        $this->_get_datatables_domains_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_domains_all() {
        $this->db->from($this->table_domains);
        $this->domains_datatables_where_conditions();
        return $this->db->count_all_results();
    }

    function insertDomain($data) {
		$this->db->insert('categorii-produse', $data);
    }
    
    function getDomainDetails($id){
		return $this->db->select('*', FALSE)->where('id',$id)->get('categorii-produse')->row_array();
    }

    function updateDomainDetails($data,$id) {
		$this->db->where('id', $id);
		$this->db->update('categorii-produse', $data);
    }
    
    function getDomainByName($domainName, $id = ""){
        $this->db->select('*', FALSE)->where('deleted',0)->where('titlu_eng',$domainName);
        if($id)
            $this->db->where('id !=',$id);
            
        return $this->db->get('categorii-produse')->result_array();
    }

    


}
?>