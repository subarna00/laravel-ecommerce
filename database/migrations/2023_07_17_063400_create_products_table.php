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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->string("model")->nullable();
            $table->longText("sub_description")->nullable();
            $table->longText("description")->nullable();
            $table->string("price");
            $table->string("rating")->default("4.5");
            $table->string("stock")->default("0");
            $table->string("types")->nullable();
            $table->string("discount")->nullable();
            $table->string("offer")->nullable();
            $table->longText("policy")->nullable();
            $table->enum("status", ["active", "inactive"])->default("active");
            $table->unsignedBigInteger("brand_id")->nullable();
            $table->unsignedBigInteger("category_id")->nullable();
            $table->unsignedBigInteger("sub_category_id")->nullable();

            $table->foreign("brand_id")->references("id")->on("brands")->onDelete("SET NULL");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("SET NULL");
            $table->foreign("sub_category_id")->references("id")->on("sub_categories")->onDelete("SET NULL");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
