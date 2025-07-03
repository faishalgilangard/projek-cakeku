<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeederNew extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'   => 'Faishal',
                'email'      => 'faishal@example.com',
                'password'   => password_hash('Admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username'   => 'Zidan',
                'email'      => 'zidan@example.com',
                'password'   => password_hash('User1234', PASSWORD_DEFAULT),
                'role'       => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('user')->insertBatch($data);
    }
}
