<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_google_maps_url_company_table extends CI_Migration {

        public function up()
        {
                $fields = array('google_maps_url' => array( 'type' => 'VARCHAR',
                                                            'constraint' => 255,
                                                        'default' => null)
                                );
                $this->dbforge->add_column('firma', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('firma', 'google_maps_url');
        }
}