<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Task extends Model
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'title',
        'content',
        'tools_used',
        'category',
        'due_date',
        'posted_by',
        'picked_up_by',
        'status',
    ];

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function pickedUpBy()
    {
        return $this->belongsTo(User::class, 'picked_up_by');
    }
}
