<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;

class QuizQuestion extends Model
{
    protected $fillable = ['quiz_id', 'pertanyaan', 'urutan', 'opsi_jawaban'];
 
    protected $casts = ['opsi_jawaban' => 'array'];
 
    public function quiz() { return $this->belongsTo(Quiz::class); }
}
