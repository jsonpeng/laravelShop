<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductAttrValuesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attr_values', function (Blueprint $table) {
            $table->increments('id');

            $table->string('attr_value');

            $table->integer('attr_id')->unsigned();
            $table->foreign('attr_id')->references('id')->on('product_attrs');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->index(['id', 'created_at','product_id']);
            $table->index('attr_id');
            $table->index('product_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_attr_values');
    }
}
