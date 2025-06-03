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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('letter_id')->constrained('letters')->onDelete('cascade');
            $table->enum('action_taken', ['SP', 'VP', 'SO', 'PD', 'OP', 'FL', 'SPL', 'SOP', 'VOP', 'SLOP']);
            $table->string('cause_by_admin');
            $table->string('with_f6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
