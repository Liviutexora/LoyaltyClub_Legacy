<?php
class Company_actions extends CI_model
{
	function getCompanyDetails($id)
	{
		return $this->db->select('s.settings_value as logo,us.id,us.telefon as phone,us.email,us.emailToChange,us.nume as addedBy,c.description,c.google_maps_url,c.locality,c.nume_firma as companyName,c.nr_orc,c.id_firma,c.cui,c.iban,c.banca as bank,c.website,c.sponsor_id,c.street,c.number,c.postal_code', FALSE)
						->join("user us","c.id_firma =us.id", "LEFT")->where('c.id_firma',$id)
						->join("user_settings as s","c.id_firma =s.settings_user_id AND s.settings_name = 'avatar-image'","LEFT")
						->get('firma as c')->row_array();
						
	}

	function updateCompanyDetails($data,$companyId) {
		$this->db->where('id_firma', $companyId);
		$this->db->update('firma', $data);
	}

	function getAllActivities() {
		return $this->db->select('*', FALSE)
						   ->where('status',1)->where('deleted',0)->order_by("pozitia","asc")
						   ->get('categorii-produse')->result_array();
	}

	function getAllCompanyActivities($companyId) {
		return $this->db->select('f_i.*,cp.titlu_eng', FALSE)
						   ->join("categorii-produse as cp","f_i.id_activitate = cp.id")
						   ->where('f_i.id_firma',$companyId)
						   ->get('firma_activitate as f_i')->result_array();
	}

	function getAllCompanyActivitiesGroupByActivity() {
		$this->db->select('c_a.*,c.*', FALSE);
		$this->db->join("categorii-produse as c","c_a.id_activitate =c.id");	
		$this->db->where("c.deleted",0);
		$this->db->where("c.status",1);
		return $this->db->group_by('c.titlu_eng')->get('firma_activitate as c_a')->result_array();
	}

	function getAllCompanies($categoryName, $allRows = false,$offset = 10) {
		$mainActivitySql = "(SELECT cp.titlu_eng from firma_activitate as c_a_m INNER JOIN `categorii-produse` as cp ON c_a_m.id_activitate = cp.id and cp.status = 1 and cp.deleted =0 WHERE c_a_m.main = 1 and c_a_m.id_firma = f.id_firma )";
		$this->db->select(' '.$mainActivitySql.' as mainActivity,f.nume_firma,u.data,us.settings_value as logo,f.id_firma', FALSE);
		$this->db->join("firma_activitate as c_a","c_a.id_firma =f.id_firma");	
		$this->db->join("user as u","f.id_firma =u.id");
		
		$this->db->join("categorii-produse as cp","c_a.id_activitate = cp.id and cp.status = 1 and cp.deleted =0","LEFT");	
		$this->db->join("user_settings as us","f.id_firma =us.settings_user_id AND us.settings_name = 'avatar-image'","LEFT");
		if($categoryName) {
			$parts = explode("-",$categoryName);
			if(count($parts)){
				$this->db->where("cp.id",$parts[0]);
			}
			
		}
		if(!$allRows) {

			$start = 0;
			if($this->input->get('page')) {
				$start = $this->input->get('page')*$offset;
				$start = $start - $offset;
			}
		}
		$this->db->group_by('f.id_firma')->order_by('f.id',"desc");
		if(!$allRows) {
			$this->db->limit($offset,$start);
		}

		$this->db->get('firma as f')->result_array();
		echo $this->db->last_query();die();

	}

	function insertCompanyActivities($activitiesToInsert,$companyId) {
		$this->db->delete('firma_activitate', array('id_firma' => $companyId));
		$this->db->insert_batch('firma_activitate', $activitiesToInsert);
	}

	function insertCompanyCountryZones($companyZonesToInsert,$companyId) {
		$this->db->delete('firma_judete', array('id_firma' => $companyId));
		$rw = $this->db->insert_batch('firma_judete', $companyZonesToInsert);
	}

	function getAllCountries($countryName = "Romania") {
		 $this->db->select('*', FALSE);
		 if($countryName) {
			$this->db->where('name',$countryName);
		 }
						  
		return $this->db->get('countries')->result_array();
	}

	function getAllCountryZones($countryId) {
		$this->db->select('*', FALSE);
		$this->db->where('country_id',$countryId);				 
	    return $this->db->get('country_zones')->result_array();
	}
	
	function getCompanyCountryZones($companyId) {
		$this->db->select('*', FALSE);
		$this->db->where('id_firma',$companyId);				 
	    return $this->db->get('firma_judete')->result_array();
    }
}
?>