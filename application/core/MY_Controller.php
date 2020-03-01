<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			// Your own constructor code
			$this->current_user = $this->session->userdata('user');

	}
}
