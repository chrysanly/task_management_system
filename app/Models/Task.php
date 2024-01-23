<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'description', 'status', 'is_deleted',
    ];

    public function subtasks()
    {
        return $this->hasMany(SubTask::class);
    }
    public function files()
    {
        return $this->hasMany(TaskImages::class);
    }
}
