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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('order_id');
            // $table->unsignedBigInteger('customer_id');
            $table->date('payment_date');
            $table->enum('payment_status', ['pending', 'paid', 'after_receiving']);
            $table->string('payment_confirmation_number');
            $table->string('payment_gateway');
            $table->decimal('total_sum', 10, 2);
            $table->timestamp('timestamp')->nullable();
            $table->string('payment_method');
            $table->date('date_created');

            $table->foreignId('order_id')->constrained('orders')->restrictOnDelete()->restrictOnUpdate();  /*references('id')->on('orders'); */
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete()->restrictOnUpdate(); /*references('id')->on('customers'); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
