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
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->enum('department', ['BSIT', 'BSMATH', 'BSCE', 'BSED', 'BSCoE', 'BSME', 'BSE', 'BSA', 'BSECE', 'ABEL', 'NI', 'BSEE']);
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'ni', 'ins']);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
