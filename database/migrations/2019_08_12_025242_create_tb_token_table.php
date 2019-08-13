<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_token', function (Blueprint $table) {
            $table->bigIncrements('id_token');
            $table->string('token');
            $table->string('kd_koordinator')->index();
            $table->foreign('kd_koordinator')->references('kd_koordinator')->on('tb_koordinator');
            $table->string('status');
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
        Schema::dropIfExists('tb_token');
    }
}
