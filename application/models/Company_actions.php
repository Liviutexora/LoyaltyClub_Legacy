<?php
class Company_actions extends CI_model
{
	function getCompanyDetails($id)
	{
		return $this->db->select('us.id,us.telefon as phone,us.email,us.emailToChange,us.nume as addedBy,c.locality,c.nume_firma as companyName,c.nr_orc,c.cui,c.iban,c.banca as bank,c.website,c.sponsor_id,c.street,c.number,c.postal_code', FALSE)->join("user us","c.id_firma =us.id", "LEFT")->where('c.id_firma',$id)->get('firma as c')->row_array();
	}

	function updateCompanyDetails($data,$companyId) {
		$this->db->where('id_firma', $companyId);
		$this->db->update('firma', $data);
	}

	function getAllActivities() {
		return $this->db->select('*', FALSE)
						   ->where('status',1)->order_by("pozitia","asc")
						   ->get('categorii-produse')->result_array();
	}

	function getAllCompanyActivities($companyId) {
		return $this->db->select('*', FALSE)
						   ->where('id_firma',$companyId)
						   ->get('firma_activitate')->result_array();
	}

	function insertCompanyActivities($activitiesToInsert,$companyId) {
		$this->db->delete('firma_activitate', array('id_firma' => $companyId));
		$this->db->insert_batch('firma_activitate', $activitiesToInsert);
	}

	function insertCompanyCountryZones($companyZonesToInsert,$companyId) {
		$this->db->delete('firma_judete', array('id_firma' => $companyId));
		$rw = $this->db->insert_batch('firma_judete', $companyZonesToInsert);
	}

	function getAllCountries($countryName = "Norway") {
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