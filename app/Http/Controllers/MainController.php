<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $queues = $this->getQueuesList();

        $data = [
            'title' => 'Home',
            'queues' => $queues,
        ];

        return view('home', $data);
    }

    public function getQueuesList()
    {
        $idCompany = Auth::user()->id_company;

        return Queue::where('id_company', $idCompany)
        ->where('status', 'active')
        ->withCount([
            'tickets as total_tickets' => function ($query) {
                $query
                ->whereNotNull('queue_ticket_called_at')
                ->whereNull('deleted_at');
            },
            'tickets as total_called' => function ($query) {
                $query
                ->where('queue_ticket_status', 'called')
                ->whereNull('deleted_at');
            },
            'tickets as total_not_attended' => function ($query) {
                $query
                ->where('queue_ticket_status', 'not_attended')
                ->whereNull('deleted_at');
            },
            'tickets as total_dismissed' => function ($query) {
                $query
                ->where('queue_ticket_status', 'dismissed')
                ->whereNull('deleted_at');
            },
            'tickets as total_waiting' => function ($query) {
                $query
                ->where('queue_ticket_status', 'waiting')
                ->whereNull('deleted_at');
            },
        ])
        ->orderBy('name', 'asc')
        ->get();

    }
}
