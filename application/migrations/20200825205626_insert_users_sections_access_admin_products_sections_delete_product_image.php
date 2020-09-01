<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_users_sections_access_admin_products_sections_delete_product_image extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (2,"products","deleteProductImage")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "deleteProductImage";
                ';
        }

}