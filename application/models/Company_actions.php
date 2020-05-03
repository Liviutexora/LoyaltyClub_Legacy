<?php
class Company_actions extends CI_model
{
	function getCompanyDetails($id)
	{
		return $this->db->select('*', FALSE)->where('id_firma',$id)->get('firma')->row_array();
	}
}
?>