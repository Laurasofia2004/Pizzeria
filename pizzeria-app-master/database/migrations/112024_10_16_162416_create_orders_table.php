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
        if (!Schema::hasTable('orders')) {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['pendiente', 'en_preparacion', 'listo', 'entregado']);
            $table->enum('delivery_type', ['en_local', 'a_domicilio']);
            $table->foreignId('delivery_person_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->timestamps();
        });
    } else {
        Schema::table('orders', function (Blueprint $table) {
            
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
