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
        Schema::create('movement_histories', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('product_id');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_items_id')->constrained('order_items');
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->string('action', 255 );
            $table->string('stock', 255 )->nullable()->default('0');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movement_histories');
    }
};
