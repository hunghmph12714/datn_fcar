<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateListBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_bill', function (Blueprint $table) {
            $table->integer('booking_detail_id')->nullable();
            $table->bigInteger('customers_pay')->comment(' khách hàng trả tiền')->nullable();
            $table->dateTime('date')->nullable();
            $table->bigInteger('excess_cash')->comment(' tiền thừa')->nullable();
            $table->bigInteger('debt')->comment('nợ')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_bill', function (Blueprint $table) {
            //
        });
    }
}
