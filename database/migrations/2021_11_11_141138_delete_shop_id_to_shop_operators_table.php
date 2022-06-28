<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteShopIdToShopOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_operators', function (Blueprint $table) {
            //
            $table->dropForeign(['shop_id']);
            $table->dropColumn('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_operators', function (Blueprint $table) {
            //$table->unsignedBigInteger('shop_id');
        });
    }
}
