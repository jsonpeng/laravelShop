<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupSalesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('活动标题');
            $table->timestamp('time_begin')->nullable()->comment('开始时间');
            $table->timestamp('time_end')->nullable()->comment('结束时间');
            
            $table->decimal('price', 10, 2)->comment('团购价格');
            $table->integer('product_max')->comment('最大出售数量，0表示不限量');
            $table->integer('buy_num')->default(0)->comment('已出售数量');
            $table->integer('order_num')->default(0)->comment('订单数量');
            $table->integer('buy_base')->default(5142)->comment('虚拟出售基数');
            $table->longtext('intro')->nullable()->comment('活动介绍');
            $table->decimal('origin_price', 10, 2)->nullable()->comment('商品原价');
            $table->string('product_name')->comment('商品名称');
            $table->tinyInteger('recommend')->nullable()->default(0)->comment('推荐 0不推荐 1推荐');
            $table->integer('view')->default(0)->comment('浏览次数');;
            $table->tinyInteger('is_end')->nullable()->default(0)->comment('是否结束');

            $table->integer('spec_id')->unsigned();
            $table->foreign('spec_id')->references('id')->on('spec_product_prices');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->index(['id', 'created_at']);
            $table->index('spec_id');
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
        Schema::drop('group_sales');
    }
}
