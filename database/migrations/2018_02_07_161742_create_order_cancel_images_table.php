<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderCancelImagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cancel_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->comment('图片路径');
            $table->integer('order_cancel_id')->unsigned();
            $table->foreign('order_cancel_id')->references('id')->on('order_cancels');

            $table->index(['id', 'created_at']);
            $table->index('order_cancel_id');

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
        Schema::drop('order_cancel_images');
    }
}
