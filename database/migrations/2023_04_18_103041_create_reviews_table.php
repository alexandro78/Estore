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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('product_id');
            // $table->unsignedBigInteger('customer_id')->nullable();
            $table->text('review_text');
            $table->date('review_date');
            $table->enum('review_status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->string('reviewer_name')->nullable();
            $table->integer('votes')->default(0);
            $table->integer('helpful_votes')->default(0);
            $table->integer('unhelpful_votes')->default(0);
            $table->date('date_created');
            $table->date('date_updated')->nullable();

            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate(); /* ->references('id')->on('products'); */
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate(); /* ->references('id')->on('customers'); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
