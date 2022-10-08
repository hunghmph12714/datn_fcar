<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRepairParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repair_parts', function (Blueprint $table) {
            $table->longText('name_product')->nullable();
            $table->enum('type', ['new', 'fix'])->nullable();
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
            $table->dropColumn('name_product');
            $table->dropColumn('type');
        });
    }
}