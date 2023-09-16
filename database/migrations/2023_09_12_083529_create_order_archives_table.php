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
        Schema::create('order_archives', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->text('note')->nullable();
            $table->string('status');
            $table->string('delivery_method');
            $table->string('payment_method');
            $table->string('country');
            $table->string('destination_city');
            $table->string('street_delivery_point'); 
            $table->string('shipping_address')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('company')->nullable();
            $table->string('street_address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('email_address');
            $table->date('order_date');

            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('ordered_product_id')->nullable()->constrained('ordered_products')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_archives');
    }
};
