<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateThemesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('专题名称');
            $table->string('cover')->comment('封面图片');
            $table->string('subtitle')->comment('专题介绍');
            $table->longtext('intro')->comment('专题图文详情');

            $table->index(['id', 'created_at']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('theme_id')->unsigned();
            $table->foreign('theme_id')->references('id')->on('themes');

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
        Schema::drop('product_theme');
        Schema::drop('themes');
    }
}
