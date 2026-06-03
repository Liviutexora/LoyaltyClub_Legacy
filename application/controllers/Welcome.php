<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	function __construct() {
			parent::__construct();
			$this -> load -> model('users_actions');
			$this -> load -> model('tickets_actions');
			$this ->load -> model('invoices_actions');
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
		//echo md5("97".$this->config->item("encryption_key"));die();
		if(isset($this->current_user['id'])) {
			$data = array();
			switch ($this->current_user['tip']) {
				case 1:
					$data['nrOfTickets'] = $this->tickets_actions->getNrTickets($this->current_user['id']);
					$userMoney = $this->users_actions->getOfferedGain($this->current_user['id'],$this->current_user['id']);
					$receivedMoney = $this->users_actions->getTotalReceived($this->current_user['id']);
					$data['totalReceived'] = $userMoney + $receivedMoney;
					$my_network = $this->users_actions->getNetwork($this->current_user['id']);
					$generalTotalNrUsers = 0;
					foreach($my_network as $level=>$levelChilds){
						$generalTotalNrUsers+=count($levelChilds);
					}
					$data['generalTotalNrUsers'] = $generalTotalNrUsers;
					$totalAmount = $this->users_actions->getUserTicketsValue($this->current_user['id']);
					$data['totalAmount'] = $totalAmount;
					
					$level1Precentage = round(($this->config->item('graphTicketsLevel1MaxValue') * 100)/$this->config->item('personalShoppingMaxValue'),2);
					$level2Precentage = round((($this->config->item('graphTicketsLevel2MaxValue') - $this->config->item('graphTicketsLevel1MaxValue')) * 100)/$this->config->item('personalShoppingMaxValue'),2);
					$level3Precentage = round((($this->config->item('graphTicketsLevel3MaxValue') - $this->config->item('graphTicketsLevel2MaxValue')) * 100)/$this->config->item('personalShoppingMaxValue'),2);
					$graphTicketsMaxPrecentages = array("level1" => $level1Precentage,"level2" => $level2Precentage,"level3" => $level3Precentage);
					$level1Limit = round(($this->config->item('graphTicketsLevel1MaxValue') * 100)/$this->config->item('personalShoppingMaxValue'),2);
					$level2Limit = round(($this->config->item('graphTicketsLevel2MaxValue') * 100)/$this->config->item('personalShoppingMaxValue'),2);
					$level3Limit = round(($this->config->item('graphTicketsLevel3MaxValue') * 100)/$this->config->item('personalShoppingMaxValue'),2);
		
					$currentPrecentageFromTicketTotal = round(($totalAmount * 100)/$this->config->item('personalShoppingMaxValue'),2);
				

				
					$data['graphTicketsMaxPrecentages'] = $graphTicketsMaxPrecentages;
					$data['currentGraphPercentage'] = array();

					if($currentPrecentageFromTicketTotal <= $level1Limit) {
						$data['levelSelect'] = 'level1';
						$data['currentGraphPercentage']['level1'] = min(
						    100,
						    round(
						        ($currentPrecentageFromTicketTotal / $level1Limit) * 100
						    ,2)
						);
					} elseif($currentPrecentageFromTicketTotal > $level1Limit  && $currentPrecentageFromTicketTotal <= $level2Limit) {
						$data['levelSelect'] = 'level2';
						$data['currentGraphPercentage']['level2'] = min(
						    100,
						    round(
						        (
						            ($currentPrecentageFromTicketTotal - $level1Limit)
						            /
						            ($level2Limit - $level1Limit)
						        ) * 100
						    ,2)
						);
					}elseif($currentPrecentageFromTicketTotal > $level2Limit) {
						$data['levelSelect'] = 'level3';
						
						$data['currentGraphPercentage']['level3'] = min(
						    100,
						    round(
						        (
						            ($currentPrecentageFromTicketTotal - $level2Limit)
						            /
						            ($level3Limit - $level2Limit)
						        ) * 100
						    ,2)
						);
					}

					break;
					case 2:
						$data['nrOfTickets'] = $this->tickets_actions->getCompanyNrTickets($this->current_user['id'],$statuses = [0]);
						$data['amountValidatedTicket'] = $this->tickets_actions->getCompanyAmountValidatedTickets($this->current_user['id'])['valoare'];
						$data['amountInvoice'] = $this->invoices_actions->getInvoiceTotal($this->current_user['id'])['suma'];
					break;

				default:
					# code...
					break;
			}
				
			$this->load->view('layouts_after_login/index',$data);
		} else {
			$this->load->view('layouts/index');
		}
		
	}
}
