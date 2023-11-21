<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('rut_dni')->primary();
            $table->string('name');
            $table->string('lastname');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('points')->nullable();
            $table->string('role')->default('user');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
