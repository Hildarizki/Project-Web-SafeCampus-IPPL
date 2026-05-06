<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // bigint
            // nullable untuk support anonymous reporting
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('set null');
            $table->foreignId('counselor_id')->nullable()->constrained('counselors')->onDelete('set null');
            $table->enum('jenis_bullying', ['verbal', 'fisik', 'siber', 'lainnya']);
            $table->text('deskripsi');
            $table->string('lokasi')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->enum('status', ['menunggu', 'diterima', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_konselor')->nullable();
            $table->timestamp('tanggal_kejadian')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};