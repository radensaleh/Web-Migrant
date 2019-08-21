<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kota', function (Blueprint $table) {
            $table->increments('city_id');
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('province_id')->on('tb_provinsi');
            $table->string('type');
            $table->string('city_name');
            $table->integer('postal_code', false, true);
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
        Schema::dropIfExists('tb_kota');
    }
}
