<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_user_type_pages_table extends CI_Migration {

        public function up()
        {
                $fields = array('user_type' => array( 'type' => 'varchar',
                                               'constraint' => 255)
                                );
                $this->dbforge->add_column('pagini', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('pagini', 'user_type');
        }
}