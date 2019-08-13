<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pesanan', function (Blueprint $table) {
            $table->string('kd_pesanan')->primary();
            $table->string('kd_transaksi')->index();
            $table->foreign('kd_transaksi')->references('kd_transaksi')->on('tb_transaksi');
            $table->integer('total_harga', false, true);
            $table->integer('ongkir', false, true);
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
        Schema::dropIfExists('tb_pesanan');
    }
}
