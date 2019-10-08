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
            $table->bigIncrements('id');
            $table->String('category');
            $table->String('subcategory');
            $table->String('subsubcategory');
            $table->String('type');
            $table->String('brand');
            $table->String('product_name');
            $table->String('product_price');
            $table->String('product_offer_price');
            $table->String('product_qty');
            $table->String('product_description');
            $table->String('product_image');
            $table->String('product_mimage');
            $table->String('product_gst');
            $table->String('product_weight');
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
