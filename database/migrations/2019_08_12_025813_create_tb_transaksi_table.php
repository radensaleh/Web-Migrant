<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->string('kd_transaksi')->primary();
            $table->string('kd_user')->index();
            $table->foreign('kd_user')->references('kd_user')->on('tb_user');
            $table->string('foto_bukti')->nullable();
            $table->date('tgl_transaksi');
            $table->integer('total_harga');
            $table->string('nama_penerima');
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
        Schema::dropIfExists('tb_transaksi');
    }
}
