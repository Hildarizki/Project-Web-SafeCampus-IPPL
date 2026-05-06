<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;
use App\Models\Counselor;
use App\Models\ReportEvidence;

class Report extends Model
{
    use SoftDeletes;
 
    protected $fillable = [
        'student_id', 'counselor_id', 'jenis_bullying', 'deskripsi',
        'lokasi', 'is_anonymous', 'status', 'catatan_konselor', 'tanggal_kejadian',
    ];
 
    protected $casts = [
        'is_anonymous'     => 'boolean',
        'tanggal_kejadian' => 'datetime',
    ];
 
    public function student()   { return $this->belongsTo(Student::class); }
    public function counselor() { return $this->belongsTo(Counselor::class); }
    public function evidences() { return $this->hasMany(ReportEvidence::class); }
}
