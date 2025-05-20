{{--tabel pivot untuk menghubungkan relasi manyto many antara tag lowongan kerja (role admin) dengan kategori pekerjaan (role perusahaan)-}}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration untuk tabel pivot kategori_tag
        Schema::create('kategori_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_pekerjaan')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tag_lowongan_kerja')->onDelete('cascade');
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
        Schema::dropIfExists('kategori_tag');
    }
}
