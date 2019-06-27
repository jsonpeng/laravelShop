<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyItems1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('items', 'topiced')) {
            Schema::table('items', function (Blueprint $table) {
                $table->integer('topiced')->nullable()->default(0)->comment('是否被评价过');
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
        if (Schema::hasColumn('items', 'topiced')) {
            Schema::table('items', function (Blueprint $table) {
                 $table->dropColumn('topiced');
            });
        }
    }
}
