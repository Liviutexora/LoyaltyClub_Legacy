<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct() {
			parent::__construct();
			$this -> load -> model('users_actions');
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

	public function enableDisableDarkMode()
	{
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'enabled', 'rules' => 'required');

			$this -> form_validation -> set_rules($validation);
			//echo "<pre>";
			//var_dump($validation);die();
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				$response['error'] = 1;
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'), true);
				exit(json_encode($response));
			} else {
				$rez = $this->users_actions->getUserSettings('dark-mode',$this->current_user['id']);
				
				if(isset($rez['settings_value']) && $rez['settings_value']){
					$this->users_actions->updateUserSettings('dark-mode',0,$this->current_user['id']);
				}
				elseif(isset($rez['settings_value']) && !$rez['settings_value']){
					$this->users_actions->updateUserSettings('dark-mode',1,$this->current_user['id']);
				} else {
					$data['dark-mode'] = 1;
					$data['settings_user_id'] = $this->current_user['id'];
					$this->users_actions->insertUserSettings(array("settings_name" => "dark-mode","settings_value" => 1,"settings_user_id" => $this->current_user['id'] ));
				}
				
			}

			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Success')));
			$this -> load -> view('layouts/redirect', array('url' => site_url()/*, 'close_only_modal' => true*/));
		}
		
	}

	public function myNetwork()
	{
		$my_network = $this->users_actions->getNetwork($this->current_user['id']);
		$userMoney = $this->users_actions->getOfferedGain($this->current_user['id'],$this->current_user['id']);
		$totalAmount = $this->users_actions->getUserTicketsValue($this->current_user['id']);
		$totalReceived = $this->users_actions->getTotalReceived($this->current_user['id']);
		$generalTotalProfit = 0;
		$generalTotalNrUsers = 0;
		$generalTotalNrLevels = 0;
		$levels = array();
		foreach($my_network as $level=>$levelChilds){
			$usersRows = ""; $totalprofit=0;
			foreach($levelChilds as $levelChildsDetails){
				$offeredGain=$this->users_actions->getOfferedGain($this->current_user['id'],$levelChildsDetails->id); 
				$usersRows.= $this -> load -> view('users/my-network/templates/listOfUsers/row', array('userName' => $levelChildsDetails->nume,"city" => $levelChildsDetails->localitate,"clientCode" => $levelChildsDetails->id), true);
				$totalprofit+=$offeredGain;
				$generalTotalProfit+=$offeredGain;
			}
			$generalTotalNrLevels=$level;
			$generalTotalNrUsers+=count($levelChilds);
			$usersList =  $this -> load -> view('users/my-network/templates/listOfUsers/index', array('items' => $usersRows), true);
			$levels[$level]['totalprofit'] = $totalprofit;
			$levels[$level]['users'] = $usersList;
			$levels[$level]['nr'] = count($levelChilds);
		}
		$generalTotalProfit+=$totalAmount;
		$data['levels'] = $levels;
		$data['totalAmount'] = $totalAmount;
		$data['userMoney'] = $userMoney;
		$data['generalTotalProfit'] = $generalTotalProfit;
		$data['generalTotalNrUsers'] = $generalTotalNrUsers;
		$data['generalTotalNrLevels'] = count($my_network);
		$data['totalReceived'] = $totalReceived;
		
		
		$this->load->view('users/my-network/index',$data);
	}

	public function myProfile() {

		$rez = $this->users_actions->getUserSettings('cover-image',$this->current_user['id']);
		$coverImage = "";
		if(isset($rez['settings_value']) && $rez['settings_value']){
			$coverImage = site_url('/uploads/users/'.$this->current_user['id'].'/cover-image/'.$rez['settings_value']);
		}

		$rez = $this->users_actions->getUserSettings('avatar-image',$this->current_user['id']);
		$avatarImage = "";
		if(isset($rez['settings_value']) && $rez['settings_value']){
			$avatarImage = site_url('/uploads/users/'.$this->current_user['id'].'/avatar-image/'.$rez['settings_value']);
		}
		$data = array('coverImage' => $coverImage,'avatarImage' => $avatarImage);

		$data['userDetails'] = $this->users_actions->getUserDetails($this->current_user['id']);
		$this->load->view('users/my-profile/index',$data);
	}

	public function changeCoverImage() {

		if (!file_exists('./uploads/users/'.$this->current_user['id'].'')) {
            mkdir('./uploads/users/'.$this->current_user['id'].'', 0777, true);
		}
		if (!file_exists('./uploads/users/'.$this->current_user['id'].'/cover-image')) {
            mkdir('./uploads/users/'.$this->current_user['id'].'/cover-image', 0777, true);
		}

		$config['upload_path']          = './uploads/users/'.$this->current_user['id'].'/cover-image';
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
					unlink('./uploads/users/'.$this->current_user['id'].'/cover-image/'.$rez['settings_value']);
					$this->users_actions->updateUserSettings('cover-image',$upload_data['file_name'],$this->current_user['id']);
				}
				elseif(!isset($rez['settings_value'])){
					$this->users_actions->insertUserSettings(array("settings_name" => "cover-image","settings_value" => $upload_data['file_name'],"settings_user_id" => $this->current_user['id'] ));
					
				}
				redirect(site_url("my-profile"));
		}
	}

	public function changeAvatarImage() {
		
		if (!file_exists('./uploads/users/'.$this->current_user['id'].'')) {
            mkdir('./uploads/users/'.$this->current_user['id'].'', 0777, true);
		}
		if (!file_exists('./uploads/users/'.$this->current_user['id'].'/avatar-image')) {
            mkdir('./uploads/users/'.$this->current_user['id'].'/avatar-image', 0777, true);
		}

		$config['upload_path']          = './uploads/users/'.$this->current_user['id'].'/avatar-image';
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
					unlink('./uploads/users/'.$this->current_user['id'].'/avatar-image/'.$rez['avatar-image']);
					$this->users_actions->updateUserSettings('avatar-image',$upload_data['file_name'],$this->current_user['id']);
				}
				elseif(!isset($rez['settings_value'])){
					$this->users_actions->insertUserSettings(array("settings_name" => "avatar-image","settings_value" => $upload_data['file_name'],"settings_user_id" => $this->current_user['id'] ));
					
				}
				redirect(site_url("my-profile"));
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
			$confirmUrl = site_url("/confirm-email-address/".$token);
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
				redirect(site_url("my-profile"));
			}
		}
	}

	public function MyTickets() {
		
		$this->load->view('users/tickets/index');
		
	}

	public function insertTicket() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'ticket-serial', 'rules' => 'required');
			$validation[] =  array('field' => 'ticket-value', 'rules' => 'required|regex_match[/^[0-9]*/]');
			$validation[] =  array('field' => 'ticket-discount', 'rules' => 'required|regex_match[/^[0-9]*/]');

			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}

			$rez = $this->tickets_actions->checkTicketBySerial($this->input->post('ticket-serial'));
			if(!$rez) {
				exit($this -> load -> view('layouts/error', array('message' => 'User Section Tickets Page Label Invalid Serial'),true));
			}

			if($rez['status'] == 1) {
				exit($this -> load -> view('layouts/error', array('message' => 'User Section Tickets Page Label In Porgress To Be Validated'),true));
			}elseif($rez['status'] == 2) {
				exit($this -> load -> view('layouts/error', array('message' => 'User Section Tickets Page Label Already Validated'),true));
			}

			$data['id_user'] = $this->session->userdata('user')['id'];
			$data['valoare'] = (float)$this->input->post('ticket-value');
			$data['reducere'] = (float)$this->input->post('ticket-discount');
			$data['data_valorificare'] = date("Y-m-d");
			$data['status'] = 1;
			$this->tickets_actions->updateTicket($data,$rez['id']);
			
			$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('User Section Tickets Page Label Message To Wait Validation')));
			$this -> load -> view('layouts/redirect', array('url' => site_url("my-tickets")));
		} else {
			$data = array();
			$data['redirect'] = "";
			if($this->input->get("redirect"))
				$data['redirect'] = $this->input->get("redirect");
			$this->load->view('users/tickets/partials/addTicketModal',$data);
		}
	}

	public function validatedTicketsDatables() {
		$list = $this->tickets_actions->get_user_tickets_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ticket) {
            $row = array();
            $row['serialNumber'] = $ticket->serialNumber;
            $row['discount'] = $ticket->discount;
            $row['value'] = $ticket->value;
			$row['createdDate'] = date("d-m-Y",strtotime($ticket->createdDate));
			$row['status'] = ($ticket->status == 1 ? $this->lang->line("User Section Tickets Page Label Not Validated By Trader") : $this->lang->line("User Section Tickets Page Label Validated"));
			$data[] = $row;
          }
   
          $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->tickets_actions->count_user_tickets_all(),
                        "recordsFiltered" => $this->tickets_actions->count_user_tickets_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}


}
