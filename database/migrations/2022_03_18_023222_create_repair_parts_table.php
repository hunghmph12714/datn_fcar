<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_parts', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_detail_id')->nullable();
            $table->integer('detail_product_id');
            $table->float('unit_price');
            $table->integer('quantity')->nullable();
            $table->float('into_money')->nullable();
            $table->float('sale')->nullable();
            $table->float('insurance')->comment('thời gian bảo hành (tháng)')->nullable();
            $table->date('warranty_period')->comment('hạn bảo hành')->nullable();



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
        Schema::dropIfExists('repair_parts');
    }
}
