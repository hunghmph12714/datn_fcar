<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->dateTime('time')->nullable();

            // $table->json('company_computer_id')->comment('Danh sách id các hãng máy tính')->nullable();
            // $table->integer('expected_cost')->comment('Chi phí dự kiến')->nullable();
            // $table->json('repair')->comment('danh sách id linh kiện');
            // $table->enum('repair_type', ['TN', 'CH'])->comment('Hình thức TN: tại nhà; CH: của hàng')->nullable();
            // $table->text('description')->comment('mô tả')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
