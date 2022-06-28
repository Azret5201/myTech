<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProductPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_product_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('default_property_id');
            $table->unsignedBigInteger('user_product_id');
            $table->string('value', 255)->nullable();
            $table->timestamps();

            $table->foreign('default_property_id')->references('id')->on('default_properties')->onDelete('CASCADE');
            $table->foreign('user_product_id')->references('id')->on('user_products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_product_properties');
    }
}
