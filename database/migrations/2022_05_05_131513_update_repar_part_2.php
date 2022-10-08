<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReparPart2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repair_parts', function (Blueprint $table) {
            //
            $table->bigInteger('into_money')->nullable()->change();
            $table->bigInteger('unit_price')->nullable()->change();
            // $table->bigInteger('insurance')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repair_parts', function (Blueprint $table) {
            //
        });
    }
}