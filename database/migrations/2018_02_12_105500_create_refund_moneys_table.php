<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefundMoneysTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('snumber')->comment('商户订单号');
            $table->string('transaction_id')->nullable()->comment('平台订单号');
            $table->string('platform')->comment('支付方式');
            $table->float('total_fee')->comment('订单总金额');
            $table->string('snumber_refund')->comment('退款订单号');
            $table->float('refund_fee')->comment('退款金额');
            $table->string('desc')->comment('退款原因');
            $table->string('status')->comment('退款状态');
            $table->string('last_query')->nullable()->comment('最后查询状态时间');
            $table->string('remark')->comment('备注');

            $table->enum('order_type', ['取消订单', '售后退款'])->comment('退款记录生成的来源');

            $table->integer('order_id')->unsigned();//来源ID;

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
        Schema::drop('refund_moneys');
    }
}
