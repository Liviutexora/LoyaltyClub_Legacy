<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_users_sections_access_datables_tickets extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (2,"company","generatedTicketsDatables"),
                (2,"company","tickets"),
                (2,"company","deleteTicket")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                                        and user_section_access_class_name ="company" 
                                        and user_section_access_method_name = "generatedTicketsDatables";

                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "tickets";
                        DELETE FROM users_sections_access WHERE user_section_access_user_type = 2 
                        and user_section_access_class_name ="company" 
                        and user_section_access_method_name = "deleteTicket";
                
                ';
        }

}