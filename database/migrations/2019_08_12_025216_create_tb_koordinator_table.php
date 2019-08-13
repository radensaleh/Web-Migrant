<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKoordinatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_koordinator', function (Blueprint $table) {
            $table->string('kd_koordinator')->primary();
            $table->string('KTP');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('nomer_hp');
            $table->string('email');
            $table->string('password');
            $table->string('provinsi');
            $table->string('daerah');
            $table->string('nama_daerah');
            $table->string('detail_alamat');
            $table->string('foto_koordinator');
            $table->string('poin');
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
        Schema::dropIfExists('tb_koordinator');
    }
}
