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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('letter_status', ['pending', 'approved', 'rejected']);
            $table->date('start_date');
            $table->enum('letter_action_taken', ['SP', 'VP', 'SO', 'PD', 'OP', 'FL', 'SPL', 'SOP', 'VOP', 'SLOP']);
            $table->date('end_date');
            $table->string('cause');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
