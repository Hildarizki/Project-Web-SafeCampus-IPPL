<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_evidences', function (Blueprint $table) {
            $table->id(); // bigint
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('url_file');
            $table->string('tipe_file'); // image/jpeg, video/mp4, dll
            $table->unsignedBigInteger('ukuran_file')->nullable(); // bytes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_evidences');
    }
};