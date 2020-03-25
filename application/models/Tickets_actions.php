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
			$data = array("ticket" => $ticket, "id_firma" => $this->session->userdata('user')['id'], "data_creare" => date("Y-m-d"));
			$this->db->insert('tickets', $data);
		}

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


	
	
}
?>