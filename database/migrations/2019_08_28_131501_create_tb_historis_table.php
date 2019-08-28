<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbHistorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_historis', function (Blueprint $table) {
            $table->bigIncrements('id_historis');
            $table->string('kd_pesanan')->index();
            $table->foreign('kd_pesanan')->references('kd_pesanan')->on('tb_pesanan');
            $table->string('foto_bukti');
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
        Schema::dropIfExists('tb_historis');
    }
}
