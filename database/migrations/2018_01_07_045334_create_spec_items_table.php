<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('规格条目名称');
            $table->integer('spec_id')->unsigned();
            $table->foreign('spec_id')->references('id')->on('specs');

            $table->index(['id', 'created_at']);
            $table->index('spec_id');

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
        Schema::dropIfExists('spec_items');
    }
}
