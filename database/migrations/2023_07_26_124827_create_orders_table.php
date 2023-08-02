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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("product_id")->nullable();
            $table->string("bname");
            $table->string("baddress");
            $table->string("bnumber");
            $table->string("bemail");
            $table->string("note");
            $table->string("price");
            $table->string("quantity");
            $table->string("total");
            $table->string("receipt");
            $table->foreign("product_id")->references("id")->on("products")->onDelete("SET NULL");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("SET NULL");
            $table->enum("status", ["Placed", "Processing", "On the way", "Delivered", "Canceled"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
