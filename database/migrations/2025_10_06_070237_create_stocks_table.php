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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->foreignId('product_package_id')->constrained('product_package_types')->onDelete('cascade');
            $table->integer('product_package_quantity');
            $table->decimal('unit_amount', 10, 2);
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Add composite unique constraint to prevent duplicate entries
            $table->unique(['product_id', 'product_package_id', 'unit_id'], 'stock_unique_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
