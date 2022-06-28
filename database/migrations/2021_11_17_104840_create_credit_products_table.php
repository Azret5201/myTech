<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('fin_company_id');
            $table->float('min_sum');
            $table->float('max_sum');
            $table->integer('min_loan_term');
            $table->integer('max_loan_term');
            $table->float('annual_interest_rate');
            $table->float('issuance_fee');
            $table->float('cash_withdrawal_fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_products');
    }
}
