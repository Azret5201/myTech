<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsArchiveToCreditProductOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_product_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('is_archive')->after('status_text')
                ->nullable()
                ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_product_orders', function (Blueprint $table) {
            $table->dropColumn('is_archive');
        });
    }
}
