<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'judul', 'pesan', 'tipe', 'data', 'is_read', 'read_at',
    ];
 
    protected $casts = [
        'is_read' => 'boolean',
        'data'    => 'array',
        'read_at' => 'datetime',
    ];
 
    public function user() { return $this->belongsTo(User::class); }
}
