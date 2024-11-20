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
        Schema::create('order_extra_ingredient', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete(); // Relación con la tabla orders
            $table->foreignId('extra_ingredient_id')->constrained('extra_ingredients')->cascadeOnDelete(); // Relación con la tabla extra_ingredients
            $table->integer('quantity'); // Cantidad de ingredientes extra
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_extra_ingredient');
    }
};
