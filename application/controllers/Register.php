<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

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
	function __construct() {
		parent::__construct();
		$this -> load -> model('users_actions');
	}
	public function index()
	{
		
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'account_type', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'name', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'email', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'password', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'terms', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'phone', 'rules' => 'required|trim|regex_match[/^[0-9]*/]');

			if($this->input->post("account_type") && $this->input->post("account_type") == "company") {
				$validation[] =  array('field' => 'cui', 'rules' => 'required|trim');
			}
			$this -> form_validation -> set_rules($validation);
			//echo "<pre>";
			//var_dump($validation);die();
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				$response['error'] = 1;
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'), true);
				exit(json_encode($response));
			}

			$rez = $this->users_actions->email_exists($this->input->post("email"));

			if($rez) {
				$response['error'] = 1;
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'The email already exist!'), true);
				exit(json_encode($response));
			}
		
			if($this->input->post('confirmPassword') != $this->input->post('password')) {
				$response['error'] = 1;
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'The passwords do not match!'), true);
				exit(json_encode($response));
			}
			
			if($this->input->post("account_type") == "company") {
				$tip =2;
			} else {
				$tip =1;
			}
			$sponsor=trim($this->input->post('sponsor'));
			if($sponsor=='') $sponsor=11;
			//verifica tipul de user
			if(isset($tip) && $tip==1)
			{
				//mesajde confirmare
				$msg=$this->lang->line('Congratulations! You have been registered.');
				//parametri tabela adiacenta contact
				

				//cauta sponsor real
				$sponsor=$this->users_actions->checkChilds($sponsor);
				
				if(!$sponsor) {
					$response['error'] = 1;
					$response['message'] = $this -> load -> view('layouts/error', array('message' => 'The sponsor is invalid'), true);
					exit(json_encode($response));
				}
				
				
				//construieste query
				$sql_tab="`contact`";
				$sql_val="'".$sponsor."'";
				$sql_ins="`id_user`,`sponsor`";
				$status=1;
		
				$mesaj_utilizator = $this -> load -> view('register/emails/users/after_registration_to_user', array('userName' => $this->input->post('name'),"email" =>$this->input->post('email'), "password" => $this->input->post('password') ),true);
				$loyaltyclub_casa_mail = config_item('loyaltyclub_casa_mail');
				$this -> email -> initialize($loyaltyclub_casa_mail);
				$this -> email -> from($loyaltyclub_casa_mail['smtp_user'], "Loyalty Club");
				$this -> email -> to($this->input->post('email'));
				$this -> email -> cc('');
				$this -> email -> bcc('');
				$this->email->subject("Loyalty Club");
				$this -> email -> message($mesaj_utilizator);
				$this -> email -> send();
			}
			else if(isset($tip) && $tip==2)
			{
				//mesajde confirmare
				$msg=''.$this->lang->line('Congratulations! You have been registered.').'<br>'.$this->lang->line("Please check your email address to confirm your account.").'';		
				//parametri tabela adiacenta firma
				$cui=trim($this->input->post('cui'));
				$nume_firma=trim($this->input->post('name'));
				//initializam numele cu un spatiu pentru a trece de conditie
				$nume=' ';

				//if(!checkCIF($cui))	redirect(currentfile(),'Codul de identificare al firmei este invalid');
				
				//construieste query
				$sql_tab="`firma`";
				$sql_val="'".$nume_firma."','".base64_encode($cui)."' ,'".trim($sponsor)."' ";
				$sql_ins="`id_firma`,`nume_firma`,`cui`,`sponsor_id`";
				$status=0;
				$mesaj_utilizator = $this -> load -> view('register/emails/companies/after_registration_to_company', array('companyName' => $this->input->post('name'),"email" =>$this->input->post('email'), "password" => $this->input->post('password') ),true);
				$loyaltyclub_casa_mail = config_item('loyaltyclub_casa_mail');
				$this -> email -> initialize($loyaltyclub_casa_mail);
				$this -> email -> from($loyaltyclub_casa_mail['smtp_user'], "Loyalty Club");
				$this -> email -> to($this->input->post('email'));
				$this -> email -> cc('');
				$this -> email -> bcc('');
				$this->email->subject("Loyalty Club");
				$this -> email -> message($mesaj_utilizator);
				$this -> email -> send();					
			}

			//adauga user
			$query="INSERT INTO `user` (`tip`,`nume`,`username`,`password`,`email`,`status`,`data`) 
					VALUES(".(int)$tip.",'".$this->input->post('name')."','".$this->input->post('email')."','".md5($this->input->post('password'))."','".$this->input->post('email')."',".$status.",NOW())";
			//$this->db->query($query);
			$post_data = array("telefon" => $this->input->post("phone"), "tip" => (int)$tip, "nume" => $this->input->post('name'),"username" =>$this->input->post('email'),"password"=>md5($this->input->post('password')),"email" =>$this->input->post('email'), "status"=>$status, "data" =>date("Y-m-d H:i:s") );
			$this->db->insert('user',$post_data);
			//get the las inserted id
			$last_id=$this->db->insert_id();
			
			//introducem in tabela adiacenta
			$query="INSERT INTO ".$sql_tab." (".$sql_ins.") VALUES(".$last_id.",".$sql_val.")";
			$this->db->query($query);
			$network = array();
			$this->users_actions->getUserParents($last_id,$network);
			/*
			if( count($network) > 0 ) {
				// send mail for all parents to inform about their earning
				$rez = $this->db->query("SELECT * FROM user where id IN(".implode(',',$network ).")")->result();
				
				
				foreach( $rez as $key => $value)
				{
			
					if( $value->email )
					{
						$catre_utilizator=$value->email;
						$subiect_utilizator=$this->lang->line('You have a new user in your team');
						$mesaj_utilizator="
									".$this->lang->line('Hello')."
									<br><br>
									".$this->lang->line('Congratulations a new user has registered in your team')."
									<br>
									".$this->lang->line('Please login into your account')." <a href='".$_SERVER['HTTP_HOST']."'>link</a> ".$_SERVER['HTTP_HOST']."
									<br><br>
									".$this->lang->line('Thank you')."";
						$headere  = "MIME-Version: 1.0\r\n";
						$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
						
						
						//trimite mail
						//mail($catre_utilizator, $subiect_utilizator, $mesaj_utilizator, $headere);
					}
				}
			}*/
			//daca este firma inseram domeniile de activitate
			if($tip==2)
			{
				//daca s-au ales activitati, atunci este firma, deci trimitem email
				$catre_admin=$this->users_actions->getContactEmail();
				$mesaj_admin = $this -> load -> view('register/emails/companies/after_registration_to_admin', array('companyName' => $this->input->post('name')),true);
				$loyaltyclub_casa_mail = config_item('loyaltyclub_casa_mail');
				$this -> email -> initialize($loyaltyclub_casa_mail);
				$this -> email -> from($loyaltyclub_casa_mail['smtp_user'], "Loyalty Club");
				$this -> email -> to($catre_admin);
				$this -> email -> cc('');
				$this -> email -> bcc('');
				$subiect_adm="".$this->lang->line('The new account for the company')." ".$nume_firma;
				$this->email->subject($subiect_adm);
				$this -> email -> message($mesaj_admin);
				$this -> email -> send();			
			}
			
			if($tip==2)
			{
				/*
				//get all users
				$all_users="SELECT * FROM `user` WHERE `email`!='' AND tip='1'";
				$all_users=$this->db->query($all_users)->result();
				//go through all users and send mail with details about new company
				
				foreach( $all_users as $all_users_key => $all_users_value )
				{
					
					$catre_utilizator=$all_users_value->email;
					$message = $this -> load -> view('register/emails/users/after_registration_to_users_new_company_registered',true);
					$loyaltyclub_casa_mail = config_item('loyaltyclub_casa_mail');
					$this -> email -> initialize($loyaltyclub_casa_mail);
					$this -> email -> from($loyaltyclub_casa_mail['smtp_user'], "Loyalty Club");
					$this -> email -> to($this->input->post('email'));
					$this -> email -> cc('');
					$this -> email -> bcc('');
					$subiect_utilizator="".$this->lang->line('The new account for the company')." ".$nume_firma;
					$this->email->subject($catre_utilizator);
					$this -> email -> message($message);
					$this -> email -> send();		
					
				}*/
			}
		

			$response['error'] = 0;
			$message = "";
			$message .= $this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Successful Saving')), true);
			$response['message'] = $message;
			exit(json_encode($response));

		}
	}

	public function email() {
		$this -> load -> view('register/emails/companies/after_registration_to_company', array('message' => $this -> lang -> line('Successful Saving')));
	}

	public function login() {
		$validation = array();
		$validation[] =  array('field' => 'email', 'rules' => 'required');
		$validation[] =  array('field' => 'password', 'rules' => 'required');
		$this -> form_validation -> set_rules($validation);
		//echo "<pre>";
		//var_dump($validation);die();
		$response = array();
		if ($this -> form_validation -> run() == FALSE) {
			$response['error'] = 1;
			$response['message'] = $this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'), true);
			exit(json_encode($response));
		}
		$data = array("email" => $this->input->post('email'),"password" => $this->input->post('password') );
		$rez = $this->users_actions->getLogApprove($data);

		if(!$rez) {
			$response['error'] = 1;
			$response['message'] = $this -> load -> view('layouts/error', array('message' => 'Invalid login details'), true);
			exit(json_encode($response));
		} else {
			$rememberme = $this->input->post('remember');
			if ($rememberme) {
					$this->session->sess_expiration = 144000; // 40 hours
					$this->session->sess_expire_on_close = FALSE;
			}
			$response['error'] = 0;
			$message = "";
			$redirectUrl =  site_url();
			switch ($this->session->userdata('user')['tip']) {
				case '3':
					$redirectUrl =  site_url('admin/users');
					break;
				
				default:
					# code...
					break;
			}
			$message .= $this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Register Success')), true);
			$message .= $this -> load -> view('layouts/redirect', array('url' =>$redirectUrl/*, 'close_only_modal' => true*/), true);
			$response['message'] = $message;
			exit(json_encode($response));
		}
	}

	public function forgotPassword() {

		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'email', 'rules' => 'required|valid_email');
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				$response['error'] = 1;
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'), true);
				exit(json_encode($response));
			}
			$rez = $this->users_actions->email_exists($this->input->post('email'));

			if(!$rez) {
				$response['error'] = 1;
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'Introduceti o adresa de email valida.'), true);
				exit(json_encode($response));
			} else {
				$password = $this->users_actions->update_password_by_email($this->input->post('email'));
				$user_details = $this->users_actions->get_user_details_by_email($this->input->post('email'));
				//creaza si trimite email
				$catre=$this->input->post('email');
				$subiect="".$this->lang->line('Forgot Password Password recovery')." ".site_url("/");
				$mesaj="".$this->lang->line('Hello')." ".$user_details['nume']."
						<br><br>
						".$this->lang->line('Forgot Password You have accessed the recovery password form on ')." ".site_url("/").".
						<br>
						".$this->lang->line('Forgot Password The new login details are:')."
						<br>
						".$this->lang->line('Forgot Password Username:')."".$this->input->post('email')."
						<br>
						".$this->lang->line('Forgot Password Password:')."".$password."
						<br><br>
						".$this->lang->line('Forgot Password Please go to ')." <a href='http://".site_url("/")."'>site</a> ".$this->lang->line('Forgot Password and please change your password.')." 
						<br><br>
						".$this->lang->line('Forgot Password We are waiting you on ')." <a href='http://".site_url("/")."'>site</a> ".$this->lang->line('Forgot Password with many promotions and discounts.')."
						<br><br>
						".$this->lang->line('Forgot Password The team')." ".site_url("/").".";
				$headere  = "MIME-Version: 1.0\r\n";
				$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headere .= "From: ".ucfirst($_SERVER['HTTP_HOST'])."<".$this->users_actions->getContactEmail().">\r\n";

				mail($catre,$subiect,$mesaj,$headere);
				$response['error'] = 0;
				$message = "";
				$message .= $this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forgot Password Please check your emai address')), true);
				$message .= $this -> load -> view('layouts/redirect', array('url' => site_url()/*, 'close_only_modal' => true*/), true);
				$response['message'] = $message;
				exit(json_encode($response));
			}
		} else {
			$this->load->view('register/forgot_password');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(site_url("/"));
	}
}
