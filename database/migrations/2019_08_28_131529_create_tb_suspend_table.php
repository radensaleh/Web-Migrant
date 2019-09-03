<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSuspendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_suspend', function (Blueprint $table) {
            $table->bigIncrements('id_suspend');
            $table->string('kd_barang')->index();
            $table->foreign('kd_barang')->references('kd_barang')->on('tb_barang');
            $table->string('pesan');
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
        Schema::dropIfExists('tb_suspend');
    }
}
