<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToCreditProductOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_product_orders', function (Blueprint $table) {
                $table->unsignedBigInteger('fin_company_id')->after('product_id')
                    ->default(null);
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
            $table->dropColumn('fin_company_id');
        });
    }
}
