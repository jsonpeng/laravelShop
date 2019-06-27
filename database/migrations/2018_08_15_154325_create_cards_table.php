<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->comment('卡号');
            $table->string('password')->nullable()->comment('密码');
            $table->float('price')->nullable()->comment('换购金额');
            $table->float('num')->comment('积分面额');
            $table->integer('status')->nullable()->default(0)->comment('是否出售0未1已出售');

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
        Schema::dropIfExists('cards');
    }
}
