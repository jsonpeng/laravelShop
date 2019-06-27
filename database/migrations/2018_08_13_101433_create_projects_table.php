<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->comment('项目名称');
            $table->string('mobile')->comment('手机号');
            $table->string('weixin_qq')->comment('微信/qq');
            $table->string('address')->comment('项目地址');
            $table->string('content')->comment('具体信息');
            $table->double('jindu')->nullable()->comment('经度');
            $table->double('weidu')->nullable()->comment('纬度');
            
            $table->index(['id','created_at']);

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
        Schema::dropIfExists('projects');
    }
}
