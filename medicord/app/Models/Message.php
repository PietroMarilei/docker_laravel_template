<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id', 
        'receiver_id', 
        'message'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
