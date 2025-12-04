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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->enum('call_status', ['idle', 'ringing', 'in_call', 'ended'])->default('idle');
            $table->enum('call_type', ['none', 'audio', 'video'])->default('none');
            $table->timestamp('call_started_at')->nullable();
            $table->timestamp('call_ended_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
