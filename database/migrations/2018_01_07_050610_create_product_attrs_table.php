<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductAttrsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attrs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('属性名');
            $table->string('isIndex')->default('否')->comment('是否索引');
            $table->tinyInteger('input_type')->default(0)->comment('0手动输入 1列表选择 2手动多行输入');
            $table->text('values')->nullable()->comment('属性取值列表');
            $table->tinyInteger('attr_type')->default(0)->comment('0唯一属性 1单选属性 2复选属性');
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
        Schema::drop('product_attrs');
    }
}
