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
		$this -> load -> model('admin_actions');
	}
	public function documentation($pageName = "")
	{

		if($pageName) {
			$pageId = "";
			$parts = explode("-",$pageName);
			if(count($parts)){
				$pageId = $parts[0];
			}
			$pageDetails = $this->admin_actions->getPageDetails($pageId);
			if(count($pageDetails)) {
				$title = strtolower($pageDetails['id']."-".preg_replace('/[\s,\']+/', '-', $pageDetails['titlu_eng']));
				$pageName = urldecode($pageName);
				if($title == $pageName) {
					$this->load->view('pages_after_login/index',array("pageDetails" => $pageDetails));
				} else {
					redirect(site_url("/"));
				}
			}
			
		}
	}

	public function termsAndConditions($type = "", $pageName = "")
	{
		$types = array("company","private");
		if(!in_array($type,$types))
			redirect(site_url("/"));

		$pageId = "";
		$allPagesTermsAndDocumentations = $this->admin_actions->getAllPages($pageType = "terms-and-conditions",$userType = $type);	
	
		if(!$pageName) {
			$pageName = $allPagesTermsAndDocumentations[0]['titlu_eng'];
			$pageId = $allPagesTermsAndDocumentations[0]['id'];
			$pageName =  strtolower(urldecode($allPagesTermsAndDocumentations[0]['id']."-".preg_replace('/[\s,\']+/', '-', $allPagesTermsAndDocumentations[0]['titlu_eng'])));
			
		}
		else {
			$parts = explode("-",$pageName);
			if(count($parts)){
				$pageId = $parts[0];
			}
		}
	
		$pageDetails = $this->admin_actions->getPageDetails($pageId);
		if(count($pageDetails)) {	
			$originalPageName = strtolower(urldecode($pageDetails['id']."-".preg_replace('/[\s,\']+/', '-', $pageDetails['titlu_eng'])));
			//echo $pageName . " ". $originalPageName;die();
			if($pageName == $originalPageName) {
			
				$this->load->view('pages/terms-and-conditions/index',array("pageId" => $pageId,"pageDetails" => $pageDetails, "allPagesTermsAndDocumentations" => $allPagesTermsAndDocumentations));
				
			} else {
				redirect(site_url("/"));
			}
		} else {
			redirect(site_url("/"));
		}
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

	public function pages() {

	}

}
