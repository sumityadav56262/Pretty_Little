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
        Schema::create('product_lists', function (Blueprint $table) {
            $table->id();
            $table->string('email',250);
            $table->string('name',250);
            $table->string('price',10);
            $table->string('category',60);
            $table->string('brand',50);
            $table->string('pic1',250);
            $table->string('pic2',250);
            $table->string('pic3',250);
            $table->string('discount',3);
            $table->string('quantity',6);
            $table->string('rating',6);
            $table->string('sold_count',6);
            $table->string('discription',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_lists');
    }
};
