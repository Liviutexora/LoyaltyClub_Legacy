<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_new_columns_change_email_user_table extends CI_Migration {

        public function up()
        {
                $fields = array('tokenChangeEmail' => array( 'type' => 'VARCHAR',
                                               'constraint' => 255),
                                'emailToChange' => array( 'type' => 'VARCHAR',
                                'constraint' => 255)
                                );
                $this->dbforge->add_column('user', $fields);;
        }

        public function down()
        {
                $this->dbforge->drop_column('user', 'tokenChangeEmail');
                $this->dbforge->drop_column('user', 'emailToChange');
        }
}