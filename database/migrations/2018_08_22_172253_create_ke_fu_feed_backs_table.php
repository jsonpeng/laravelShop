<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeFuFeedBacksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ke_fu_feed_backs', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['反映问题','提出建议','其他'])->nullable()->default('反映问题')->comment('反馈类型');
            $table->string('content')->comment('意见反馈描述');
            $table->string('tel')->comment('联系电话');

            $table->index(['id', 'created_at']);

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
        Schema::drop('ke_fu_feed_backs');
    }
}
