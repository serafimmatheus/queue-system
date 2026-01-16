<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->hasMany(User::class, 'id_company');
    }

    public function queues()
    {
        return $this->hasMany(Queue::class, 'id_company');
    }
}
