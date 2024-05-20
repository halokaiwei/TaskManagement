<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'task_progress';

    protected $fillable = [
        'task_id', 'description'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
