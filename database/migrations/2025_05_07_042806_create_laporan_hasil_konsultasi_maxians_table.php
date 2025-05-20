<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHasilKonsultasiMaxiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hasil_konsultasi_karir_maxians', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->date('tanggal_konsultasi');
            $table->time('jam_konsultasi');
            $table->string('nama_mentor');
            $table->text('komentar');
            // $table->string('file_bukti')->nullable();
            $table->binary('file_bukti'); // Kolom untuk menyimpan binary data gambar
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
        Schema::dropIfExists('laporan_hasil_konsultasi_karir_maxians');
    }
}