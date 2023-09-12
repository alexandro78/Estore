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
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->text('note')->nullable();
            $table->string('status');
            $table->string('delivery_method');
            $table->string('payment_method');
            $table->string('destination_city');

            $table->foreignId('order_id')->nullable()->constrained('orders')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate();
            $table->date('order_date');
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
