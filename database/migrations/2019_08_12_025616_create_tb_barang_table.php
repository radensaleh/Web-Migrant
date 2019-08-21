<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->string('kd_barang')->primary();
            $table->string('kd_toko')->index();
            $table->foreign('kd_toko')->references('kd_toko')->on('tb_toko');
            $table->string('nama_barang');
            $table->bigInteger('id_jenis')->unsigned();
            $table->index('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('tb_jenis_barang');
            $table->integer('stok', false, true);
            $table->integer('harga_jual', false, true);
            $table->string('deskripsi');
            $table->string('foto_barang');
            $table->double('berat_barang');
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
        Schema::dropIfExists('tb_barang');
    }
}
