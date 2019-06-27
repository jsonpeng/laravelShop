<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachEvalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attach_evals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('eval_id')->unsigned();
            $table->foreign('eval_id')->references('id')->on('product_evals');

            $table->enum('type',['图片','视频'])->nullable()->default('图片')->comment('评价附加类型');
            $table->string('url');

            $table->index(['id', 'created_at']);
            $table->index('eval_id');

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
        Schema::dropIfExists('attach_evals');
    }
}
