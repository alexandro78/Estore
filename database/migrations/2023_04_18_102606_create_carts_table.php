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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('customer_id');
            // $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamp('timestamp')->nullable();
           
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete()->cascadeOnUpdate();  /* ->references('id')->on('customers'); */
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete()->restrictOnUpdate(); /* references('id')->on('products'); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
