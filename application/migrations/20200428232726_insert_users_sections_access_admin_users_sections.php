<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_users_sections_access_admin_users_sections extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (3,"welcome","index"),
                (3,"admin","users"),
                (3,"admin","usersDataTables"),
                (3,"admin","editUser"),
                (3,"admin","changeUserStatus"),
                (3,"admin","deleteUser"),
                (3,"admin","generateUserLegitimation")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="welcome" 
                        and user_section_access_method_name = "index";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "users";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "usersDataTables";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "editUser";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "changeUserStatus";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "deleteUser";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "generateUserLegitimation";
                ';
                $this->db->query($sql);
        }

}