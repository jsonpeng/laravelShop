<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductEvalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_evals', function (Blueprint $table) {
            $table->increments('id');

            $table->string('content')->nullable()->comment('评论内容');
            $table->integer('anonymous')->nullable()->default(0)->comment('1的话匿名不显示昵称,0的话显示');

            $table->integer('zan')->nullable()->default(0)->comment('点赞数');
            $table->integer('all_level')->comment('总体评价12345五个等级');
            $table->integer('service_level')->comment('商家服务评价12345五个等级');
            $table->integer('logistics_level')->comment('物流速度评价12345五个等级');
            $table->integer('overall_level')->comment('整体评价12345五个等级');

            $table->integer('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('spec_id')->nullable()->default(0)->comment('规格id');
            // $table->foreign('spec_id')->references('id')->on('spec_product_prices');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->index(['id', 'created_at']);
            $table->index('product_id');
            $table->index('spec_id');
            $table->index('user_id');

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
        Schema::dropIfExists('product_evals');
    }
}
