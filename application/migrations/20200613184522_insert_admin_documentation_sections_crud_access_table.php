<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_admin_documentation_sections_crud_access_table extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                        (3,"admin","addPage"),
                        (3,"admin","deletePage"),
                        (3,"admin","editPage"),
                        (3,"admin","changePageStatus")
                       

                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = '
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "addPage";

                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "editPage";

                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "deletePage";

                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "changePageStatus";
                ';
                $this->db->query($sql); 
        }

}