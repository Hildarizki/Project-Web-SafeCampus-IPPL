<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('counselors', function (Blueprint $table) {
            $table->id(); // bigint
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('spesialisasi')->nullable();
            $table->boolean('is_available')->default(false);
            $table->text('bio')->nullable();
            $table->string('no_lisensi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('counselors');
    }
};