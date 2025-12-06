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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('applications')->onDelete('cascade');

            $table->string('consultation_code')->unique();

            $table->enum('method', ['chat', 'voice', 'video'])->default('chat');

            $table->integer('consultation_fee');
            $table->integer('service_fee')->default(0);
            $table->integer('platform_fee')->default(0);
            $table->integer('total');

            $table->string('status')->default('BELUM_BAYAR');

            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
