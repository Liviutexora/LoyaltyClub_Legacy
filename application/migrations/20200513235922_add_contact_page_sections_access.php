<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_contact_page_sections_access extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                        (2,"contact","index"),
                        (1,"contact","index")
                ';
                 $this->db->query($sql); 
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="contact" 
                        and user_section_access_method_name = "index";
                ';
                $this->db->query($sql);

                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="contact" 
                        and user_section_access_method_name = "index";
                ';
                $this->db->query($sql);
        }

}