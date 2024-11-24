<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('order_pizza')) {
            Schema::create('order_pizza', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->onDelete('cascade');
                $table->foreignId('pizza_size_id')->constrained('pizza_size')->onDelete('cascade');
                $table->integer('quantity');
                $table->timestamps();
            });
        } else {
            Schema::table('order_pizza', function (Blueprint $table) {
                
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('order_pizza');
    }
};
