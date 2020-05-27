<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

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
		$this -> load -> model('company_actions');
	}
	public function index()
	{
	
	}

	public function companies($categoryName = "") {
		$allActivities = $this->company_actions->getAllCompanyActivitiesGroupByActivity();
		$allCompanies = $this->company_actions->getAllCompanies($categoryName);
		$allCompaniesPagination = $this->company_actions->getAllCompanies($categoryName,true);
		$config['base_url'] = site_url('companies'.($this->uri->segment(2) ? "/".$this->uri->segment(2) : "").'');
		$config['total_rows'] = count($allCompaniesPagination);
		//$config['num_links'] =  count($allCompaniesPagination);
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 12;
		$config['prefix'] = "?page=";
		$config['first_link'] = 'First';
		$config["full_tag_open"] = '<nav aria-label="Page navigation example"><ul class="pagination">';
		//$config["first_tag_open"] = '<li class="page-item">';
		//$config["first_tag_close"] = '</li>';
		$config["full_tag_close"] = '</ul></nav>';
		//$config["num_tag_open"] = '<li class="page-item">';
		//$config["num_tag_close"] = '</li>';
		//$config["cur_tag_open"] = '<li class="page-item">';
		//$config["cur_tag_close"] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item"><a href="'.site_url('companies'.($this->uri->segment(2) ? "/".$this->uri->segment(2)."" : "").'').'" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config["next_link"] = "Next";
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$data['paginationLinks'] = $this->pagination->create_links();
		$categoryId = "";
		if($categoryName) {
			$parts = explode("-",$categoryName);
			if(count($parts)){
				$categoryId = $parts[0];
			}
			
		}
		$displayType = $this->input->get("display");
		if($displayType) {
			if(in_array($displayType,array("grid","list")))
				set_cookie('displayListType',$displayType,'2592000'); 
		}
		
		$displayListTypeCookie = get_cookie('displayListType'); 

		if(!$displayType)
			$displayType = $displayListTypeCookie;

		$data['allActivities'] = $allActivities;
		$data['categoryId'] = $categoryId;
		$data['allCompanies'] = $allCompanies;
		$data['displayType'] = $displayType;
		$list = $this -> load -> view('pages/all-companies/list/'.($displayType == "grid" ? "grid": "list").'', array('allCompanies' => $allCompanies),true);
		$data['list'] = $list;
		$this->load->view('pages/all-companies/index',$data);
	}

}
