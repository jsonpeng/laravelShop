<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerServicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('platform')->nullable()->comment('平台： QQ 微信 电话 WEB客服');
            $table->string('job')->nullable()->comment('职位：售前，售后，技术');
            $table->string('head_img')->nullable()->comment('头像');
            $table->string('qr_code')->nullable()->comment('二维码');
            $table->string('commit')->nullable()->comment('联系方式');
            $table->integer('show')->nullable()->default(1)->comment('是否显示 1显示 0不显示');

            $table->index(['id', 'created_at']);
            $table->index('show');

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
        Schema::drop('customer_services');
    }
}
