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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->references('id')->on('users');
            $table->foreignId('pizza_id')->constrained()->references('id')->on('pizzas');
            $table->foreignId('size_id')->constrained()->references('id')->on('size');
            $table->foreignId('edge_id')->constrained()->references('id')->on('edge');
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
