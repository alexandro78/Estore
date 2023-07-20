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
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->integer('min_price')->nullable();
            $table->integer('max_price')->nullable();
            $table->string('color_filter')->nullable();
            $table->enum('size_filter', ['NULL', 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'])->default('NULL')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filters');
    }
};
