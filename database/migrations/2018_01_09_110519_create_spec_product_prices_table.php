<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecProductPricesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('key_name');
            $table->float('price')->default(0);
            $table->integer('inventory')->default(0);
            $table->string('qrcode')->nullable()->comment('二维码');
            $table->string('sku')->nullable();
            $table->string('image')->nullable()->comment('规格图片');
            $table->integer('prom_id')->nullable()->comment('促销ID');
            $table->integer('prom_type')->nullable()->comment('促销类型');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->index(['id', 'created_at']);
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
        Schema::drop('spec_product_prices');
    }
}
