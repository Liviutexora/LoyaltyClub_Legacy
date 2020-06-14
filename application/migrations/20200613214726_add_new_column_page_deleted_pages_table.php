<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_page_deleted_pages_table extends CI_Migration {

        public function up()
        {
                $fields = array('deleted' => array( 'type' => 'tinyint',
                                               'constraint' => 1,
                                               'default' => 0)
                                );
                $this->dbforge->add_column('pagini', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('pagini', 'deleted');
        }
}