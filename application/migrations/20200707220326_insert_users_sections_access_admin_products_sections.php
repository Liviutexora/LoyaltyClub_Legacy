<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_users_sections_access_admin_products_sections extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (2,"products","index"),
                (2,"products","productsDataTables"),
                (2,"products","editProduct"),
                (2,"products","addProduct"),
                (2,"products","changeProductStatus"),
                (2,"products","deleteProduct")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "index";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "addProduct";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "productsDataTables";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "editProduct";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "changeProductStatus";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="products" 
                        and user_section_access_method_name = "deleteProduct";
                ';
                $this->db->query($sql);
        }

}