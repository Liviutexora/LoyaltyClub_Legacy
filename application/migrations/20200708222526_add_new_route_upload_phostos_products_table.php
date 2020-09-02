<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_route_upload_phostos_products_table extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (2,"products","uploadPhotos")
                ';
                 $this->db->query($sql); 
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "uploadPhotos";
                ';
                $this->db->query($sql);
        }
}