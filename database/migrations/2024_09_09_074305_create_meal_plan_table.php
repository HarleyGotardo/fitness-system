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
        Schema::create('meal_plan', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['breakfast', 'lunch', 'dinner', 'snack']);
            $table->unsignedBigInteger('assigned_to');
            $table->text('name');
            $table->text('description');
            $table->text('content');

            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plan');
    }
};
