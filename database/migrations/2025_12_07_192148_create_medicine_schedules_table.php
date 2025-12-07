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
        Schema::create('medicine_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_reminder_id')->constrained('medicine_reminders')->cascadeOnDelete();

            $table->date('schedule_date');
            $table->time('schedule_time');

            $table->boolean('is_sent')->default(false);
            $table->timestamp('sent_at')->nullable();

            $table->timestamps();

            $table->index(['schedule_date', 'schedule_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_schedules');
    }
};
