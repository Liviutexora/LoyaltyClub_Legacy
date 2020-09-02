<?php
class Products_actions extends CI_model
{
	
	public function deleteProduct($id) {
		$this->db->where('id', $id);
		$this->db->delete('produse');
	}

	function checkProduct($id) {
		return $this->db->select('*', FALSE)
						   ->where('id', $id)
						   ->get('produse')->row_array();
    }
    function getCompanyProducts($companyId,$allRows = false,$offset = 10) {
		 $this->db->select('*', FALSE)
                           ->where('parinte', $companyId)
                           ->where('status', 1)
                           ->where('deleted', 0);    
        if(!$allRows) {

            $start = 0;
            if($this->input->get('page')) {
                $start = $this->input->get('page')*$offset;
                $start = $start - $offset;
            }
        }
        if(!$allRows) {
            $this->db->limit($offset,$start);
        }
      
        return $this->db->get('produse')->result_array();
    }

    function checkProductImage($id) {
		return $this->db->select('*', FALSE)
						   ->where('product_photo_id', $id)
						   ->get('products_photos')->row_array();
    }

    public function deleteProductImage($id) {
		$this->db->where('product_photo_id', $id);
		$this->db->delete('products_photos');
	}
    
    function updateProduct($data,$id) {
		$this->db->where('id', $id);
		$this->db->update('produse', $data);
    }
   

    var $table_products = 'produse as p';
    var $column_order_products = array('p.titlu',
                              'p.descriere',
                              'p.pret',
                              'p.promotie',
							  'p.status'
                             ); //set column field database for datatable orderable
    var $column_search_products = array('p.titlu',
                                        'p.descriere',
                                        'p.pret',
                                        'p.promotie',
                                        'p.status'
                               ); //set column field database for datatable searchable 
    var $column_search_type_products = array('where','where','where','where'); //set where or having clause for each column
    var $order_products = array('p.id' => 'desc'); // default order 
    
    function _get_datatables_products_query() {
      
		$this->db->select(' p.id,
						    p.titlu as title,
							p.descriere as description,
                            p.pret as price,
                            p.promotie as discount,
							p.status as status
                          '); 
        $this->db->from($this->table_products);
       
        $i = 0;
       
        foreach ($this->column_search_products as $column_search_key => $item) { // loop column 
             
              $search_value = (isset($_POST['columns'][$column_search_key]['search']['value']) ? $_POST['columns'][$column_search_key]['search']['value'] : "");
              //var_dump($_POST['columns'][$column_search_key]['search']['value']);die();
              if($search_value) { // if datatable send POST for search 

                  if($i===0) { // first loop
                      // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                      if($this->column_search_type_products[$column_search_key] == 'where') {
                          $this->db->like($item, $search_value);
                      } else {
                          $this->db->having($item."= ", $search_value);
                      }
                      
                  } else {
                      if($this->column_search_type_products[$column_search_key] == 'where') {
                           $this->db->like($item, $search_value);
                      } else {
                           $this->db->having($item."= ",$search_value);
                      }
                  }
              }
              $i++;
          }
        
          $this->products_datatables_where_conditions();        
        //if(isset($_POST['order'])) {  // here order processing
            //$this->db->order_by($this->column_order_products[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        //} 
       // else if(isset($this->order)) {
            $order = $this->order_products;
            $this->db->order_by(key($order), $order[key($order)]);
      //  } 
    }

    function get_products_datatables() {
		$this->_get_datatables_products_query();
		
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
 
    function count_products_filtered() {
        $this->_get_datatables_products_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_products_all() {
        $this->db->from($this->table_products);
        $this->products_datatables_where_conditions();
        return $this->db->count_all_results();
    }

    function products_datatables_where_conditions() {
        $this->db->where_in('p.status', array(0,1)); 
        $this->db->where_in('p.deleted', array(0));
        $this->db->where('p.parinte', $this->session->userdata('user')['id']);
    }

    function insertProduct($data)
	{
		$this->db->insert('produse', $data);
    }

    function insertProductPhoto($data)
	{
		$this->db->insert('products_photos', $data);
    }

    public function getProductPhotos($productId) {
        $this->db->where('product_photo_product_id', $productId);
		return $this->db->get('products_photos')->result_array();
    }
    
    public function deleteProductPhoto($productPhotoId) {
        $this->db->delete('products_photos', array('product_photo_id' => $productPhotoId));
    }

   

    
    

	
	
}
?>