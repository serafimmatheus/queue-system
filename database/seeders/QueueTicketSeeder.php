<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class QueueTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('queue_tickets')->truncate();

        $queueIds = DB::table('queues')->pluck('id')->toArray();

        foreach ($queueIds as $queueId) {
            $totalTickets = rand(50, 200);
            $createdAt = now()->addMinutes(2);
            $updatedAt = now()->addMinutes(2);
            $deletedAt = null;
            $calledAt = null;
            $callBy = null;

            for ($i = 0; $i < $totalTickets; $i++) {
                $status = '';
                $statusTmp = rand(1, 4);

                switch ($statusTmp) {
                    case 1:
                        $status = 'waiting';
                        break;
                    case 2:
                        $status = 'called';
                        break;
                    case 3:
                        $status = 'not_attended';
                        break;
                    case 4:
                        $status = 'dismissed';
                        break;
                    default:
                        $status = 'waiting';
                        break;
                }

                DB::table('queue_tickets')->insert([
                    'id_queue' => $queueId,
                    'queue_ticket_number' => $i,
                    'queue_ticket_created_at' => $createdAt,
                    'queue_ticket_called_at' => $status == 'called' ? $calledAt : null,
                    'queue_ticket_call_by' => $status == 'called' ? 'system' . rand(1, 10) : null,
                    'queue_ticket_status' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $createdAt = now()->addMinutes(2);
                $calledAt = now()->addMinutes(2);
            }
        }

        echo "Queue tickets seeded successfully.\n";
    }
}
