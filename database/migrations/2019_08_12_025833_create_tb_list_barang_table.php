<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbListBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_list_barang', function (Blueprint $table) {
            $table->bigIncrements('id_list_barang');
            $table->string('kd_pesanan')->index();
            $table->foreign('kd_pesanan')->references('kd_pesanan')->on('tb_pesanan');
            $table->string('kd_barang')->index();
            $table->foreign('kd_barang')->references('kd_barang')->on('tb_barang');
            $table->integer('kuantitas', false, true);
            $table->integer('harga', false, true);
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
        Schema::dropIfExists('tb_list_barang');
    }
}
