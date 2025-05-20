<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarLowonganKerjaPerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_lowongan_kerja_perusahaan', function (Blueprint $table) {
            $table->bigIncrements('id_lowongan', 20)->unsigned()->primary();
            $table->unsignedBigInteger('id_perusahaan')->after('id_lowongan');
            $table->foreign('id_perusahaan')->references('id')->on('users');
            $table->string('logo_perusahaan');
            $table->string('nama_kategori');
            $table->string('nama_perusahaan');
            $table->string('alamat');
            $table->string('email')->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->text('deskripsi_pekerjaan')->nullable();
            $table->enum('jenis_kontrak', ['Full Time', 'Part-Time', 'Freelance', 'Intern']);
            $table->enum('lokasi', ['WFO', 'WFH', 'Hybrid']);
            $table->decimal('gaji', 15, 2);
            $table->boolean('is_active')->default(true);  // true for 'Aktif', false for 'Tidak aktif'
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
        Schema::dropIfExists('daftar_lowongan_kerja_perusahaan');
    }
}
