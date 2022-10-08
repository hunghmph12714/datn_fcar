<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateListBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_bill', function (Blueprint $table) {
            $table->string('code');
            $table->integer('method');
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
            $table->dropColumn('code');
            $table->dropColumn('method');
        });
    }

    
}
