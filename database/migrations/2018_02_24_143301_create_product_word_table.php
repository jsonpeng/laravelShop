<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductWordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('word', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('img')->nullable();

            $table->index(['id', 'created_at']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_word', function (Blueprint $table){
            $table->increments('id');
            $table->integer('word_id')->unsigned();
            $table->foreign('word_id')->references('id')->on('word');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->index(['id', 'created_at']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_word');
        Schema::dropIfExists('word');
    }
}
