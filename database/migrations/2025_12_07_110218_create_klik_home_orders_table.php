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
        Schema::create('klik_home_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('klikhome_service_id')->constrained('klik_home_services')->cascadeOnDelete();
            $table->foreignId('user_address_id')->constrained('addresses')->cascadeOnDelete();

            $table->date('scheduled_date');
            $table->string('scheduled_time');

            $table->integer('subtotal');
            $table->integer('service_fee');
            $table->integer('total');

            $table->enum('status', [
                'MENUNGGU_PEMBAYARAN',
                'DIBAYAR',
                'DIPROSES',
                'SELESAI',
                'BATAL'
            ])->default('MENUNGGU_PEMBAYARAN');
            $table->string('midtrans_order_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klik_home_orders');
    }
};
