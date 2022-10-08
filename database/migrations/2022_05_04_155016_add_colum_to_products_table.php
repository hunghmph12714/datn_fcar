<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->string('ram');
            // $table->string('cpu');
            // $table->string('cardgraphic');
            // $table->string('screen');
            // $table->string('harddrive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->dropColumn('ram');
            // $table->dropColumn('cpu');
            // $table->dropColumn('cardgraphic');
            // $table->dropColumn('screen');
            // $table->dropColumn('harddrive');
        });
    }
}
