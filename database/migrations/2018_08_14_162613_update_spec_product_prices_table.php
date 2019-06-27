<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSpecProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('spec_product_prices', 'jifen')) {
            Schema::table('spec_product_prices', function (Blueprint $table) {
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
        if (Schema::hasColumn('spec_product_prices', 'jifen')) {
            Schema::table('spec_product_prices', function (Blueprint $table) {
                 $table->dropColumn('jifen');
            });
        }
    }
}
