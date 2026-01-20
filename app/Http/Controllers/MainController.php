<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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

    public function viewQueue($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(403,'Acesso negado.');
        }

        $queue = Queue::where('id', $id)
            ->where('id_company', Auth::user()->id_company)
            ->first();

        if (!$queue) {
            abort(403,'Fila não encontrada');
        }

        $tickets = $queue->tickets()->get();

        $data = [
            'title' => 'Visualizar Fila',
            'queue' => $queue,
            'tickets' => $tickets,
        ];

        return view('queue.details', $data);
    }

    public function duplicateQueue($id)
    {
        $queue = Queue::find($id);

        if (!$queue) {
            return redirect()->route('home')->with('error', 'Fila não encontrada.');
        }

        $newQueue = $queue->replicate();
        $newQueue->hash_code = Str::random(64);
        $newQueue->save();

        return redirect()->route('queue.view', ['id' => $newQueue->id])->with('success', 'Fila duplicada com sucesso.');
    }

    public function editQueueSubmit($id)
    {
        $queue = Queue::find($id);

        if (!$queue) {
            return redirect()->route('home')->with('error', 'Fila não encontrada.');
        }

        $queue->update($request->all());

        return redirect()->route('queue.view', ['id' => $queue->id])->with('success', 'Fila editada com sucesso.');
    }

    public function deleteQueueSubmit($id)
    {
        $queue = Queue::find($id);

        if (!$queue) {
            return redirect()->route('home')->with('error', 'Fila não encontrada.');
        }

        $queue->delete();

        return redirect()->route('home')->with('success', 'Fila excluída com sucesso.');
    }
    

    public function getQueuesList()
    {
        $idCompany = Auth::user()->id_company;

        return Queue::where('id_company', $idCompany)
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
