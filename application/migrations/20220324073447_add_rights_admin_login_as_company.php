<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_rights_admin_login_as_company extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (3,"admin","loginAsCompany")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
              
        }

}