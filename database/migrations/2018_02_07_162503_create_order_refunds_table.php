<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderRefundsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_refunds', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('type')->default(1)->comment('类型 0退款 1退货退款 2换货');
            $table->integer('count')->default(1)->comment('商品数量');
            $table->string('reason')->nullable()->comment('退换理由');
            $table->string('describe', 512)->nullable()->comment('问题描述');
            $table->string('remark', 512)->nullable()->comment('管理员备注');
            $table->integer('status')->default(0)->comment('退换状态 -2用户取消-1审核不通过0待审核1通过2已发货3已完成');
            
            $table->string('seller_delivery_company')->nullable()->comment('卖家重新发货物流公司');
            $table->string('seller_delivery_no')->nullable()->comment('卖家重新发货物流单号');
            $table->float('refund_money')->default(0)->comment('退还支付金额');
            $table->float('refund_deposit')->default(0)->comment('退还账户余额');
            $table->integer('refund_credit')->default(0)->comment('退还积分');
            $table->integer('refund_type')->default(0)->comment('0原路返回 1退款到余额');
            $table->string('refund_time')->nullable()->comment('退款时间');
            $table->integer('is_receive')->default(0)->comment('0未收到 1收到 申请售后时是否收到货物');

            $table->integer('return_status')->default(0)->comment('0买家未发货 1买家已发货 2卖家已收货');
            $table->string('return_delivery_company')->nullable()->comment('买家发货物流公司');
            $table->string('return_delivery_no')->nullable()->comment('买家发货物流单号');
            $table->float('return_delivery_money')->nullable()->default(0)->comment('快递费用');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');

            $table->index(['id', 'created_at']);
            $table->index('order_id');
            $table->index('user_id');
            $table->index('item_id');

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
        Schema::drop('order_refunds');
    }
}
