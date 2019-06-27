<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {

           $table->enum('status', [
                    '上线',
                    '下架'
                ])->default('上线')->comment('当前状态(上线 下架)');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       if (Schema::hasColumn('categories', 'status')) {
            Schema::table('categories', function (Blueprint $table) {
                 $table->dropColumn('status');
            });
        }
    }
}
