<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeVerifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_verify', function (Blueprint $table) {
            $table->id();
            $table->integer('code_verify')->nullable();
            $table->integer('phone_number')->nullable();
            $table->integer('status')->nullable();
            $table->integer('time_request')->nullable();
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
        Schema::dropIfExists('code_verify');
    }
}
