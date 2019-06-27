<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreightTemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freight_tems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('运费模板名称');;
            $table->integer('count_type')->nullable()->comment('计算方式0件数1重量3体积');
            $table->integer('use_default')->nullable()->comment('是否使用系统默认0不使用1使用');

            $table->index('id');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('cities_freights', function (Blueprint $table) {
            $table->integer('cities_id')->unsigned();
            $table->integer('freights_id')->unsigned();
            $table->foreign('cities_id')->references('id')->on('cities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('freights_id')->references('id')->on('freight_tems')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('freight_type')->nullable()->comment('计算方式0件数1重量3体积');
            $table->string('freight_first_count')->nullable()->comment('首重/首件/首体积');
            $table->string('the_freight')->nullable()->comment('运费');
            $table->string('freight_continue_count')->nullable()->comment('续重/续件/续体积');
            $table->string('freight_continue_price')->nullable()->comment('续运费');

            $table->index('cities_id');
            $table->index('freights_id');

            //$table->primary(['cities_id', 'freights_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cities_freights');
        Schema::drop('freight_tems');
    }
}
