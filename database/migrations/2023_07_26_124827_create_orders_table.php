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
            $table->string("bname");
            $table->string("baddress");
            $table->string("bnumber");
            $table->string("bemail");
            $table->string("note");
            $table->string("receipt");
            $table->enum("status", ["Placed", "Processing", "On the way", "Delivered", "Canceled"]);
            $table->foreign("user_id")->references("id")->on("users")->onDelete("SET NULL");
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
