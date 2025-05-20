<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenLamaranTable extends Migration
{
    public function up()
    {
        Schema::create('dokumen_lamaran', function (Blueprint $table) {
            $table->id('id_dokumen'); // Primary key dengan nama khusus
            $table->string('cv')->nullable();
            $table->string('portofolio')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_linkedin')->nullable();
            // $table->enum('status', ['Diproses', 'Diterima', 'Ditolak', 'Tes'])->default('Diproses');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen_lamaran');
    }
}