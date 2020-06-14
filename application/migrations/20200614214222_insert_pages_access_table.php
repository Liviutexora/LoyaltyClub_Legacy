<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_pages_access_table extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                        (1,"pages","documentation")
                       

                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = '
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="pages" 
                        and user_section_access_method_name = "documentation";
                ';
                $this->db->query($sql); 
        }

}