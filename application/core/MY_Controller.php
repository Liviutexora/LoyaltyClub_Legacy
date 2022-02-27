<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
			date_default_timezone_set('Europe/Bucharest');
			parent::__construct();
			$this -> load -> model('users_actions');
			$this -> load -> model('admin_actions');
			$this->run_migrations();
			
			// Your own constructor code
			$this->current_user = $this->session->userdata('user');
			$this->darkMode = false;
			if(isset($this->current_user['id'])) {
				$this->checkUsersSectionsAccess();
				$rez = $this->users_actions->getUserSettings('dark-mode',$this->current_user['id']);
				if(isset($rez['settings_value']) && $rez['settings_value'] || $this->current_user['tip'] == 3)
					$this->darkMode = true;
					$rez = $this->users_actions->getUserSettings('avatar-image',$this->current_user['id']);
				$this->avatarImage = "";
				if(isset($rez['settings_value']) && $rez['settings_value']){
					
					$this->avatarImage = site_url('/uploads/'.($this->current_user['tip'] == 2 ? 'companies' : 'users' ).'/'.$this->current_user['id'].'/avatar-image/'.$rez['settings_value']);
				}
				$this->allPagesDocumentation = $this->admin_actions->getAllPages($pageType = "documentation",$userType = ($this->current_user['tip'] == 2 ? 'company' : 'private' ));
				$this->allPagesTermsAndDocumentations = $this->admin_actions->getAllPages($pageType = "terms-and-conditions",$userType = ($this->current_user['tip'] == 2 ? 'company' : 'private' ));
			
				
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

	public function checkUsersSectionsAccess (){
		$callers=debug_backtrace();
		$controllerName = (isset($callers[1]['object']->uri->rsegments[1]) ? $callers[1]['object']->uri->rsegments[1]  : "");
		$methodName = (isset($callers[1]['object']->uri->rsegments[2])  ? $callers[2]['object']->uri->rsegments[2] : "");

		if($controllerName && $methodName) {
			$dataToCheck = array("user_section_access_user_type" => $this->current_user['tip'], "user_section_access_class_name" => $controllerName, "user_section_access_method_name" => $methodName );
			$rez = $this->users_actions->checkUserSectionAccess($dataToCheck);
			if(!$rez)
				redirect(site_url('/'));
		}
	}

	public function insertUsersSectionsAccess (){
		$callers=debug_backtrace();
		$controllerName = (isset($callers[1]['object']->uri->rsegments[1]) ? $callers[1]['object']->uri->rsegments[1]  : "");
		$methodName = (isset($callers[1]['object']->uri->rsegments[2])  ? $callers[2]['object']->uri->rsegments[2] : "");
		
		if($controllerName && $methodName) {
			$dataToInsert = array("user_section_access_user_id" => $this->current_user['id'], "user_section_access_class_name" => $controllerName, "user_section_access_method_name" => $methodName );
			
			$this->users_actions->insertUserSectionAccess($dataToInsert);
			echo $this->db->last_query();
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
	
	function generateRandomString($length = 10) {
		$characters = time().'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function generateListOfDistricts() {
		$districts=array(1=>"Alba",2=> "Arad",3=> "Arges",4=> "Bacau",5=> "Bihor",6=> "Bistrita-Nasaud",7=> "Botosani",8=> "Braila",9=> "Brasov",10=> "Buzau",11=> "Caras Severin",12=> "Calarasi",13=> "Cluj",14=> "Constanta",15=> "Covasna",16=> "Dambovita",17=> "Botosani",18=> "Dolj",19=> "Galati",20=> "Giurgiu",21=> "Gorj",22=> "Harghita",23=> "Hunedoara",24=> "Ialomita",25=> "Iasi",26=> "Ilfov",27=> "Maramuresi",28=> "Mehedinti",29=> "Mures",30=> "Neamt",31=> "Olt",32=> "Prahova",33=> "Satu-Mare",34=> "Salaj",35=> "Sibiu",36=> "Suceava",37=> "Teleorman",38=> "Timis",39=> "Tulcea",40=> "Vaslui",41=> "Valcea",42=> "Vrancea");
		return $districts;
	}


}
