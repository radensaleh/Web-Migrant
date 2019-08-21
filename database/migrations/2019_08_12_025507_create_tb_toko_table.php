<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbTokoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_toko', function (Blueprint $table) {
            $table->string('kd_toko')->primary();
            $table->bigInteger('id_token')->unsigned();
            $table->index('id_token');
            $table->foreign('id_token')->references('id_token')->on('tb_token');
            $table->string('KTP');
            $table->string('nama_toko');
            $table->string('foto_toko');
            $table->string('kd_user')->index();
            $table->foreign('kd_user')->references('kd_user')->on('tb_user');
            $table->string('no_rekening');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('city_id')->on('tb_kota');
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
        Schema::dropIfExists('tb_toko');
    }
}
