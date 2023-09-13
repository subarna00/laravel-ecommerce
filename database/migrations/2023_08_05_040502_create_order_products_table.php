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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id")->nullable();
            $table->unsignedBigInteger("order_id")->nullable();
            $table->string("price");
            $table->string("quantity");
            $table->string("total");
            $table->foreign("product_id")->references("id")->on("products")->onDelete("SET NULL");
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("SET NULL");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
