<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_chat', function (Blueprint $table) {
            $table->bigIncrements('id_chat');
            $table->string('kd_user')->index();
            $table->foreign('kd_user')->references('kd_user')->on('tb_user');
            $table->string('kd_toko')->index();
            $table->foreign('kd_toko')->references('kd_toko')->on('tb_toko');
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
        Schema::dropIfExists('tb_chat');
    }
}
