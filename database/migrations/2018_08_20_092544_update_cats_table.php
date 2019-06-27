<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCatsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('cats', function (Blueprint $table) {
            if(!Schema::hasColumn('cats', 'image')) {
                $table->string('image')->nullable()->comment('店铺分类图片');
            }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('cats', 'image')) {
            Schema::table('cats', function (Blueprint $table) {
                 $table->dropColumn('image');
            });
        }
    }
}
