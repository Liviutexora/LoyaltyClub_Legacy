<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_users_sections_access_admin_companies_sections extends CI_Migration {

        public function up()
        {
                $sql = 'INSERT INTO users_sections_access (user_section_access_user_type,user_section_access_class_name,user_section_access_method_name) VALUES
                (3,"admin","companies"),
                (3,"admin","companiesDataTables"),
                (3,"admin","editCompany"),
                (3,"admin","changeCompanyStatus"),
                (3,"admin","deleteCompany"),
                (3,"admin","generateCompanyInvoice")
                ';
                 $this->db->query($sql); 
          
        }

        public function down()
        {
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "companies";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "companiesDataTables";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "editCompany";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "changeCompanyStatus";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "deleteCompany";
                ';
                $this->db->query($sql);
                $sql = 'DELETE FROM users_sections_access WHERE user_section_access_user_type = 3 
                        and user_section_access_class_name ="admin" 
                        and user_section_access_method_name = "generateCompanyInvoice";
                ';
                $this->db->query($sql);
        }

}