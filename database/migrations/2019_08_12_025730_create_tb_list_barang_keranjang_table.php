<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbListBarangKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_list_barang_keranjang', function (Blueprint $table) {
            $table->bigIncrements('id_list_keranjang');
            $table->bigInteger('id_keranjang')->unsigned();
            $table->index('id_keranjang');
            $table->foreign('id_keranjang')->references('id_keranjang')->on('tb_keranjang');
            $table->string('kd_barang');
            $table->foreign('kd_barang')->references('kd_barang')->on('tb_barang');
            $table->integer('kuantitas', false, true);
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
        Schema::dropIfExists('tb_list_barang_keranjang');
    }
}
