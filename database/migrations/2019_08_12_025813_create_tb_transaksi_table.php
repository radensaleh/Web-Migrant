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
            $table->bigInteger('id_status')->unsigned();
            $table->index('id_status');
            $table->foreign('id_status')->references('id_status')->on('tb_status');
            $table->date('tgl_transaksi');
            $table->integer('total_harga');
            $table->string('no_resi')->nullable();
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
