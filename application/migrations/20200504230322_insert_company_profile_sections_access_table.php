<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_company_profile_sections_access_table extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
           
                (2,"company","myProfile"),
                (2,"company","changeCoverImage"),
                (2,"company","changeAvatarImage"),
                (2,"company","editProfileInfo"),
                (2,"company","changePassword"),
                (2,"company","changeEmail"),
                (2,"company","confirmEmailAddress")
            
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = '
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "myProfile";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "changeCoverImage";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "changeAvatarImage";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "editProfileInfo";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "changePassword";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "changeEmail";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "confirmEmailAddress";
                ';
                $this->db->query($sql); 
        }

}