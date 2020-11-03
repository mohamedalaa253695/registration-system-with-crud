<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
{
	public function up()
	{
		 $this->forge->addField([
                    'id'                    => ['type' => 'INT'    , 'constraint' => 5   , 'unsigned' => true,'auto_increment' => true ],
                    'role_id'               => ['type' => 'INT'    , 'constraint' => 10  , 'unsigned' => true],
                    'name'                  => ['type' => 'VARCHAR', 'constraint' => 191 , 'null' => false],
                    'email'		            => ['type' => 'VARCHAR', 'constraint' => 191 , 'null' => false],
                    'new_email'             => ['type' => 'varchar', 'constraint' => 191, 'null' => true],
                    'password_hash'          => ['type' => 'varchar', 'constraint' => 191],
                    'phone_number'          => ['type' => 'INT'    , 'constraint' => 11  , 'null' => true],
                    'address'               => ['type' =>'VARCHAR' , 'constraint' => 191 , 'null' =>true],
                    'reset_hash'            => ['type' => 'varchar', 'constraint' => 191, 'null' => true],
        	        'reset_expires'        	=> ['type' => 'bigint', 'null' => true],
                    'activate_hash'         => ['type' => 'varchar', 'constraint' => 191 , 'null' => true],
                    'is_active'             => ['type' => 'tinyint', 'constraint' => 1   , 'null' => 0, 'default' => 0],
                    'created_at'            => ['type' => 'bigint' , 'null' => true],
                    'updated_at'            => ['type' => 'bigint' , 'null' => true]
       

                ]);
                $this->forge->addKey('id', true);
                $this->forge->addUniqueKey('email');
                $this->forge->createTable('users');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
