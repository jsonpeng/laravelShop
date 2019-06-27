<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('规格名称');
            $table->integer('sort')->default(50)->comment('排序');

            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('product_types');

            $table->index(['id', 'created_at']);
            $table->index('type_id');
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
        Schema::drop('specs');
    }
}
