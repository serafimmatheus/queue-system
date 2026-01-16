<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'company_name' => 'Company 1',
                'company_logo' => 'company_logo_01.png',
                'uuid' => Str::uuid(),
                'address' => 'Address 1',
                'phone' => '1234567890',
                'email' => 'company1@company1.com',
                'status' => 'active',
                'deleted_at' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'company_name' => 'Company 2',
                'company_logo' => 'company_logo_02.png',
                'uuid' => Str::uuid(),
                'address' => 'Address 2',
                'phone' => '0987654321',
                'email' => 'company2@company2.com',
                'status' => 'active',
                'deleted_at' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ],
        ];

        DB::table('companies')->insert($companies);

        echo count($companies) . " Companies seeded successfully.\n";
    }
}
