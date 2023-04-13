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
        Schema::create('pizza_price', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('price', 8, 2);

            $table->foreignId('size_id')->constrained()->references('id')->on('size');
            $table->foreignId('pizza_id')->constrained()->references('id')->on('pizzas');
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
