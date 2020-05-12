<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_countries_table extends CI_Migration {

        public function up()
        {
             
                $sql = file_get_contents(dirname(__FILE__)."/countries.sql");
                mysqli_multi_query($this->db->conn_id,$sql);
               
        }

        public function down()
        {
                /*
                $sql = 'DROP table countries;';
                $this->db->query($sql); */
        }

}