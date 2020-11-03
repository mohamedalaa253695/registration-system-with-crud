<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
	public function run()
	{
		 $data = [
                        'name' => 'foo',
                        'email'    => 'foo@example.com',
                        'password_hash' => "$2y$10$5.WQyg4H5LWsuTNKUEaRSuRtKMihHXSbgfRILDyp.z.8PR9Tr/iX6",
                        'phone_number'  => '01152400096',
                        'activate_hash'	=> '',
                        'is_active' 	=>'1'
	                ];

                // Simple Queries
                $this->db->query("INSERT INTO users (name, email, password_hash, phone_number ,activate_hash ,is_active ) VALUES(:name:, :email:,:password_hash:,:phone_number:,:activate_hash:,:is_active:)",
                        $data
                );

           // Using Query Builder
                $this->db->table('users')->insert($data);

    }    
	

}

