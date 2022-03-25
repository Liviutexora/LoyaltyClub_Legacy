<?php
class Tickets_actions extends CI_model
{
	public function generateTickets($number)
	{
		$data = array();
		for($i=1;$i<=$number;$i++)
		{
			$CI = get_instance();
			$ticket = strtoupper($CI->generateRandomString($length = 5));
			$data[] = array("ticket" => $ticket, "id_firma" => $this->session->userdata('user')['id'], "data_creare" => date("Y-m-d"));
        }
        $this->db->insert_batch('tickets', $data);
        return $data;
	}

	public function deleteTicket($id) {
		$this->db->where('id', $id);
		$this->db->delete('tickets');
	}

	function checkTicket($id) {
		return $this->db->select('*', FALSE)
						   ->where('id', $id)
						   ->get('tickets')->row_array();
    }
    
    function checkTicketBySerial($serial) {
		return $this->db->select('*', FALSE)
						   ->where('ticket', $serial)
						   ->get('tickets')->row_array();
    }
    
    
    function updateTicket($data,$id) {
		$this->db->where('id', $id);
		$this->db->update('tickets', $data);
    }

    function getNrTickets($userId = null) {
        $this->db->from('tickets as t');
        $this->db->where_in('t.status', array(1,2)); 
        $this->db->where('t.id_user', ($userId ? $userId : $this->session->userdata('user')['id']));
        return $this->db->count_all_results();
    }


    
    function validateTicket($ticketDetails) {
       
        $companyDetails = $this->db->select('sponsor_id', FALSE)
						   ->where('id_firma', $this->session->userdata('user')['id'])
                           ->get('firma')->row_array();
        $sponsorId = $companyDetails['sponsor_id'];
		
        $CI = get_instance();
        $CI -> load -> model('users_actions');
        //scoate parinti clientului
        $parents = array();
        $CI->users_actions->getUserParents($ticketDetails['id_user'],$parents);
		
		//calculeaza suma pentru cele 3 parti
		$sum=($ticketDetails['valoare']*($ticketDetails['reducere']/100))/3;
		$dataToInsertEarnings = array();
		//contruieste query de inserare
        $dataToInsert = array();
        $dataToInsert['id_user'] = 11;
        $dataToInsert['id_user_from'] = $ticketDetails['id_user'];
        $dataToInsert['ticket'] = $ticketDetails['ticket'];
        $dataToInsert['suma'] = $sum;
        $dataToInsert['data'] = date("Y-m-d");
        $dataToInsert['bifat'] = 1;
        $dataToInsertEarnings[] = $dataToInsert;
        
        $dataToInsert = array();
		$dataToInsert['id_user'] = $ticketDetails['id_user'];
        $dataToInsert['id_user_from'] = $ticketDetails['id_user'];
        $dataToInsert['ticket'] = $ticketDetails['ticket'];
        $dataToInsert['suma'] = $sum;
        $dataToInsert['data'] = date("Y-m-d");
        $dataToInsert['bifat'] = 1;
        $dataToInsertEarnings[] = $dataToInsert;
    
		if ( isset($sponsor_id) )
		{
            /*
            $sponsorDetails = $this->db->select('id', FALSE)
						   ->where('nume', $sponsor_id)
                           ->get('user')->row_array();
			$amount = ($suma * 0.1);
			 //$suma = (($bilet->valoare/3) * 0.1)/3;
			
            $dataToInsert = array();
            $dataToInsert['id_user'] = $sponsorDetails['id_user'];
            $dataToInsert['id_user_from'] = $this->session->userdata('user')['id'];
            $dataToInsert['ticket'] = $ticketDetails['ticket'];
            $dataToInsert['suma'] = number_format($amount,2);
            $dataToInsert['data'] = date("Y-m-d");
            $dataToInsert['bifat'] = 1;
            $dataToInsertEarnings[] = $dataToInsert;*/
		}
		
		//verifica daca avem parinti deasupra
		if(count($parents)==0) {
            $dataToInsert = array();
            $dataToInsert['id_user'] = $sponsorDetails['id_user'];
            $dataToInsert['id_user_from'] = $sponsorDetails['id_user'];
            $dataToInsert['ticket'] = $ticketDetails['ticket'];
            $dataToInsert['suma'] = $sum;
            $dataToInsert['data'] = date("Y-m-d");
            $dataToInsert['bifat'] = 1;
            $dataToInsertEarnings[] = $dataToInsert;
		}
		else
		{
			
				// send mail for all parents to inform about their earning
                $rez = $this->db->select('*', FALSE)
						   ->where_in('id', $parents)
                           ->get('user')->result();
               
				$emailsToSend = [];
				foreach( $rez as $key => $value)
				{
					if( $value->email )
					{
                        array_push($emailsToSend,$value->email);
					}
				}
        
                if(!empty($emailsToSend)) {
                    $subject=$this->lang->line('Company Section Ticket Label New Earnings From Your Team');
                    $message = $this -> load -> view('company/tickets/emails/new_earnings_from_your_team', array( ),true);
                    $CI = get_instance();
                    $CI->sendEmail($to = $emailsToSend,"Loyalty Club",$message);
                }
			
			foreach($parents as $parent)
			{
                $dataToInsert = array();
                $dataToInsert['id_user'] = $parent;
                $dataToInsert['id_user_from'] = $ticketDetails['id_user'];
                $dataToInsert['ticket'] = $ticketDetails['ticket'];
                $dataToInsert['suma'] = ($sum/count($parents));
                $dataToInsert['data'] = date("Y-m-d");
                $dataToInsert['bifat'] = 1;
                $dataToInsertEarnings[] = $dataToInsert;
			}
        
        
        }
        $this->db->insert_batch('castiguri', $dataToInsertEarnings);
        $this->updateTicket(array("status" => 2, "data_validare" => date("Y-m-d")),$ticketDetails['id']);

    }

