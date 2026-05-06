<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Article extends Model
{
    use SoftDeletes;
 
    protected $fillable = [
        'admin_id', 'judul', 'isi', 'penulis',
        'thumbnail_url', 'kategori', 'is_published', 'published_at',
    ];
 
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
 
    public function admin() { return $this->belongsTo(User::class, 'admin_id'); }

}
