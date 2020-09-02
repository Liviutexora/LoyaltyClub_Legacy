<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_deleted_column_products_table extends CI_Migration {

        public function up()
        {
                $fields = array('deleted' => array( 'type' => 'TINYINT',
                                                            'constraint' => 1,
                                                        'default' => 0)
                                );
                $this->dbforge->add_column('produse', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('produse', 'deleted');
        }
}