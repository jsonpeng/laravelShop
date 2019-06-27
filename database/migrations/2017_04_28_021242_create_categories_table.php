<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('分类名称');
            $table->string('pc_name')->nullable()->comment('PC分类名称');
            $table->string('brief')->nullable()->comment('简介');
            $table->string('slug')->nullable()->comment('分类别名');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('image')->nullable()->comment('图片');
            $table->tinyInteger('recommend')->default(0)->comment('是否推荐 0否 1是'); 
            $table->integer('parent_id')->default(0)->comment('父类ID');
            $table->string('parent_path')->nullable()->comment('分类路径');
            $table->integer('level')->default(1)->comment('等级');
            $table->string('show')->default('是')->comment('是否展示');

            $table->index(['id', 'created_at']);
            $table->index('parent_id');
            $table->index('level');
            $table->index('sort');

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
        Schema::drop('categories');
    }
}
