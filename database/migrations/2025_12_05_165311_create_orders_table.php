<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('address_id')->constrained('addresses')->cascadeOnDelete();
            $table->string('order_code')->unique();
            $table->integer('subtotal');
            $table->integer('shipping_fee');
            $table->integer('service_fee');
            $table->integer('voucher_discount')->default(0);
            $table->integer('total');

            $table->enum('status', ['BELUM_BAYAR', 'DIPROSES', 'SELESAI', 'DIBATALKAN'])->default('BELUM_BAYAR');

            $table->string('payment_method')->nullable();
            $table->string('midtrans_order_id')->nullable();
            $table->string('midtrans_transaction_status')->nullable();
            $table->string('snap_token')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
