<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueTicket extends Model
{
    use SoftDeletes;

    public function queue()
    {
        return $this->belongsTo(Queue::class, 'id_queue');
    }
}
