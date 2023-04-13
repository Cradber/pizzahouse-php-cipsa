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
        Schema::create('order_ingredients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('order_id')->constrained()->references('id')->on('order');
            $table->foreignId('ingredient_id')->constrained()->references('id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