    public function downloadTickets() {
        $this->db->where_in('status', array(0,1)); 
        $this->db->where('id_firma', $this->session->userdata('user')['id']);
		return $this->db->get('tickets')->result_array();
	}

    var $table_company_tickets = 'tickets as t';
    var $column_order_company_tickets = array('t.ticket',
                              't.reducere',
                              't.valoare',
							  't.data_creare',
							  't.id_user',
							  't.status',
							  null
                             ); //set column field database for datatable orderable
    var $column_search_company_tickets = array('t.ticket',
									't.reducere',
									't.valoare',
									't.data_creare',
									't.id_user',
									't.status',
									null
                               ); //set column field database for datatable searchable 
    var $column_search_type_company_tickets = array('where','where','where','where','where','where','where'); //set where or having clause for each column
    var $order_company_tickets = array('t.id' => 'desc'); // default order 
    
    function _get_datatables_company_tickets_query() {
      
		$this->db->select(' t.id,
						    t.ticket as serialNumber,
							t.reducere as discount,
							t.valoare as value,
							t.data_creare as createdDate,
							t.id_user as clientID,
							t.status,
                          '); 
        $this->db->from($this->table_company_tickets);
       
        $i = 0;
       
        foreach ($this->column_search_company_tickets as $column_search_key => $item) { // loop column 
             
              $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if($search_value) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_company_tickets[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_company_tickets[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
        $this->db->where_in('t.status', array(0,1)); 
        $this->db->where('t.id_firma', $this->session->userdata('user')['id']);
                 
        //if(isset($_POST['order'])) {  // here order processing
            //$this->db->order_by($this->column_order_company_tickets[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        //} 
       // else if(isset($this->order)) {
            $order = $this->order_company_tickets;
            $this->db->order_by(key($order), $order[key($order)]);
      //  } 
    }

    function get_company_tickets_datatables() {
		$this->_get_datatables_company_tickets_query();
		
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
 
    function count_company_tickets_filtered() {
        $this->_get_datatables_company_tickets_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_company_tickets_all() {
        $this->db->from($this->table_company_tickets);
        $this->db->where_in('t.status', array(0,1)); 
        $this->db->where('t.id_firma', $this->session->userdata('user')['id']);
        return $this->db->count_all_results();
    }

    function getCompanyNrTickets($userId = null,$statuses = [1,2]) {
        $this->db->from('tickets as t');
        $this->db->where_in('t.status', $statuses); 
        $this->db->where('t.id_firma', ($userId ? $userId : $this->session->userdata('user')['id']));
        return $this->db->count_all_results();
    }

    function getCompanyAmountValidatedTickets($userId = null) {
        $this->db->from('tickets as t');
        $this->db->select_sum('valoare');
        $this->db->where_in('t.status', array(2)); 
        $this->db->where('t.id_firma', ($userId ? $userId : $this->session->userdata('user')['id']));
        return $this->db->get()->row_array();
    }


    var $table_user_tickets = 'tickets as t';
    var $column_order_user_tickets = array('t.ticket',
                              't.reducere',
                              't.valoare',
							  't.data_valorificare',
							  't.status'
                             ); //set column field database for datatable orderable
    var $column_search_user_tickets = array('t.ticket',
									't.reducere',
									't.valoare',
									't.data_creare',
									't.status'
                               ); //set column field database for datatable searchable 
    var $column_search_type_user_tickets = array('where','where','where','where','where'); //set where or having clause for each column
    var $order_user_tickets = array('t.id' => 'desc'); // default order 
    
    function _get_datatables_user_tickets_query() {
      
		$this->db->select(' t.id,
						    t.ticket as serialNumber,
							t.reducere as discount,
							t.valoare as value,
							t.data_valorificare as createdDate,
							t.id_user as clientID,
							t.status,
                          '); 
        $this->db->from($this->table_user_tickets);
       
        $i = 0;
       
        foreach ($this->column_search_user_tickets as $column_search_key => $item) { // loop column 
             
              $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if($search_value) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_user_tickets[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_user_tickets[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
        $this->db->where_in('t.status', array(1,2)); 
        $this->db->where('t.id_user', $this->session->userdata('user')['id']);
                 
        //if(isset($_POST['order'])) {  // here order processing
            //$this->db->order_by($this->column_order_company_tickets[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        //} 
       // else if(isset($this->order)) {
            $order = $this->order_user_tickets;
            $this->db->order_by(key($order), $order[key($order)]);
      //  } 
    }

    function get_user_tickets_datatables() {
		$this->_get_datatables_user_tickets_query();
		
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
 
    function count_user_tickets_filtered() {
        $this->_get_datatables_user_tickets_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_user_tickets_all() {
        $this->db->from($this->table_user_tickets);
        $this->db->where_in('t.status', array(1,2)); 
        $this->db->where('t.id_user', $this->session->userdata('user')['id']);
        return $this->db->count_all_results();
    }


	
	
}
?>