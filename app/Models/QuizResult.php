<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quiz;

class QuizResult extends Model
{
    protected $fillable = [
        'user_id', 'quiz_id', 'skor', 'interpretasi', 'saran', 'detail_jawaban',
    ];
 
    protected $casts = ['detail_jawaban' => 'array'];
 
    public function user() { return $this->belongsTo(User::class); }
    public function quiz() { return $this->belongsTo(Quiz::class); }
}
