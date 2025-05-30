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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('log_date');
            $table->timestamp('am_in')->nullable();
            $table->timestamp('am_out')->nullable();
            $table->timestamp('pm_in')->nullable();
            $table->timestamp('pm_out')->nullable();
            $table->enum('status', ['present', 'absent', 'onLeave'])->default('absent');
            $table->integer('undertime')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
