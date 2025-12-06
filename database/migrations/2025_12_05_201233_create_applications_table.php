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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->string('nik');
            $table->string('gender');
            $table->string('str');
            $table->string('sip');
            $table->string('spesialisasi');
            $table->string('document');
            $table->enum('status', ['pending', 'approved', 'rejected', 'disabled'])->default('pending');
            $table->boolean('is_active')->default(true);
            $table->integer('experience_years')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
