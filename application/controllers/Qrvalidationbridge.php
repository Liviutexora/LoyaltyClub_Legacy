<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrvalidationbridge extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('tickets_actions');
		$this->load->model('users_actions');
		$this->load->model('company_actions');
	}

	public function index()
	{
		if(!$this->input->post()) {
			exit('Invalid Request');
		}

		$companyId = $this->input->post('company_id');
		$userId = $this->input->post('user_id');
		$amount = $this->input->post('amount');
		$discount = $this->input->post('discount');

		if($companyId === null || $userId === null || $amount === null || $discount === null || $companyId === '' || $userId === '' || $amount === '' || $discount === '') {
			exit('Missing Required Fields');
		}

		if(!is_numeric($companyId) || !is_numeric($userId) || !is_numeric($amount) || !is_numeric($discount) || (float)$amount <= 0 || (float)$discount < 0) {
			exit('Invalid Payload');
		}

		$companyDetails = $this->company_actions->getCompanyDetails($companyId);
		if(!$companyDetails) {
			exit('Invalid Company');
		}

		$userDetails = $this->users_actions->getUserDetails($userId);
		if(!$userDetails) {
			exit('Invalid User');
		}

		$this->db->trans_begin();

		$generatedTicket = $this->tickets_actions->generateTickets(1, $companyId);
		if(empty($generatedTicket)) {
			$this->db->trans_rollback();
			exit('Ticket Generation Failed');
		}

		$generatedTicketSerial = $generatedTicket[0]['ticket'];
		$ticketDetails = $this->tickets_actions->checkTicketBySerial($generatedTicketSerial);
		if(!$ticketDetails) {
			$this->db->trans_rollback();
			exit('Generated Ticket Not Found');
		}

		$updateData = array(
			'id_user' => $userId,
			'valoare' => (float)$amount,
			'reducere' => (float)$discount,
			'data_valorificare' => date("Y-m-d"),
			'status' => 1
		);
		$this->tickets_actions->updateTicket($updateData, $ticketDetails['id']);

		$updatedTicket = $this->tickets_actions->checkTicket($ticketDetails['id']);
		if(!$updatedTicket || (int)$updatedTicket['status'] !== 1) {
			$this->db->trans_rollback();
			exit('Ticket Populate Failed');
		}

		$this->tickets_actions->validateTicket($updatedTicket, $companyId);
		$validatedTicket = $this->tickets_actions->checkTicket($ticketDetails['id']);
		if(!$validatedTicket || (int)$validatedTicket['status'] !== 2) {
			$this->db->trans_rollback();
			exit('Ticket Validation Failed');
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			exit('Transaction Failed');
		} else {
			$this->db->trans_commit();
		}

		echo "Ticket Validated";
	}
}