<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_charset_to_utf8_all_tables extends CI_Migration {

        public function up()
        {
                $this->db->query("ALTER TABLE `pagini` MODIFY COLUMN `titlu_eng` varchar(255) CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `pagini` MODIFY COLUMN `titlu` varchar(255) CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `pagini` MODIFY COLUMN `text` TEXT CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `pagini` MODIFY COLUMN `text_eng` TEXT CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `categorii-produse` MODIFY COLUMN `titlu_eng` varchar(255) CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `categorii-produse` MODIFY COLUMN `titlu` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `firma` MODIFY COLUMN `description` TEXT  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `firma` MODIFY COLUMN `nume_firma` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `firma` MODIFY COLUMN `district`varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `firma` MODIFY COLUMN `locality`varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `firma` MODIFY COLUMN `street`varchar(255) CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `intrebari` MODIFY COLUMN `nume` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `intrebari` MODIFY COLUMN `intrebare` TEXT CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `intrebari` MODIFY COLUMN `raspuns` TEXT  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `produse` MODIFY COLUMN `titlu` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `produse` MODIFY COLUMN `descriere` TEXT  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `produse` MODIFY COLUMN `producator` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `user` MODIFY COLUMN `nume` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `user` MODIFY COLUMN `username` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `user` MODIFY COLUMN `localitate` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `user` MODIFY COLUMN `judet` varchar(255)  CHARACTER SET utf8 ;");
                $this->db->query("ALTER TABLE `user` MODIFY COLUMN `adresa` varchar(255)  CHARACTER SET utf8 ;");

        }

        public function down()
        {
                
        }
}