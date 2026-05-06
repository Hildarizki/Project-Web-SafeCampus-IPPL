<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\QuizQuestion;
use App\Models\QuizResult;

class Quiz extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'is_active'];
 
    protected $casts = ['is_active' => 'boolean'];
 
    public function questions() { return $this->hasMany(QuizQuestion::class)->orderBy('urutan'); }
    public function results()   { return $this->hasMany(QuizResult::class); }
}
