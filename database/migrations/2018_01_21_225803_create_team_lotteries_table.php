<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamLotteriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_lotteries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile')->nullable()->comment('手机号');
            $table->string('nickname')->nullable()->comment('用户昵称');
            $table->string('head_pic')->nullable()->comment('用户头像');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('team_sales');

            $table->index(['id', 'created_at']);
            $table->index('user_id');
            $table->index('team_id');
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
        Schema::drop('team_lotteries');
    }
}
