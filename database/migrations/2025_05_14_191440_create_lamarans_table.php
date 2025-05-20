<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLamaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->bigIncrements('id_lamaran')->unsigned();
            $table->unsignedBigInteger('id_lowongan'); // Relasi ke lowongan
            $table->unsignedBigInteger('user_id'); // Relasi ke pengguna yang melamar
            $table->enum('status_lamaran', ['diproses', 'diterima', 'ditolak'])->default('diproses'); // Status lamaran (pending, diterima, ditolak)
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_lowongan')->references('id_lowongan')->on('daftar_lowongan_kerja_perusahaan');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lamaran_kerja', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
