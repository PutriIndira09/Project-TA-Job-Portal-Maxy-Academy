<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriPekerjaansTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_pekerjaan', function (Blueprint $table) {
            $table->bigIncrements('id_kategori')->unsigned(); // Bigint auto increment
            $table->string('nama_kategori');  // Perhatikan ini 'nama_kategori' (sesuai struktur di phpMyAdmin)
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Menambahkan kolom id_tag_pekerjaan yang mengacu ke tabel lain
            $table->bigInteger('id_tag_pekerjaan')->unsigned()->nullable();

            // Menambahkan foreign key constraint
            $table->foreign('id_tag_pekerjaan')->references('id_tag_pekerjaan')->on('tag_lowongan_kerja')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_pekerjaan');  // Pastikan sama dengan nama di method up()
    }
}
