<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends MY_Controller {
	function __construct() {
			parent::__construct();
			
			$this -> load -> model('invoices_actions');
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
	public function index()
	{
		
		
	}
	
	public function generateInvoice() {
		
		$invoiceId=$this->invoices_actions->generateInvoice($this->current_user['id']);
		if($invoiceId) {
			$invoiceDetails = $this->invoices_actions->getInvoiceDetails($invoiceId);
			$companyDetails = $this->company_actions->getCompanyDetails($this->current_user['id']);
			$userDetails = $this->users_actions->get_user_details_by_id($this->current_user['id']);
			$this->sendEmailToAdmin($companyDetails,$invoiceDetails,$userDetails);
			
			$this->generatePdf($companyDetails,$invoiceDetails,$userDetails);
		} else {
			redirect("/");
		}
		
	}

	public function viewInvoice($invoiceId = "") {
		/*
		$this->load->library('email');
		$this->email->initialize($this->config->item('smtp-config'));
		//$this->email->set_newline("\r\n");
		$this -> email -> from($this->config->item('smtp-config')['smtp_user'], "Loyaltyclub");
				$this -> email -> to("ucostea@gmail.com");
				$this -> email -> cc('');
				$this -> email -> bcc('');
$this->email->subject("Buna");
				$this -> email -> message("Salutare ce mai faci");
				$this -> email -> send();
				echo $this->email->print_debugger();
				die();*/
		$invoiceDetails = $this->invoices_actions->getInvoiceDetailsByMD5($invoiceId);
		if(!empty($invoiceId)) {
			
			$companyDetails = $this->company_actions->getCompanyDetails($invoiceDetails['id_firma']);
			$userDetails = $this->users_actions->get_user_details_by_id($companyDetails['id']);
		
			$this->generatePdf($companyDetails,$invoiceDetails,$userDetails);
		} else {
			redirect("/");
		}
		
	}

	public function sendEmailToAdmin($companyDetails,$invoiceDetails,$userDetails) {
		$subiect="Factura ".$companyDetails['companyName']." din data".date('d-m-Y');
		$idInvoiceUrl = md5($invoiceDetails['id_factura'].$this->config->item("encryption_key"));
		$message= $this->load->view("emails/admin/invoices/newInvoice",array("idInvoiceUrl" => $idInvoiceUrl, "companyDetails" => $companyDetails, "invoiceDetails" => $invoiceDetails, "userDetails" => $userDetails),true);
		$headere  = "MIME-Version: 1.0\r\n";
		$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headere .= "From: ".$companyDetails['companyName']."<".$this->current_user['email'].">\r\n";
		$sendTo  = $this->users_actions->getContactEmail();
		$this->sendEmail(array($sendTo),$subiect,$message);
	}

	public function generatePdf($companyDetails,$invoiceDetails,$userDetails) {
		
		// create new PDF document
		$this->load->library('pdf');
		$pdf = $this->pdf->load();

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//header
		$pdf->setPrintHeader(false);
		$pdf->SetPrintFooter(false);

		//set margins
		$pdf->SetMargins(5, 15, 5);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(7);

		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		//$pdf->setLanguageArray($l);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 10);

		// add a page
		$pdf->AddPage();

		// define some HTML content with style
		$html = $this->load->view("company/invoices/partials/pdf_content",array("companyDetails" => $companyDetails, "invoiceDetails" => $invoiceDetails, "userDetails" => $userDetails),true);
		
		//echo $html;die();
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------


		//Close and output PDF document
		$pdf->Output('factura.pdf', 'I');
	}
}


