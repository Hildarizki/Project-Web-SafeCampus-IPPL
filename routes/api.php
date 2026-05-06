<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CounselorController;

// ---- Public ----
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
 
// ---- Auth Required ----
Route::middleware('auth:sanctum')->group(function () {
 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);
 
    // Notifikasi (semua role)
    Route::get('/notifications',                    [NotificationController::class, 'index']);
    Route::patch('/notifications/read-all',         [NotificationController::class, 'markAllRead']);
    Route::patch('/notifications/{id}/read',        [NotificationController::class, 'markRead']);
 
    // Artikel - read (semua role)
    Route::get('/articles',      [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
 
    // Kuis - read & submit (semua role)
    Route::get('/quizzes',              [QuizController::class, 'index']);
    Route::get('/quizzes/{id}',         [QuizController::class, 'show']);
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submit']);
    Route::get('/quiz-results',         [QuizController::class, 'myResults']);
 
    // Konselor tersedia (mahasiswa lihat daftar konselor)
    Route::get('/counselors/available', [CounselorController::class, 'available']);
 
    // ---- Mahasiswa Only ----
    Route::middleware('role:mahasiswa')->group(function () {
        Route::post('/reports',      [ReportController::class, 'store']);
        Route::get('/reports/my',    [ReportController::class, 'myReports']);
        Route::get('/reports/{id}',  [ReportController::class, 'show']);
 
        Route::post('/conversations',                    [ChatController::class, 'startConversation']);
        Route::get('/conversations',                     [ChatController::class, 'myConversations']);
        Route::get('/conversations/{id}',                [ChatController::class, 'showConversation']);
        Route::post('/conversations/{id}/messages',      [ChatController::class, 'sendMessage']);
    });
 
    // ---- Konselor Only ----
    Route::middleware('role:konselor')->group(function () {
        Route::get('/reports',                  [ReportController::class, 'index']);
        Route::patch('/reports/{id}/status',    [ReportController::class, 'updateStatus']);
        Route::patch('/reports/{id}/assign',    [ReportController::class, 'assignToSelf']);
 
        Route::get('/conversations',                 [ChatController::class, 'myConversations']);
        Route::get('/conversations/{id}',            [ChatController::class, 'showConversation']);
        Route::post('/conversations/{id}/messages',  [ChatController::class, 'sendMessage']);
        Route::patch('/conversations/{id}/end',      [ChatController::class, 'endConversation']);
 
        Route::patch('/counselor/availability', [CounselorController::class, 'updateAvailability']);
    });
 
    // ---- Admin Only ----
    Route::middleware('role:admin')->group(function () {
        Route::post('/articles',          [ArticleController::class, 'store']);
        Route::put('/articles/{id}',      [ArticleController::class, 'update']);
        Route::delete('/articles/{id}',   [ArticleController::class, 'destroy']);
 
        Route::post('/quizzes',           [QuizController::class, 'store']);
        Route::put('/quizzes/{id}',       [QuizController::class, 'update']);
 
        Route::get('/users',              [AuthController::class, 'listUsers']);
        Route::patch('/users/{id}/verify',[AuthController::class, 'verifyUser']);
    });
});