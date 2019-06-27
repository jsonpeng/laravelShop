<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderActionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_actions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('order_status')->comment('订单状态');
            $table->string('shipping_status')->comment('物流状态');
            $table->string('pay_status')->comment('支付状态');
            $table->string('action')->comment('操作');
            $table->string('status_desc')->comment('描述');
            $table->string('user')->comment('操作用户');

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
        Schema::drop('order_actions');
    }
}
