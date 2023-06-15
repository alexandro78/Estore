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
            // $table->unsignedBigInteger('customer_id');
            // $table->unsignedBigInteger('product_id');
            $table->string('order_number')->unique();
            $table->date('order_date');
            $table->string('product_code');
            $table->string('delivery_service');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->decimal('total_amount', 10, 2);
            $table->string('status');
            $table->string('shipping_address');
            $table->string('shipping_method');
            $table->string('shipping_status');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete()->restrictOnUpdate(); /* references('id')->on('customers'); */
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete()->restrictOnUpdate(); /* references('id')->on('products'); */
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
