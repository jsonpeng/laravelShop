<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateBannerItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('banner_items', 'link_type')) {
            Schema::table('banner_items', function (Blueprint $table) {
                 $table->string('link_type')->nullable()->comment('链接设置方式');
                 $table->string('mini_link')->nullable()->comment('小程序跳转链接');
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
        if (Schema::hasColumn('banner_items', 'link_type')) {
            Schema::table('banner_items', function (Blueprint $table) {
                 $table->dropColumn('link_type');
                 $table->dropColumn('mini_link');
            });
        }
    }
}
