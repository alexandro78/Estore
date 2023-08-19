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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->string('order_number')->unique();
            $table->string('product_code')->unique();
            $table->string('delivery_service');
            $table->string('street_delivery_point');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->decimal('total', 10, 2);
            $table->string('shipping_address');
            $table->string('shipping_status');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('company')->nullable();
            $table->string('country');
            $table->string('street_address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city');
            $table->string('email_address');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete()->restrictOnUpdate(); /* references('id')->on('customers'); */
            $table->foreignId('cart_id')->constrained('carts')->restrictOnDelete()->restrictOnUpdate();
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
