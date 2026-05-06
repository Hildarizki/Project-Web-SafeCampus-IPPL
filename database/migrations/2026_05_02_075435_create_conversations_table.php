<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id(); // bigint
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('counselor_id')->constrained('counselors')->onDelete('cascade');
            $table->foreignId('report_id')->nullable()->constrained('reports')->onDelete('set null');
            $table->boolean('is_emergency')->default(false); // panic button
            $table->boolean('is_active')->default(true);
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};