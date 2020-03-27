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
			//verifica tipul de user
			if(isset($tip) && $tip==1)
			{
				//mesajde confirmare
				$msg=$this->lang->line('Congratulations! You have been registered.');
				//parametri tabela adiacenta contact
				$sponsor=trim($this->input->post('sponsor'));
				
				if($sponsor=='') $sponsor=11;
				//cauta sponsor real
				$sponsor=$this->users_actions->checkChilds($sponsor);
				
				if(!$sponsor) {
					$response['error'] = 1;
					$response['message'] = $this -> load -> view('layouts/error', array('message' => 'The sponsor is invalid'), true);
					exit(json_encode($response));
				}
				
				
				//construieste query
				$sql_tab="`contact`";
				$sql_val="'".$this->input->post('sponsor')."'";
				$sql_ins="`id_user`,`sponsor`";
				$status=1;
				
				//mesaj email de confirmare.$this->input->post('sponsor')
				$mesaj="
						".$this->lang->line('Hello')." ".$this->input->post('name')."
						<br><br>
						".$this->lang->line('You have been successfully registered on')." ".$_SERVER['HTTP_HOST']."
						<br>
						".$this->lang->line('Your login details are:')."
						<br>
						Username:".$this->input->post('email')."
						<br>
						".$this->lang->line('Password:')."".$this->input->post('password')."
						<br><br>
						".$this->lang->line('We are waiting you on ')." <a href='http://".$_SERVER['HTTP_HOST']."'>site</a> ".$this->lang->line('with many promotions and discounts.')."
						<br><br>
						".$this->lang->line('The team')." <a href='http://".$_SERVER['HTTP_HOST']."'>www.".$_SERVER['HTTP_HOST']." </a>".$this->lang->line('thanks you and wishes you a pleasant shopping experience.')."";			
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
				$sql_val="'".$nume_firma."','".base64_encode($cui)."' ,'".trim($this->input->post('sponsor'))."' ";
				$sql_ins="`id_firma`,`nume_firma`,`cui`,`sponsor_id`";
				$status=1;
				
				
				//mesaj email de confirmare
				$mesaj="
						".$this->lang->line('Hello')."
						<br><br>
						".$this->lang->line('The company')." ".$this->input->post('name')." ".$this->lang->line('has been registered on')." www.".$_SERVER['HTTP_HOST']."
						<br>
						".$this->lang->line('Your login details are:')."
						<br>
						Username:".$this->input->post('email')."
						<br>
						".$this->lang->line('Password:')."".$this->input->post('password')."
						<br><br>
						".$this->lang->line('In the shortest time the team on')." <a href='http://".$_SERVER['HTTP_HOST']."'>www.".$_SERVER['HTTP_HOST']."</a> ".$this->lang->line('will contact your company to establish contractual details and will activate your account.')."
						<br><br>
						".$this->lang->line('The team')." <a href='http://".$_SERVER['HTTP_HOST']."'>www.".$_SERVER['HTTP_HOST']."</a> ".$this->lang->line('thanks you for your choice.')."";					
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
			}
			//daca este firma inseram domeniile de activitate
			if($tip==2)
			{
				//daca s-au ales activitati, atunci este firma, deci trimitem email
				$catre_admin=$this->users_actions->getContactEmail();
				$subiect_adm="".$this->lang->line('The new account for the company')." ".$nume_firma;
				$mesaj_admin="
							".$this->lang->line('Hello')."
							<br><br>
							".$this->lang->line('We are')." ".$nume_firma." ".$this->lang->line('and we just registered on')." www.".$_SERVER['HTTP_HOST']."
							<br>
							".$this->lang->line('Please contact us to establish our contractual details and to activate our account.')."
							<br><br>
							".$this->lang->line('Thank you')."";
				$headere  = "MIME-Version: 1.0\r\n";
				$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headere .= "From: ".$nume_firma."<".$this->input->post('email').">\r\n";
				
				//trimite mail
				//mail($catre_admin, $subiect_adm, $mesaj_admin, $headere);				
			}
			
			//trimite email
			$catre=$this->input->post('email');
			$subiect="".$this->lang->line('Account')." ".$_SERVER['HTTP_HOST'];
			$headere  = "MIME-Version: 1.0\r\n";
			$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headere .= "From: ".$_SERVER['HTTP_HOST']."<".$this->users_actions->getContactEmail().">\r\n";
			/*
			if(mail($catre, $subiect, $mesaj, $headere))
			{
				if($tip==2)
				{
					//get all users
					$all_users="SELECT * FROM `user` WHERE `email`!='' AND tip='1'";
					$all_users=$this->db->query($all_users)->result();
					//go through all users and send mail with details about new company
					
					foreach( $all_users as $all_users_key => $all_users_value )
					{
						
						$catre_utilizator=$all_users_value->email;
						//$catre_utilizator='uncuta.constantin@gmail.com';
						$subiect_utilizator="".$this->lang->line('The new account for the company')." ".$nume_firma;
						$mesaj_utilizator="
									".$this->lang->line('Hello')."
									<br><br>
									".$this->lang->line('A new comapny just registered on')." www.".$_SERVER['HTTP_HOST']."
									<br>
									".$this->lang->line('To see the products and services for this company please click on this')." <a href='".$_SERVER['HTTP_HOST']."'>link</a> www.".$_SERVER['HTTP_HOST']."
									<br><br>
									".$this->lang->line('Thank you')."";
						$headere  = "MIME-Version: 1.0\r\n";
						$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headere .= "From: ".$nume_firma."<".$this->input->post('email').">\r\n";
						
						//trimite mail
						//mail($catre_utilizator, $subiect_utilizator, $mesaj_utilizator, $headere);	
						
					}
				}
		
			}*/

			$response['error'] = 0;
			$message = "";
			$message .= $this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Successful Saving')), true);
			$response['message'] = $message;
			exit(json_encode($response));

		}
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
			$message .= $this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Register Success')), true);
			$message .= $this -> load -> view('layouts/redirect', array('url' => site_url()/*, 'close_only_modal' => true*/), true);
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
