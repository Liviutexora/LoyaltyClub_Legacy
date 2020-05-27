<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_main_activity_companies_activities_table extends CI_Migration {

        public function up()
        {
                $fields = array('main' => array( 'type' => 'tinyint',
                                               'constraint' => 1, "default" => 0)      
                                );
                $this->dbforge->add_column('firma_activitate', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('firma_activitate', 'main');
        }
}