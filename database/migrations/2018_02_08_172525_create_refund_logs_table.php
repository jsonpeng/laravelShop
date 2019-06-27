<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefundLogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('des');
            $table->string('time');

            $table->integer('order_refund_id')->unsigned();
            $table->foreign('order_refund_id')->references('id')->on('order_refunds');

            $table->index(['id', 'created_at']);
            $table->index('order_refund_id');

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
        Schema::drop('refund_logs');
    }
}
