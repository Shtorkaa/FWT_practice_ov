<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Status extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
