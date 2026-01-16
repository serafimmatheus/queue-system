<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'id_company' => 0,
                'role' => 'sys_admin',
                'active' => true,
            ],
            [
                'email' => 'client-admin@client-admin.com',
                'password' => bcrypt('password'),
                'id_company' => 1,
                'role' => 'client-admin',
                'active' => true,
            ],
            [
                'email' => 'client-user@client-user.com',
                'password' => bcrypt('password'),
                'id_company' => 1,
                'role' => 'client-user',
                'active' => true,
            ],
        ];

        DB::table('users')->insert($users);

        echo count($users) . " Users seeded successfully";
    }
}
