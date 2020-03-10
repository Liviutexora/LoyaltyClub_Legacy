<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this -> load -> model('users_actions');
			$this->run_migrations();
			// Your own constructor code
			$this->current_user = $this->session->userdata('user');
			$this->darkMode = false;
			if(isset($this->current_user['id'])) {
				$rez = $this->users_actions->getUserSettings('dark-mode',$this->current_user['id']);
				if(isset($rez['settings_value']) && $rez['settings_value'])
					$this->darkMode = true;
			}
			

	}

	public function run_migrations() {
        $this->load->library('migration');
        // Check for migrations and run them if there are new versions
        //$this->migration->version(14);
        if ($this->migration->latest() === FALSE) {
         show_error($this->migration->error_string());
        }
    }
}
