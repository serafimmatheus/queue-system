<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $queues = [
            [
                'id_company' => 1,
                'name' => 'Fila de Atendimento',
                'description' => 'Fila de Atendimento',
                'service_name' => 'Atendimento Geral',
                'service_desk' => 'Balcão 1',
                'queue_prefix' => 'AG',
                'queue_total_digits' => 3,
                'queue_color' => json_encode([
                    'prefix_bg_color' => '#ffff00',
                    'prefix_text_color' => '#000000',
                    'number_bg_color' => '#aaaaaa',
                    'number_text_color' => '#000000',
                ]),
                'hash_code' => Str::random(64),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id_company' => 2,
                'name' => 'Fila de Pedidos',
                'description' => 'Fila de Pedidos',
                'service_name' => 'Pedidos',
                'service_desk' => 'Balcão 2',
                'queue_prefix' => 'PD',
                'queue_total_digits' => 3,
                'queue_color' => json_encode([
                    'prefix_bg_color' => '#ffff00',
                    'prefix_text_color' => '#000000',
                    'number_bg_color' => '#aaaaaa',
                    'number_text_color' => '#000000',
                ]),
                'hash_code' => Str::random(64),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id_company' => 1,
                'name' => 'Fila prioritaria',
                'description' => 'Fila prioritaria',
                'service_name' => 'Prioritário',
                'service_desk' => 'Balcão 3',
                'queue_prefix' => 'PP',
                'queue_total_digits' => 3,
                'queue_color' => json_encode([
                    'prefix_bg_color' => '#ffff00',
                    'prefix_text_color' => '#000000',
                    'number_bg_color' => '#aaaaaa',
                    'number_text_color' => '#000000',
                ]),
                'hash_code' => Str::random(64),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ];

        DB::table('queues')->insert($queues);

        echo count($queues) . " Queues seeded successfully.\n";
    }
}
