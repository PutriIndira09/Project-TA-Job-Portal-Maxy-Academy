<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktivasiAkunsTable extends Migration
{
    public function up()
    {
        Schema::create('aktivasi_akun', function (Blueprint $table) {
            $table->bigIncrements('id_pengguna'); // Bigint
            $table->string('foto_profil')->nullable();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->enum('role', ['company relationship', 'Mentor', 'Perusahaan', 'Maxians'])->default('company relationship');
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aktivasi_akun');
    }
}
