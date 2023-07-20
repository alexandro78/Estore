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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('color');
            $table->string('color_code');
            $table->integer('in_stock');
            $table->decimal('price', 10, 2);
            // $table->unsignedBigInteger('size_id')->nullable();
            // $table->unsignedBigInteger('discount_id')->nullable();
            // $table->unsignedBigInteger('category_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('country')->nullable();
            $table->integer('article');
            $table->date('date_add');
            $table->date('date_update')->nullable();
            $table->integer('quantity');
            $table->boolean('bestseller')->default(false);
            $table->boolean('offer_area')->default(false);
            $table->timestamps();
            
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->cascadeOnUpdate(); /* ('id')->on('categories')->nullOnDelete(); */
            $table->foreignId('size_id')->nullable()->constrained('sizes')->nullOnDelete()->cascadeOnUpdate(); /* references('id')->on('sizes'); */
            $table->foreignId('discount_id')->nullable()->constrained('discounts')->nullOnDelete()->cascadeOnUpdate(); /* references('id')->on('discounts'); */
            $table->foreignId('free_shipping_id')->nullable()->constrained('free_shippings')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
