<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {
	function __construct() {
			parent::__construct();
			$this -> load -> model('tickets_actions');
			$this->checkUserLogged();
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(isset($this->current_user['id'])) {
			$this->load->view('index_logged');
		} else {
			$this->load->view('index');
		}
		
	}

	public function tickets() {
		if($this->input->post()) {
			
		
		} else {
			$this->load->view('company/tickets/index');
		}
	}

	public function addTickets() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'nr-of-tickets', 'rules' => 'required|regex_match[/^[0-9]*/]');
			$isDate = $this->is_date($this->input->post( 'date-of-birth'));
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}
			
			$nrOfTickets = $this->input->post('nr-of-tickets');
			if($nrOfTickets > $this->config->item('nrOfTicketsToGenerate')) {
				exit($this -> load -> view('layouts/error', array('message' => str_replace("[nrOfTickests]",$this->config->item('nrOfTicketsToGenerate'),$this->lang->line('Company Section Ticket Label Section Ticket Max Limit Of Tickets On Insert')), "translate" => false),true));
			}

			$this->tickets_actions->generateTickets($nrOfTickets);
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
		} else {
			$this->load->view('company/tickets/partials/addTicketsModal');
		}
	}

	public function deleteTicket() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'id', 'rules' => 'required');
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}
			
			$rez = $this->tickets_actions->checkTicket($this->input->post("id"));
			if(isset($rez['id_firma'])) {
				if($rez['id_firma'] == $this->session->userdata('user')['id']) {
					$this->tickets_actions->deleteTicket($rez['id']);
					$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
					$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
				}
			}

			
		} else {
			$this->load->view('company/tickets/partials/addTicketsModal');
		}
	}
	


	public function generatedTicketsDatables() {
		$list = $this->tickets_actions->get_company_tickets_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ticket) {
            $row = array();
            
            $row['serialNumber'] = $ticket->serialNumber;
            $row['discount'] = $ticket->discount;
            $row['value'] = $ticket->value;
			$row['createdDate'] = date("d-m-Y",strtotime($ticket->createdDate));
			$row['clientID'] = $ticket->clientID;
			$row['status'] = ($ticket->status == 0 ? $this->lang->line("Company Section Ticket Label Section Ticket Status Not Validated") : $this->lang->line("Company Section Ticket Label Section Ticket Status Validated"));
			$row['actions'] = $this->load->view('company/tickets/partials/actions',array('id' => $ticket->id),true);
            $data[] = $row;
          }
   
          $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->tickets_actions->count_company_tickets_all(),
                        "recordsFiltered" => $this->tickets_actions->count_company_tickets_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}
}
