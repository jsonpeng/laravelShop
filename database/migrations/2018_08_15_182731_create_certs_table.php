<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCertsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('真实姓名');
            $table->string('id_card')->comment('身份证号');

            $table->string('face_image')->comment('身份证人脸图片');
            $table->string('back_image')->comment('身份证背面国徽图片');
            $table->string('hand_image')->comment('手持身份证图片');

            $table->enum('status',['审核中','已通过','未通过'])->nullable()->default('审核中')->comment('审核状态');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->index(['id', 'created_at']);
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
        Schema::dropIfExists('certs');
    }
}
