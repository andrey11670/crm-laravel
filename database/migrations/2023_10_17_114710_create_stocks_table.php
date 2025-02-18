<?php

use App\Models\Product;
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
        /*$products = Product::orderBy('id')->get();
        foreach ($relatedProducts as $index => $relatedProduct) {
            // Получить текущий продукт по индексу
            $product = $products[$index];

            // Создать связанную запись с использованием product_id текущего продукта
            $relatedProduct->product_id = $product->id;
            $relatedProduct->save();
        }*/

        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->foreignId('product_id')->constrained('products');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->integer('stock');
            $table->timestamps();
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
