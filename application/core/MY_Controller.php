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
					$rez = $this->users_actions->getUserSettings('avatar-image',$this->current_user['id']);
				$this->avatarImage = "";
				if(isset($rez['settings_value']) && $rez['settings_value']){
					$this->avatarImage = site_url('/uploads/users/'.$this->current_user['id'].'/avatar-image/'.$rez['settings_value']);
				}
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
	
	public function checkUserLogged () {
		if(!isset($this->current_user['id'])) {
			redirect(site_url("/"));
		}
	}

	public function sendEmail($to = array(),$title,$content) {
		foreach ($to as $email) {
			$headere  = "MIME-Version: 1.0\r\n";
			$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headere .= "From: ".ucfirst($_SERVER['HTTP_HOST'])."<".$this->users_actions->getContactEmail().">\r\n";

			mail($email,$title,$content,$headere);
		}
		
	}

	function is_date( $str ) {
        try {
            $dt = new DateTime( trim($str) );
        }
        catch( Exception $e ) {
            return false;
        }
        $month = $dt->format('m');
        $day = $dt->format('d');
        $year = $dt->format('Y');
        if( checkdate($month, $day, $year) ) {
            return true;
        }
        else {
            return false;
        }
    }
}
