<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('orders', 'jifen')) {
            Schema::table('orders', function (Blueprint $table) {
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
        if (Schema::hasColumn('orders', 'jifen')) {
            Schema::table('orders', function (Blueprint $table) {
                 $table->dropColumn('jifen');
            });
        }
    }
}
