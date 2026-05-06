<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Counselor;
use App\Models\Report;
use App\Models\Message;

class Conversation extends Model
{
    protected $fillable = [
        'student_id', 'counselor_id', 'report_id',
        'is_emergency', 'is_active', 'ended_at',
    ];
 
    protected $casts = [
        'is_emergency' => 'boolean',
        'is_active'    => 'boolean',
        'ended_at'     => 'datetime',
    ];
 
    public function student()  { return $this->belongsTo(Student::class); }
    public function counselor(){ return $this->belongsTo(Counselor::class); }
    public function report()   { return $this->belongsTo(Report::class); }
    public function messages() { return $this->hasMany(Message::class)->orderBy('sent_at'); }
}
