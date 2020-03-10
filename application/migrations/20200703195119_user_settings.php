<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_User_settings extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'settings_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),'settings_user_id' => array(
                            'type' => 'INT',
                            'constraint' => 10
                        ),
                        'settings_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'settings_value' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        )
                ));
                $this->dbforge->add_key('settings_id', TRUE);
                $this->dbforge->create_table('user_settings');
        }

        public function down()
        {
                $this->dbforge->drop_table('user_settings');
        }
}