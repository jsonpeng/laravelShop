<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('分类名称');
            $table->integer('sort')->nullable()->default(0)->comment('权重');

            $table->index(['id', 'created_at']);
            $table->index('sort');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('stores_cats', function (Blueprint $table) {
            $table->increments('id');
      
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');

            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('cats');

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
        Schema::dropIfExists('stores_cats');
        Schema::dropIfExists('cats');
    }
}
