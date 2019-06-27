<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateStores1Table extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('stores', 'sort')) 
        {
            Schema::table('stores', function (Blueprint $table) {
                $table->integer('sort')->nullable()->default(0)->comment('排序');
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
        if (Schema::hasColumn('stores', 'sort')) 
        {
            Schema::table('items', function (Blueprint $table) {
                 $table->dropColumn('sort');
            });
        }
    }
}
