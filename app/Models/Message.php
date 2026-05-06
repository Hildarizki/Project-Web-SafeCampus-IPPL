<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;
use App\Models\User;

class Message extends Model
{
    protected $fillable = [
        'conversation_id', 'sender_id', 'pesan',
        'is_encrypted', 'is_read', 'read_at', 'sent_at',
    ];
 
    protected $casts = [
        'is_encrypted' => 'boolean',
        'is_read'      => 'boolean',
        'read_at'      => 'datetime',
        'sent_at'      => 'datetime',
    ];
 
    public function conversation() { return $this->belongsTo(Conversation::class); }
    public function sender()       { return $this->belongsTo(User::class, 'sender_id'); }
}
