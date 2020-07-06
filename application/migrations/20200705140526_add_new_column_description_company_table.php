<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_description_company_table extends CI_Migration {

        public function up()
        {
                $fields = array('description' => array( 'type' => 'text',
                                                        'default' => null)
                                );
                $this->dbforge->add_column('firma', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('firma', 'description');
        }
}