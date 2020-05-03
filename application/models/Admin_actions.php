<?php
class Admin_actions extends CI_model
{
    var $table_users = 'user as u';
    var $column_order_users = array(
                                    'u.id',
                                    's.nume',
                                    'u.email',
                                    'u.telefon`',
                                    'iban',
                                    'u.adresa',
                                    'u.status'
                             ); //set column field database for datatable orderable
    var $column_search_users = array(
                                    'u.nume',
                                     's.nume',
                                     'u.email',
                                     'u.telefon`',
                                     'iban',
                                     'u.adresa',
                                     'u.status',
                                    
                               ); //set column field database for datatable searchable 
    var $column_search_type_users = array('where','where','where','where','where','where','where','where'); //set where or having clause for each column
    var $order_users = array('u.id' => 'desc'); // default order 
    
    function _get_datatables_users_query() {
      
		$this->db->select(' u.nume as userName,
						    s.nume as referrerName,
							u.email,
							u.telefon as phone,
							c.iban,
                            u.adresa as address,
                            u.status,
                            u.id
                          '); 
        $this->db->from($this->table_users);
        $this->db->join('contact as c',"u.id = c.id_user","LEFT");
        $this->db->join('user as s',"c.sponsor = s.id","LEFT");
        $i = 0;
       
        foreach ($this->column_search_users as $column_search_key => $item) { // loop column 
             $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
             switch ($item) {
                case 'u.status':
                    switch (strtolower($search_value)) {
                        case 'e':
                        case 'en':
                        case 'ena':
                        case 'enab':
                        case 'enabl':
                        case 'enable':
                        case 'enabled':
                            $search_value = 1;
                        break;

                        case 'd':
                        case 'di':
                        case 'dis':
                        case 'disa':
                        case 'disab':
                        case 'disabl':
                        case 'disable':
                        case 'disabled':
                            $search_value = 0;
                        break;
                    }
                   
                    break;
                default:
                
                break;
              }

           
             
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if(!empty($search_value) || $search_value == 0) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open brackeu. query Where with OR clause better with brackeu. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_users[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_users[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
          $this->users_datatables_where_conditions();
                 
        if(isset($_POST['order'])) {  // here order processing
            $this->db->order_by($this->column_order_users[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)) {
            $order = $this->order_users;
            $this->db->order_by(key($order), $order[key($order)]);
        } 
    }

    function get_users_datatables() {
		$this->_get_datatables_users_query();
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function users_datatables_where_conditions() {
        $this->db->where_in('u.tip',1);
        $this->db->where('u.deleted',0);
    }
 
    function count_users_filtered() {
        $this->_get_datatables_users_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_users_all() {
        $this->db->from($this->table_users);
        $this->users_datatables_where_conditions();
        //$this->db->where('u.id_firma', $this->session->userdata('user')['id']);
        return $this->db->count_all_results();
    }
    
    function _get_datatables_companies_query() {
        $this->amountSql = "(SELECT SUM(`valoare`*`reducere`/100) AS `suma` FROM `tickets` 
        WHERE `status`=2  AND `id_firma`=comp.id_firma and id_factura = 0)";
        $this->table_companies = 'user as u';
        $this->column_order_companies = array(
                'comp.nume_firma',
                'u.nume',
                ''.$this->amountSql.'',
                'u.email',
                'u.telefon`',
                'comp.iban',
                'comp.nr_orc',
                'comp.cui',
                'comp.sponsor_id',
                'comp.street',
                'u.status'
        ); //set column field database for datatable orderable
        $this->column_search_companies = array(
            'comp.nume_firma',
            'u.nume',
            ''.$this->amountSql.'',
            'u.email',
            'u.telefon`',
            'comp.iban',
            'comp.nr_orc',
            'comp.cui',
            'comp.sponsor_id',
            'comp.street',
            'u.status'
            
       ); //set column field database for datatable searchable 
       $this->column_search_type_companies = array('where','where','where','where','where','where','where','where','where','where','where'); //set where or having clause for each column
       $this->order_companies = array('u.id' => 'desc'); // default order 

        $this->db->select(' comp.nume_firma as companyName,
                            u.nume as userName,
                            u.email,
                            '.$this->amountSql.' as amount,
							u.telefon as phone,
							comp.iban,
                            comp.nr_orc,
                            comp.cui,
                            comp.sponsor_id as reference,
                            comp.street,
                            u.status,
                            u.id
                          '); 
        $this->db->from($this->table_companies);
        $this->db->join('firma as comp',"u.id = comp.id_firma","INNER");
        $i = 0;
       
        foreach ($this->column_search_companies as $column_search_key => $item) { // loop column 
             $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
             switch ($item) {
                case 'u.status':
                    switch (strtolower($search_value)) {
                        case 'e':
                        case 'en':
                        case 'ena':
                        case 'enab':
                        case 'enabl':
                        case 'enable':
                        case 'enabled':
                            $search_value = 1;
                        break;

                        case 'd':
                        case 'di':
                        case 'dis':
                        case 'disa':
                        case 'disab':
                        case 'disabl':
                        case 'disable':
                        case 'disabled':
                            $search_value = 0;
                        break;
                    }
                   
                    break;
                default:
                
                break;
              }

           
             
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if(!empty($search_value) || $search_value === 0) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open brackeu. query Where with OR clause better with brackeu. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_companies[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_companies[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
          $this->companies_datatables_where_conditions();
                 
        if(isset($_POST['order'])) {  // here order processing
            $this->db->order_by($this->column_order_companies[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)) {
            $order = $this->order_companies;
            $this->db->order_by(key($order), $order[key($order)]);
        } 
    }

    function get_companies_datatables() {
		$this->_get_datatables_companies_query();
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function companies_datatables_where_conditions() {
        $this->db->where_in('u.tip',2);
        $this->db->where('u.deleted',0);
    }
 
    function count_companies_filtered() {
        $this->_get_datatables_companies_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_companies_all() {
        $this->db->from($this->table_companies);
        $this->companies_datatables_where_conditions();
        //$this->db->where('u.id_firma', $this->session->userdata('user')['id']);
        return $this->db->count_all_results();
    }

}
?>