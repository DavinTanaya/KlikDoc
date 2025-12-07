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
        Schema::create('klik_home_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');

            $table->text('description')->nullable();
            $table->unsignedInteger('duration_minutes');

            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('service_fee')->default(5000);

            $table->string('handled_by')->nullable();
            $table->text('icon_svg')->nullable();

            $table->json('benefits')->nullable();
            $table->json('inclusions')->nullable();
            $table->json('safety_notes')->nullable();
            $table->json('time_slots')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['category']);
            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klik_home_services');
    }
};
