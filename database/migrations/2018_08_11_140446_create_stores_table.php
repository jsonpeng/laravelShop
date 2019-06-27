<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('店铺名称');
            $table->string('image')->nullable()->comment('店铺图片');
            $table->double('jindu')->comment('店铺经度');
            $table->double('weidu')->comment('店铺纬度');
            $table->string('address')->comment('店铺地址');

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
        Schema::dropIfExists('stores');
    }
}
