<?php
class Invoices_actions extends CI_model
{
    function generateInvoice($id)
	{
		
			$suma=$this->getInvoiceTotal($id);
			
			if($suma['suma']>0)
			{
				$this->db->query("INSERT INTO `facturi` (`id_firma`,`suma`,`data`) 
								   VALUES(".$id.",'".number_format($suma['suma'],2)."',NOW())");
				$last_id=$this->db->insert_id();
				$this->db->query("UPDATE `tickets` SET `id_factura`=".$last_id." 
								   WHERE `status`=2 AND `id_firma`=".$id." AND `id_factura`=0");
				return $last_id;
				
			} else {
				return false;
			}
	
	}
	
	function getInvoiceTotal($id,$invoiceId=null)
	{
		if(isset($invoiceId) && (int)$invoiceId>0)
			$invoiceId=" AND `id_factura`=".$invoiceId;
		else 
			$invoiceId=" AND `id_factura`=0";
			
		$query="SELECT SUM(`valoare`*`reducere`/100) AS `suma` FROM `tickets` 
				WHERE `status`=2 AND `id_firma`=".$id.$invoiceId;
		$suma=$this->db->query($query)->row_array();
		
	return $suma;	
	}

	function getInvoiceDetails($id) {
		return $this->db->select('*', FALSE)
						   ->where('id_factura', $id)
						   ->get('facturi')->row_array();
    }

	function getInvoiceDetailsByMD5($id) {
		return $this->db->select('*', FALSE)
						   ->where('md5(CONCAT(id_factura,"'.$this->config->item("encryption_key").'")) = "'.$id.'"')
						   ->get('facturi')->row_array();
    }

}
?>