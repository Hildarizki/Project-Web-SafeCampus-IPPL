<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;
use App\Models\Counselor;
use App\Models\Notification;
use App\Models\QuizResult;
use App\Models\Article;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes, Notifiable;
 
    protected $fillable = [
        'name', 'email', 'password', 'role', 'is_verified', 'phone',
    ];
 
    protected $hidden = ['password', 'remember_token'];
 
    protected $casts = [
        'is_verified' => 'boolean',
        'password'    => 'hashed',
    ];
 
    // Relasi
    public function student()       { return $this->hasOne(Student::class); }
    public function counselor()     { return $this->hasOne(Counselor::class); }
    public function notifications() { return $this->hasMany(Notification::class); }
    public function quizResults()   { return $this->hasMany(QuizResult::class); }
    public function articles()      { return $this->hasMany(Article::class, 'admin_id'); }
 
    // Helper role
    public function isMahasiswa() { return $this->role === 'mahasiswa'; }
    public function isKonselor()  { return $this->role === 'konselor'; }
    public function isAdmin()     { return $this->role === 'admin'; }
}
