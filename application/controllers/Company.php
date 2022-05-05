<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {
	function __construct() {
			parent::__construct();
			$this -> load -> model('tickets_actions');
			$this -> load -> model('company_actions');
			$this -> load -> model('users_actions');
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
	
	public function payments() {
		$this->load->view('company/payments/index');
	}
	
	public function invoices() {
		$this->load->view('company/invoices/index');
	}
	
	public function archives() {
		$this->load->view('company/archive/index');
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

			$ticketsGenerated = $this->tickets_actions->generateTickets($nrOfTickets);
			$pdfUrl = $this->generateTicketsPdf($ticketsGenerated) ;
			
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('company/tickets/partials/pdfTickets/downloadTickets', array('pdfUrl' => $pdfUrl));
			//$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
		} else {
			$this->load->view('company/tickets/partials/addTicketsModal');
		}
	}

	public function generateTicketsPdf($ticketsData = array()) {
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
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

		//set some language-dependent strings
		//$pdf->setLanguageArray($l);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 10);

		// add a page
		$pdf->AddPage();
		$content = $this->load->view("company/tickets/partials/pdfTickets/pdfTickets",array("tickets" => $ticketsData),true);
		// output the HTML content
		$pdf->writeHTML($content, true, false, true, false, '');
		// reset pointer to the last page
		$pdf->lastPage();

		// add a page
		$pdf->AddPage();

		$content = $this->load->view("company/tickets/partials/pdfTickets/listOfTickets",array("tickets" => $ticketsData),true);

		$pdf->writeHTML($content, true, false, true, false, '');
		// reset pointer to the last page
		$pdf->lastPage();

		if (!file_exists('./downloands')) {
            mkdir('./downloands', 0777, true);
		}
		$folderName = $this->session->userdata('user')['id'].md5(time());
		$folderName = substr($folderName, 0, 10);
		if (!file_exists('./downloands/'.$folderName.'')) {
            mkdir('./downloands/'.$folderName.'', 0777, true);
		}
		$fileName = 'ticketsReport'.$this->session->userdata('user')['id'].'.pdf';
		$path = '/downloands/'.$folderName.'/';
		$pdf->Output(".".$path.$fileName, 'F');

		return site_url($path.$fileName);
	}

	public function downloadTickets() {
		$tickets = $this->tickets_actions->downloadTickets();
		$ticketsPdfUrl = $this->generateTicketsPdf($tickets);
		echo $ticketsPdfUrl;
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

	public function validateTicket() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'id', 'rules' => 'required');
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}
			
			$rez = $this->tickets_actions->checkTicket($this->input->post("id"));
			if($rez) {
				if($rez['id_firma'] == $this->session->userdata('user')['id'] && $rez['status'] == 1) {
					$rez = $this->tickets_actions->validateTicket($rez);
					$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
					$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
				}
			}

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
	
			switch ($ticket->status) {
				case 0:
					$status = "<span class='ticketStatusSpanNotUsed'>".$this->lang->line("Company Section Ticket Label Section Ticket Status Not Used")."</span>";
					break;
				case 1:
					$status = "<span class='ticketStatusSpanUsed'>".$this->lang->line("Company Section Ticket Label Section Ticket Status Used")."</span>";
					break;
				default:
					$status = "<span class='ticketStatusSpanValidated'>".$this->lang->line("Company Section Ticket Label Section Ticket Status Validated")."</span>";
				break;
			}
			$row['status'] = $status;
			$row['actions'] = $this->load->view('company/tickets/partials/actions',array('ticket' => $ticket),true);
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

	public function myProfile() {

		$rez = $this->users_actions->getUserSettings('cover-image',$this->current_user['id']);
		$coverImage = "";
		if(isset($rez['settings_value']) && $rez['settings_value']){
			$coverImage = site_url('/uploads/companies/'.$this->current_user['id'].'/cover-image/'.$rez['settings_value']);
		}

		$rez = $this->users_actions->getUserSettings('avatar-image',$this->current_user['id']);
		$avatarImage = "";
		if(isset($rez['settings_value']) && $rez['settings_value']){
			$avatarImage = site_url('/uploads/companies/'.$this->current_user['id'].'/avatar-image/'.$rez['settings_value']);
		}
		$data = array('coverImage' => $coverImage,'avatarImage' => $avatarImage);

		$data['companyDetails'] = $this->company_actions->getCompanyDetails($this->current_user['id']);
		$this->load->view('company/my-profile/index',$data);
	}

	public function companyDetails() {

		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'companyName', 'rules' => 'required');
			$validation[] =  array('field' => 'main-activity-domain', 'rules' => 'required');
			$validation[] =  array('field' => 'district[]', 'rules' => 'required');
			$validation[] =  array('field' => 'locality', 'rules' => 'required');
			$validation[] =  array('field' => 'description', 'rules' => 'required');
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}

			$postData = $this->input->post();
			$companyData = array();
			$companyData['nume_firma'] = $postData['companyName'];
			$companyData['cui'] = $postData['cui'];
			$companyData['nr_orc'] = $postData['nr_orc'];
			$companyData['iban'] = $postData['iban'];
			$companyData['banca'] = $postData['bank'];
			$companyData['website'] = $postData['website'];
			$companyData['country'] = $postData['country'];
			$companyData['locality'] = $postData['locality'];
			$companyData['street'] = $postData['street'];
			$companyData['number'] = $postData['number'];
			$companyData['google_maps_url'] = $postData['google_maps_url'];
			$companyData['description'] = $postData['description'];
			$companyData['postal_code'] = $postData['postal_code'];
			$this->company_actions->updateCompanyDetails($companyData,$this->current_user['id']);
			$userData = array();
			$userData['telefon'] = $postData['phone'];
			$this->users_actions->updateUserDetails($userData,$this->current_user['id']);
			$activitiesToInsert = array();
			$activitiesSelected = $postData['activity-domain'];
			$mainActivityDomain = $postData['main-activity-domain'];
			
			$isPresentMainActivityId = false;
			foreach ($activitiesSelected as $activityId) {
				if($mainActivityDomain == $activityId)
					$isPresentMainActivityId = true;
				$activitiesToInsert[] = array("id_firma" => $this->current_user['id'], "id_activitate" => $activityId, "main" => $isPresentMainActivityId);
			}

			if(!$isPresentMainActivityId)
				$activitiesToInsert[] = array("id_firma" => $this->current_user['id'], "id_activitate" => $mainActivityDomain, "main" => 1);
			$this->company_actions->insertCompanyActivities($activitiesToInsert,$this->current_user['id']);
			
			$companyContryZonesToInsert = array();
			$companyContryZonesSelected = $postData['district'];
			foreach ($companyContryZonesSelected as $zoneId) {
				$companyContryZonesToInsert[] = array("id_firma" => $this->current_user['id'], "judet" => $zoneId);
			}
			
			$this->company_actions->insertCompanyCountryZones($companyContryZonesToInsert,$this->current_user['id']);
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
			
		} else {
			$allCompanyActivities = $this->company_actions->getAllCompanyActivities($this->current_user['id']);
			$companyActivitiesIds = array();
			$mainActivityDomain = 0;
			foreach ($allCompanyActivities as $activity) {
				if($activity['main']) 
					$mainActivityDomain = $activity['id_activitate'];
				else
					array_push($companyActivitiesIds,$activity['id_activitate']);
			}
			$data['companyActivitiesIds'] = $companyActivitiesIds;
		
			$data['allActivities'] = $this->company_actions->getAllActivities();
			$getAllCountries =  $this->company_actions->getAllCountries();
			$data['getAllCountries'] = $getAllCountries;
			$data['mainActivityDomain'] = $mainActivityDomain;
			
			$data['getAllCountryZones'] = $this->company_actions->getAllCountryZones($getAllCountries[0]['id']);
			$data['companyDetails'] = $this->company_actions->getCompanyDetails($this->current_user['id']);
			$companyCountryZones = $this->company_actions->getCompanyCountryZones($this->current_user['id']);
			$companyCountryZonesIds = array();
			foreach ($companyCountryZones as $zone) {
				array_push($companyCountryZonesIds,$zone['judet']);
			}
			
			$data['companyCountryZonesIds'] = $companyCountryZonesIds;
			$this->load->view('company/company-details/index',$data);
		}
	}



	public function changeCoverImage() {

		if (!file_exists('./uploads/companies/'.$this->current_user['id'].'')) {
            mkdir('./uploads/companies/'.$this->current_user['id'].'', 0777, true);
		}
		if (!file_exists('./uploads/companies/'.$this->current_user['id'].'/cover-image')) {
            mkdir('./uploads/companies/'.$this->current_user['id'].'/cover-image', 0777, true);
		}

		$config['upload_path']          = './uploads/companies/'.$this->current_user['id'].'/cover-image';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']     = '10240';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('upload-cover-image'))
		{	
				$this->session->set_flashdata('errors',$this->upload->display_errors());
				redirect(site_url("my-profile"));
		}
		else
		{
				$upload_data =  $this->upload->data();
				$rez = $this->users_actions->getUserSettings('cover-image',$this->current_user['id']);
	
				if(isset($rez['settings_value']) && $rez['settings_value']){
					unlink('./uploads/comapnies/'.$this->current_user['id'].'/cover-image/'.$rez['settings_value']);
					$this->users_actions->updateUserSettings('cover-image',$upload_data['file_name'],$this->current_user['id']);
				}
				elseif(!isset($rez['settings_value'])){
					$this->users_actions->insertUserSettings(array("settings_name" => "cover-image","settings_value" => $upload_data['file_name'],"settings_user_id" => $this->current_user['id'] ));
					
				}
				redirect(site_url("company/my-profile"));
		}
	}

	public function changeAvatarImage() {
		
		if (!file_exists('./uploads/companies/'.$this->current_user['id'].'')) {
            mkdir('./uploads/comapnies/'.$this->current_user['id'].'', 0777, true);
		}
		if (!file_exists('./uploads/companies/'.$this->current_user['id'].'/avatar-image')) {
            mkdir('./uploads/companies/'.$this->current_user['id'].'/avatar-image', 0777, true);
		}

		$config['upload_path']          = './uploads/companies/'.$this->current_user['id'].'/avatar-image';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']     = '10240';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('upload-avatar-image'))
		{	
				$this->session->set_flashdata('errors',$this->upload->display_errors());
				redirect(site_url("my-profile"));
		}
		else
		{
				$upload_data =  $this->upload->data();
				$rez = $this->users_actions->getUserSettings('avatar-image',$this->current_user['id']);
	
				if(isset($rez['settings_value']) && $rez['settings_value']){
					unlink('./uploads/companies/'.$this->current_user['id'].'/avatar-image/'.$rez['avatar-image']);
					$this->users_actions->updateUserSettings('avatar-image',$upload_data['file_name'],$this->current_user['id']);
				}
				elseif(!isset($rez['settings_value'])){
					$this->users_actions->insertUserSettings(array("settings_name" => "avatar-image","settings_value" => $upload_data['file_name'],"settings_user_id" => $this->current_user['id'] ));
					
				}
				redirect(site_url("company/my-profile"));
		}
	}

	public function editProfileInfo () {

		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'name', 'rules' => 'trim|required');
			$validation[] =  array('field' => 'address', 'rules' => 'trim|required');
			$validation[] =  array('field' => 'date-of-birth', 'rules' => 'required');
			$validation[] =  array('field' => 'phone', 'rules' => 'required|regex_match[/^[0-9]*/]');
			$isDate = $this->is_date($this->input->post( 'date-of-birth'));
			if(!$isDate){
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}
			$bday = new DateTime(date("d-m-Y",strtotime($this->input->post('date-of-birth')))); // Your date of birth
			$today = new Datetime(date('d-m-Y'));
			$diff = $today->diff($bday);

			if($diff->y < 18) {
				exit($this -> load -> view('layouts/error', array('message' => 'User Section Profile Label You should have 18 years old'),true));
			}

			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}

			$data = array('nume' => $this->input->post('name'),'adresa' => $this->input->post('address'),'telefon' => $this->input->post('phone'));
			$this->users_actions->updateUserDetails($data,$this->current_user['id']);
			$data = array('data_nasterii' => date("Y-m-d",strtotime($this->input->post('date-of-birth'))),'iban' => $this->input->post('iban-account'),'banca' => $this->input->post('bank-name'));
			$this->users_actions->updateUserContactDetails($data,$this->current_user['id']);

			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()/*, 'close_only_modal' => true*/));
		}
	}

	public function changePassword () {

		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'old-password', 'rules' => 'trim|required');
			$validation[] =  array('field' => 'new-password', 'rules' => 'trim|required');
			
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}

			$rez = $this->users_actions->checkOldPassword($this->input->post('old-password'),$this->current_user['id']);
			if(!$rez['nr']) {
				exit($this -> load -> view('layouts/error', array('message' => 'User Section Profile Label Profile Your old password is wrong'),true));
			}

			$data = array('password' => md5($this->input->post('new-password')));
			$this->users_actions->updateUserDetails($data,$this->current_user['id']);
			

			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
			$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()/*, 'close_only_modal' => true*/));
		}
	}

	public function changeEmail () {

		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'new-email', 'rules' => 'trim|required|valid_email');
			
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}

			$rez = $this->users_actions->checkEmail($this->input->post('new-email'));
		
			if($rez['nr'] != "0") {
				exit($this -> load -> view('layouts/error', array('message' => 'User Section Profile Label Profile Email Already Exist'),true));
			}

			$token = md5(time().$this->input->post('new-email'));
			$data = array('emailToChange' => $this->input->post('new-email'), "tokenChangeEmail" => $token);
			$this->users_actions->updateUserDetails($data,$this->current_user['id']);
			$confirmUrl = site_url("/company/confirm-email-address/".$token);
			$message="".$this->lang->line('Hello')."
						<br><br>
						".str_replace('[changeEmailLink]',$confirmUrl,$this->lang->line('User Section Profile Label Profile To Confirm Change Of Email Content'))." .
					";
			$title = $this->lang->line("User Section Profile Label Profile To Confirm Change Of Email Title");
			$this->sendEmail(array($this->input->post('new-email')),$title,$message);

			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('User Section Profile Label Profile Please Check Email Address')));
			$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer(), 'time_before_refresh' => 4000));
		}
	}

	public function confirmEmailAddress($token = "") {
		if($token) {
			$rez = $this->users_actions->checkEmailToken($token);
			if($rez) {
				$data = array('email' => $rez['emailToChange'], "tokenChangeEmail" => "");
				$this->users_actions->updateUserDetails($data,$this->current_user['id']);
				redirect(site_url("company/my-profile"));
			}
		}
	}
}


