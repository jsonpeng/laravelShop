<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('items', 'jifen')) {
            Schema::table('items', function (Blueprint $table) {
                $table->integer('jifen')->nullable()->default(0)->comment('购物所需积分');
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
        if (Schema::hasColumn('items', 'jifen')) {
            Schema::table('items', function (Blueprint $table) {
                 $table->dropColumn('jifen');
            });
        }
    }
}
