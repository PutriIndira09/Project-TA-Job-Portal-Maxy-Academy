<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagLowonganKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // database/migrations/xxxx_xx_xx_create_tag_lowongan_kerja_table.php
    public function up()
    {
        Schema::create('tag_lowongan_kerja', function (Blueprint $table) {
            $table->bigIncrements('id_tag_pekerjaan')->unsigned(); // Bigint
            // $table->string('nama_tag');  // Kolom untuk nama tag pekerjaan
            // $table->timestamps();
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_pekerjaan')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_lowongan_kerja', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);
            $table->dropColumn('id_kategori');
        });
    }
}
