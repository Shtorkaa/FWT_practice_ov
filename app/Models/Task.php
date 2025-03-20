<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Task extends Model
{
    protected $fillable = [
        'title', 
        'user_id', 
        'status', 
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('status', 'LIKE', "%{$status}%");
    }

    public function scopeSearchByTitle($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }
}
