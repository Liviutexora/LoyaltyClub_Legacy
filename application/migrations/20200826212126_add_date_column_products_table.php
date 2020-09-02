<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_date_column_products_table extends CI_Migration {

        public function up()
        {
                $fields = array('created_at' => array( 'type' => 'DATETIME',
                                                        'default' => NULL)
                                );
                $this->dbforge->add_column('produse', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('produse', 'created_at');
        }
}