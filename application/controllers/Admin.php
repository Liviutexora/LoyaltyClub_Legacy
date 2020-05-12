<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	function __construct() {
			parent::__construct();
			$this -> load -> model('admin_actions');
			$this -> load -> model('users_actions');
			$this -> load -> model('company_actions');
			
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

	public function users() {
		$this->load->view('admin/users/index');
	}

	public function deleteUser(){
		if($this->input->post("id")) {
			$this->users_actions->updateUserDetails(array("deleted" => 1),$this->input->post("id"));
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
		}
	}

	public function editUser() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'name', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'reference', 'rules' => 'required|trim');

			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}

			$reference=$this->users_actions->checkChilds($this->input->post("reference"));
			if(!$reference) {
				exit($this -> load -> view('layouts/error', array('message' => 'The sponsor is invalid'),true));
			}

			$data['nume'] = $this->input->post("name");
			$this->users_actions->updateUserDetails(array("nume" => $this->input->post("name")),$this->uri->segment(2));
			$this->users_actions->updateUserContactDetails(array("sponsor" => $this->input->post("reference")),$this->uri->segment(2));
			
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => site_url("admin/users")));
		} else {
			$data['userDetails'] = $this->users_actions->getUserDetails($this->uri->segment(2));
			$this->load->view('admin/users/partials/editUserModal',$data);
		}
	}

	public function changeUserStatus(){
		if($this->input->post("id")) {
			$this->users_actions->updateUserDetails(array("status" => $this->input->post("userStatus")),$this->input->post("id"));
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
		}
	}

	public function generateUserLegitimation() {
		$userDetails = $this->users_actions->getUserDetails($this->uri->segment(2));
		if(count($userDetails)) {
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			//header
			$pdf->setPrintHeader(false);

			//set margins
			$pdf->SetMargins(5, 5, 5);
			$pdf->SetHeaderMargin(0);
			$pdf->SetFooterMargin(7);

			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			//set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 12);

			// add a page
			$pdf->AddPage();
			$img_file = './assets/img/cards/card.jpg';
			$pdf->Image($img_file, 10, 10, 90, 55, '', '', '', false, 300, '', false, false, 0);		

			$names=explode(' ',$userDetails['nume']);
			$id=(int)$userDetails['id'];
			
			$first_name=$names[0];
			$last_name=isset($names[1])?$names[1]:' ';
			$last_name.=isset($names[2])?$names[2]:'';

			$pdf->MultiCell(59, 5, "Name:", 1, 'L', 1, 0, 25, 34, true);
			$pdf->MultiCell(59, 5, $first_name, 1, 'L', 1, 0, 40, 34, true);
			$pdf->MultiCell(59, 5, $last_name, 1, 'L', 1, 0, 40, 40.8, true);
			$pdf->MultiCell(59, 5, "Client ID:", 1, 'L', 1, 0, 20, 47, true);
			$pdf->MultiCell(59, 5, $id, 1, 'L', 1, 0, 40, 47, true);		

			// reset pointer to the last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			//Close and output PDF document
			$pdf->Output('Loyalty-club-legitimation.pdf', 'I');
		}
	}

	public function usersDataTables() {
		$list = $this->admin_actions->get_users_datatables();
        $data = array();
		$no = $_POST['start'];
	
        foreach ($list as $user) {
            $row = array();
            $row['userName'] = $this->load->view('admin/users/partials/userName',array('user' => $user),true);;
            $row['referrerName'] = $user->referrerName;
            $row['email'] = $user->email;
			$row['phone'] = $user->phone;
			$row['iban'] = $user->iban;
			$row['address'] = $user->address;
			$row['status'] = ($user->status ? $this->load->view('partials/active',array(),true) : $this->load->view('partials/disabled',array(),true) );
			$row['actions'] = $this->load->view('admin/users/partials/actions',array('user' => $user),true);
			$data[] = $row;
        }
   
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin_actions->count_users_all(),
			"recordsFiltered" => $this->admin_actions->count_users_filtered(),
			"data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function companies() {
		$this->load->view('admin/companies/index');
	}

	public function companiesDataTables() {
		$list = $this->admin_actions->get_companies_datatables();
        $data = array();
		$no = $_POST['start'];
	  
        foreach ($list as $user) {
			$row = array();
            $row['companyName'] = $this->load->view('admin/companies/partials/companyName',array('user' => $user),true);;
			$row['userName'] = $user->userName;
			$row['amount'] = number_format($user->amount,2);
            $row['email'] = $user->email;
			$row['phone'] = $user->phone;
			$row['iban'] = $user->iban;
			$row['nr_orc'] = $user->nr_orc;
			$row['cui'] = $user->cui;
			$row['reference'] = $user->reference;
			$row['street'] = $user->street;
			$row['status'] = ($user->status ? $this->load->view('partials/active',array(),true) : $this->load->view('partials/disabled',array(),true) );
			$row['actions'] = $this->load->view('admin/companies/partials/actions',array('user' => $user),true);
			$data[] = $row;
        }
   
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->admin_actions->count_companies_all(),
			"recordsFiltered" => $this->admin_actions->count_companies_filtered(),
			"data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function editCompany() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'name', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'reference', 'rules' => 'required|trim');

			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}

			$reference=$this->users_actions->checkChilds($this->input->post("reference"));
			if(!$reference) {
				exit($this -> load -> view('layouts/error', array('message' => 'The sponsor is invalid'),true));
			}

			$data['nume'] = $this->input->post("name");

			$this->company_actions->updateCompanyDetails(array("nume_firma" => $this->input->post("name"), "sponsor_id" => $this->input->post("reference") ),$this->uri->segment(2)); 
			
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => site_url("admin/companies")));
		} else {
			$data['companyDetails'] = $this->company_actions->getCompanyDetails($this->uri->segment(2));
			$this->load->view('admin/companies/partials/editCompanyModal',$data);
		}
	}


}
