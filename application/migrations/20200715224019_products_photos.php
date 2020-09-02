<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_products_photos extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'product_photo_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),'product_photo_product_id' => array(
                            'type' => 'INT',
                            'constraint' => 10
                        ),
                        'product_photo_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'product_photo_date' => array(
                                'type' => 'DATETIME',
                                'default' => null,
                        )
                ));
                $this->dbforge->add_key('product_photo_id', TRUE);
                $this->dbforge->create_table('products_photos');
        }

        public function down()
        {
                $this->dbforge->drop_table('products_photos');
        }
}