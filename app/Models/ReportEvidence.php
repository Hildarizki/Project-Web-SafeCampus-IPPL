<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Report;

class ReportEvidence extends Model
{
    protected $table = 'report_evidences';
    protected $fillable = [
        'report_id', 'nama_file', 'url_file', 'tipe_file', 'ukuran_file',
    ];
 
    public function report() { return $this->belongsTo(Report::class); }
}
