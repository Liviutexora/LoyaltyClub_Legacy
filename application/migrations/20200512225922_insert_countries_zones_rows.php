<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_countries_zones_rows extends CI_Migration {

        public function up()
        {
                $sql = file_get_contents(dirname(__FILE__)."/country_zones.sql");
                mysqli_multi_query($this->db->conn_id,$sql);
                $conn = $this->db->conn_id;
                do {
                if ($result = mysqli_store_result($conn)) {
                        mysqli_free_result($result);
                }
                } while (mysqli_more_results($conn) && mysqli_next_result($conn));
        }

        public function down()
        {
               
        }

}