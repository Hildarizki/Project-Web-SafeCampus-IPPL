<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Report;
use App\Models\Conversation;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'nim', 'program_studi', 'fakultas', 'angkatan',
    ];
 
    public function user()          { return $this->belongsTo(User::class); }
    public function reports()       { return $this->hasMany(Report::class); }
    public function conversations() { return $this->hasMany(Conversation::class); }
}
