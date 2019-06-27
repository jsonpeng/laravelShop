<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
              if (!Schema::hasColumn('cards', 'length')) {
                    $table->integer('length')->nullable()->default(8)->comment('卡号长度');
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
        if (Schema::hasColumn('cards', 'length')) {
            Schema::table('cards', function (Blueprint $table) {
                 $table->dropColumn('length');
            });
        }
    }
}
