<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // bigint auto increment
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['mahasiswa', 'konselor', 'admin'])->default('mahasiswa');
            $table->boolean('is_verified')->default(false);
            $table->string('phone')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};