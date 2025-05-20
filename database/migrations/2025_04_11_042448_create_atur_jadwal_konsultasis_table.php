<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAturJadwalKonsultasisTable extends Migration
{
    public function up()
    {
        Schema::create('atur_jadwal_konsultasi', function (Blueprint $table) {
            $table->bigIncrements('id_jadwal_konsultasi');
            $table->string('maxians', 255);
            $table->string('mentor', 255);
            $table->date('tanggal');
            $table->time('jam');
            $table->date('tanggal_baru');
            $table->time('jam_baru');
            $table->text('alasan');
            $table->text('pertanyaan');
            $table->text('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atur_jadwal_konsultasi');
    }
}
