<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBookingDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_details', function (Blueprint $table) {
            //
            $table->enum('status_repair', ['fixing', 'waiting', 'finish'])->nullable();
            $table->enum('status_booking', ['latch', 'cancel', 'received'])->nullable();
            // $table->date('date')
            // $table->enum('active','')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_details', function (Blueprint $table) {
            $table->dropColumn('status_repair');
            $table->dropColumn('status_booking');
        });
    }
}