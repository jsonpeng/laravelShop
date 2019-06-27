<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlecatsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articlecats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('分类名称');
            $table->string('slug')->default('')->comment('分类别名');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('parent_id')->default(0)->comment('父分类');
            $table->string('image')->nullable()->default('')->comment('图像');
            $table->string('seo_title')->nullable()->default('')->comment('seo标题');
            $table->string('seo_keyword')->nullable()->default('')->comment('SEO关键词');
            $table->string('seo_des')->nullable()->default('')->comment('SEO描述');

            $table->index(['id', 'created_at']);
            $table->index('parent_id');
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
        Schema::drop('articlecats');
    }
}
