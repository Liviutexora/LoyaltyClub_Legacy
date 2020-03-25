<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users_sections_access_table extends CI_Migration {

        public function up()
        {
                // add modules items tables
                $fields = array(
                        'user_section_access_id' => array(
                        'type'      => 'INT',
                        'constraint'  => 11,
                        'unsigned'    => TRUE,
                        'auto_increment'=> TRUE
                        ),
                        'user_section_access_user_id' => array(
                        'type'      => 'INT',
                        'constraint'  => 11,
                        ),
                        'user_section_access_class_name' => array(
                        'type'      => 'VARCHAR',
                        'constraint'  => 255,
                        ),
                        'user_section_access_method_name' => array(
                        'type'      => 'VARCHAR',
                        'constraint'  => 255,
                        ),
                        'user_section_access_user_type' => array(
                        'type'      => 'VARCHAR',
                        'constraint'  => 255,
                        ),
                        'user_section_access_allowed' => array(
                        'type'      => 'TINYINT',
                        'constraint'  => 1,
                        'default' => 1
                        )
                );
                $this->dbforge->add_field($fields);
                $attributes = array('ENGINE' => 'InnoDB');
                $this->dbforge->add_key('user_section_access_id', TRUE);
                $this->dbforge->create_table('users_sections_access', TRUE, $attributes);
        }

        public function down()
        {
                $this->dbforge->drop_table('users_sections_access');
        }
}