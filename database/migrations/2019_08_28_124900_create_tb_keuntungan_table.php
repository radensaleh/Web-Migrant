<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKeuntunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_keuntungan', function (Blueprint $table) {
            $table->bigIncrements('id_keuntungan');
            $table->string('kd_transaksi')->index();
            $table->foreign('kd_transaksi')->references('kd_transaksi')->on('tb_transaksi');
            $table->integer('keuntungan', false, true);
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
        Schema::dropIfExists('tb_keuntungan');
    }
}
