<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_rights_invoices_payments extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (2,"invoices","viewInvoice"),
                (3,"invoices","viewInvoice"),
                (2,"company","payments"),
                (2,"company","archives"),
                (2,"company","invoices")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
              
        }

}