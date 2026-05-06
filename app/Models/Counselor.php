<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Report;
use App\Models\Conversation;

class Counselor extends Model
{
    protected $fillable = [
        'user_id', 'spesialisasi', 'is_available', 'bio', 'no_lisensi',
    ];
 
    protected $casts = ['is_available' => 'boolean'];
 
    public function user()          { return $this->belongsTo(User::class); }
    public function reports()       { return $this->hasMany(Report::class); }
    public function conversations() { return $this->hasMany(Conversation::class); }
}
