<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderRefundsImgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_refunds_img', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->integer('order_refunds_id')->unsigned();
            $table->foreign('order_refunds_id')->references('id')->on('order_refunds');

            $table->index(['id', 'created_at']);
            $table->index('order_refunds_id');

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
        Schema::dropIfExists('order_refunds_img');
    }
}
