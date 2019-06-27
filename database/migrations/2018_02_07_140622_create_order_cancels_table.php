<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderCancelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cancels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reason')->comment('取消订单原因');
            $table->float('money')->comment('退还金额');
            $table->float('user_money')->default(0)->comment('退还金额');
            $table->float('credits')->default(0)->comment('退还金额');
            $table->integer('auth')->default(0)->comment('审核状态，0待处理 1通过 2不通过');
            $table->integer('refound')->default(0)->comment('金额退回路径 0原路返回 1返回到余额');
            $table->string('remark')->nullable()->comment('备注信息');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->index(['id', 'created_at']);
            $table->index('order_id');

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
        Schema::drop('order_cancels');
    }
}
