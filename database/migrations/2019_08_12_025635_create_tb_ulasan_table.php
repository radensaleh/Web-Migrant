<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbUlasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ulasan', function (Blueprint $table) {
            $table->bigIncrements('id_ulasan');
            $table->string('kd_user')->index();
            $table->foreign('kd_user')->references('kd_user')->on('tb_user');
            $table->string('kd_barang')->index();
            $table->foreign('kd_barang')->references('kd_barang')->on('tb_barang');
            $table->string('deskripsi_ulasan');
            $table->integer('rating', false, true);
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('tb_ulasan');
    }
}
