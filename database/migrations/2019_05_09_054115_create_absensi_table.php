<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->bigIncrements('id_absensi');
            $table->integer('id_pegawai');
            $table->string('nama');
            $table->date('tanggal_absen');
            $table->time('jam_masuk')->nullable();
            $table->string('keterangan',15);
            $table->time('jam_keluar')->nullable();
            $table->timestamp('update_at')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
