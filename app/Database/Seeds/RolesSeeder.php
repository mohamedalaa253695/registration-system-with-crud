<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
	public function run()
	{
		 $data = [
                        'name' => 'manager'
                        
	                ];

                // Simple Queries
                $this->db->query("INSERT INTO roles (name) VALUES(:name:)",
                        $data
                );

           // Using Query Builder
                $this->db->table('roles')->insert($data);

    }    
	

}

