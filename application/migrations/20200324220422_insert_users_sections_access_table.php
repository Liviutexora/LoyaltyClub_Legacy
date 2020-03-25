<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_users_sections_access_table extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (1,"welcome","index"),
                (2,"welcome","index"),
                (2,"company","index"),
                (2,"company","addTickets"),
                (1,"user","enableDisableDarkMode"),
                (1,"user","myNetwork"),
                (1,"user","myProfile"),
                (1,"user","index"),
                (1,"user","changeCoverImage"),
                (1,"user","changeAvatarImage"),
                (1,"user","editProfileInfo"),
                (1,"user","changePassword"),
                (1,"user","changeEmail"),
                (1,"user","confirmEmailAddress"),
                (1,"register","logout"),
                (2,"register","logout")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                                        and user_section_access_class_name ="welcome" 
                                        and user_section_access_method_name = "index";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                                        and user_section_access_class_name ="welcome" 
                                        and user_section_access_method_name = "index";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "addTickets";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "enableDisableDarkMode";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "myNetwork";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "myProfile";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "index";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "changeCoverImage";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "changeAvatarImage";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "editProfileInfo";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "changePassword";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "changeEmail";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="user" 
                        and user_section_access_method_name = "confirmEmailAddress";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 1 
                        and user_section_access_class_name ="register" 
                        and user_section_access_method_name = "logout";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="register" 
                        and user_section_access_method_name = "logout";
                
                
                ';
        }

}