<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateStoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('stores', 'mobile')) 
        {
            Schema::table('stores', function (Blueprint $table) {
                $table->string('mobile')->nullable()->comment('店铺电话');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('stores', 'mobile')) {
            Schema::table('stores', function (Blueprint $table) {
                 $table->dropColumn('mobile');
            });
        }
    }
}
