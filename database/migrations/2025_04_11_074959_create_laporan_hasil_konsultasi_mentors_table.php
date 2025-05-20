<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHasilKonsultasiMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hasil_konsultasi_mentor', function (Blueprint $table) {
            $table->bigIncrements('id_laporan_mentor');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('nama_maxians');
            $table->text('komentar');
            $table->string('bukti_konsultasi')->nullable(); // Path to the uploaded file
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
        Schema::dropIfExists('laporan_hasil_konsultasi_mentor');
    }
}
