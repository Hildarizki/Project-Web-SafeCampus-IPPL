<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id(); // bigint
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->integer('urutan')->default(0);
            // opsi jawaban: [{"label": "Tidak pernah", "skor": 0}, ...]
            $table->json('opsi_jawaban')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};