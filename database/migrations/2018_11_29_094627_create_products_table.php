<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('product_groups_id');
            $table->string('sku');
            $table->string('color');
            $table->text('description');
            $table->integer('provider_price');
            $table->integer('price');
            $table->string('picture');
            $table->integer('quantity');
            $table->string('size');
            $table->boolean('available');
            $table->boolean('show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
