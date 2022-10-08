<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable();
            $table->string('name_car')->nullable();

            $table->json('company_car_id')->comment('Danh sách id các hãng xe')->nullable();
            $table->integer('expected_cost')->comment('Chi phí dự kiến')->nullable();
            $table->json('repair')->comment('danh sách id linh kiện')->nullable();
            $table->enum('repair_type', ['TN', 'CH'])->comment('Hình thức TN: tại nhà; CH: của hàng')->nullable();
            $table->text('description')->comment('mô tả')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('finish_time')->nullable();
            $table->longText('comment')->nullable();
            $table->integer('active')->comment('Để biết xem đã xác nhận chưa (quản trị)')->nullable();

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
        Schema::dropIfExists('booking_details');
    }
}