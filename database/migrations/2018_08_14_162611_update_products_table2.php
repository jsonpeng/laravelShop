<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'jifen')) {
            Schema::table('products', function (Blueprint $table) {
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
        if (Schema::hasColumn('products', 'jifen')) {
            Schema::table('products', function (Blueprint $table) {
                 $table->dropColumn('jifen');
            });
        }
    }
}
