<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct() {
			parent::__construct();
			$this -> load -> model('users_actions');
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
}
