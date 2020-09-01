<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {
	function __construct() {
			parent::__construct();
			$this -> load -> model('products_actions');
			$this -> load -> model('company_actions');
			$this -> load -> model('users_actions');
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
	
	public function index() {
		if($this->input->post()) {
			
		} else {
			$this->load->view('company/products/index');
		}
	}

	public function uploadPhotos () {
		if (!file_exists('./uploads/companies/'.$this->session->userdata('user')['id'].'')) {
            mkdir('./uploads/comapnies/'.$this->session->userdata('user')['id'].'', 0777, true);
		}
		if (!file_exists('./uploads/companies/'.$this->session->userdata('user')['id'].'/products')) {
            mkdir('./uploads/companies/'.$this->session->userdata('user')['id'].'/products', 0777, true);
		}

		if (!file_exists('./uploads/companies/'.$this->session->userdata('user')['id'].'/products/'.$this->input->post("product-id").'')) {
            mkdir('./uploads/companies/'.$this->session->userdata('user')['id'].'/products/'.$this->input->post("product-id").'', 0777, true);
		}

		$config['upload_path']          = './uploads/companies/'.$this->session->userdata('user')['id'].'/products/'.$this->input->post("product-id").'';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']     = '10240';

		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		$productPhotoData = array("product_photo_product_id" => $this->input->post("product-id"), "product_photo_name" => str_replace(" ","_",$_FILES['file']['name']) , "product_photo_date" => date("Y-m-d H:i:s", time()));
		$this->products_actions->insertProductPhoto($productPhotoData);
		return true;
	}

	public function deleteProductImage() {
		$productImageDetails = $this->products_actions->checkProductImage($this->input->post("id"));
		if(!empty($productImageDetails)) {
			$this->products_actions->deleteProductImage($this->input->post("id"));
			unlink('./uploads/companies/'.$this->session->userdata('user')['id'].'/products/'.$productImageDetails["product_photo_product_id"].'/'.str_replace(" ","_",$productImageDetails["product_photo_name"]).'');
		}
	}

	public function addProduct() {
		if($this->input->post()) {
			
			$validation = array();
			$validation[] =  array('field' => 'price', 'rules' => 'required|regex_match[/^[0-9]*/]');
			$validation[] =  array('field' => 'discount', 'rules' => 'required|regex_match[/^[0-9]*/]');
			$validation[] =  array('field' => 'title', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'description', 'rules' => 'required|trim');

			$this -> form_validation -> set_rules($validation);
			$response = array();
			$response['error'] = "";
			if ($this -> form_validation -> run() == FALSE) {
				$response['error'] = "1";
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true);
				echo json_encode($response);
				die();
			}
			$productData = [];
			$productData['parinte'] = $this->session->userdata('user')['id'];
			$productData['titlu'] = $this->input->post("title");
			$productData['descriere'] = $this->input->post("description");
			$productData['pret'] = $this->input->post("price");
			$productData['promotie'] = $this->input->post("discount");
			$productData['status'] = 1;
			$this->products_actions->insertProduct($productData);
			$response['message'] = $this -> load -> view('layouts/error', array('message' => 'Forms Successful Saving Data'),true);
			$response['productId'] = $this->db->insert_id();
			echo json_encode($response);
			die();
		} else {
			$this->load->view('company/products/add-product');
		}
	}

	public function editProduct($productId ="") {
		if($this->input->post()) {
			
			$validation = array();
			$validation[] =  array('field' => 'price', 'rules' => 'required|regex_match[/^[0-9]*/]');
			$validation[] =  array('field' => 'discount', 'rules' => 'required|regex_match[/^[0-9]*/]');
			$validation[] =  array('field' => 'title', 'rules' => 'required|trim');
			$validation[] =  array('field' => 'description', 'rules' => 'required|trim');

			$this -> form_validation -> set_rules($validation);
			$response = array();
			$response['error'] = "";
			if ($this -> form_validation -> run() == FALSE) {
				$response['error'] = "1";
				$response['message'] = $this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true);
				echo json_encode($response);
				die();
			}
			$productData = [];
			$productData['parinte'] = $this->session->userdata('user')['id'];
			$productData['titlu'] = $this->input->post("title");
			$productData['descriere'] = $this->input->post("description");
			$productData['pret'] = $this->input->post("price");
			$productData['promotie'] = $this->input->post("discount");
			$productData['status'] = 1;
			$this->products_actions->updateProduct($productData,$productId);
			$response['message'] = $this -> load -> view('layouts/error', array('message' => 'Forms Successful Saving Data'),true);
			echo json_encode($response);
			die();
		} else {
			$rez = $this->products_actions->checkProduct($productId);
			if(isset($rez['parinte'])) {
				if($rez['parinte'] == $this->session->userdata('user')['id']) {
					$productPhotos = $this->getProductPhotos($productId);
					$this->load->view('company/products/edit-product',array('productDetails' => $rez, 'productPhotos' => $productPhotos));
				}
			}
			
		}
	}

	public function getProductPhotos($productId = "") {
		$productPhotos = $this->products_actions->getProductPhotos($productId);
		if(!empty($productId)) {
			return json_encode($productPhotos);
		}
	}

	public function deleteProduct() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'id', 'rules' => 'required');
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}
			
			$rez = $this->products_actions->checkProduct($this->input->post("id"));
			if(isset($rez['parinte'])) {
				if($rez['parinte'] == $this->session->userdata('user')['id']) {
					$this->products_actions->updateProduct(array("deleted" => 1),$rez['id']);
					$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
					$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
				}
			}

			
		} else {
			$this->load->view('company/tickets/partials/addTicketsModal');
		}
	}

	public function changeProductStatus() {
		if($this->input->post()) {
			$validation = array();
			$validation[] =  array('field' => 'id', 'rules' => 'required');
			$this -> form_validation -> set_rules($validation);
			$response = array();
			if ($this -> form_validation -> run() == FALSE) {
				exit($this -> load -> view('layouts/error', array('message' => 'You must complete the required fileds'),true));
			}
			
			$rez = $this->products_actions->checkProduct($this->input->post("id"));
			if(isset($rez['parinte'])) {
				if($rez['parinte'] == $this->session->userdata('user')['id']) {
					$this->products_actions->updateProduct(array("status" => $this->input->post("productStatus")),$rez['id']);
					$this -> load -> view('layouts/success', array('message' => $this -> lang -> line('Forms Successful Saving Data')));
					$this -> load -> view('layouts/redirect', array('url' => $this->agent->referrer()));
				}
			}

			
		} else {
			$this->load->view('company/tickets/partials/addTicketsModal');
		}
	}

	public function productsDataTables() {
		$list = $this->products_actions->get_products_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $product) {
            $row = array();
            
            $row['title'] = $product->title;
            $row['description'] = $product->description;
            $row['price'] = $product->price;
			$row['discount'] = $product->discount;
			$row['status'] = ($product->status ? $this->load->view('partials/active',array(),true) : $this->load->view('partials/disabled',array(),true) );
			$row['actions'] = $this->load->view('company/products/partials/actions',array('product' => $product),true);
            $data[] = $row;
          }
   
          $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->products_actions->count_products_all(),
                        "recordsFiltered" => $this->products_actions->count_products_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}


}


