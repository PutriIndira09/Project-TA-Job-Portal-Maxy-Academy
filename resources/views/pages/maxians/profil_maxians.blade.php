@extends('partials.partials_maxians.app')

@section('content')

    <!-- Section Form Input -->
    <div class="container-fluid">
        <div class="mb-5" style="position: relative; display: flex; justify-content: center; align-items: center;">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="rounded-circle"
                style="height: 200px; width: 200px; cursor: pointer;" id="profileImage">
        </div>
        
        <form action="{{ route('laporan_hasil_konsultasi_karir') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Nama Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="nama_maxians" class="form-label">Nama :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="nama_maxians" name="nama_maxians"
                        placeholder="Masukkan nama">
                </div>

                <!-- Email Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="email_maxians" class="form-label">Email :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="email_maxians" name="email_maxians"
                        placeholder="Masukkan email">
                </div>

                <!-- Nomor Telepon Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="no_telepon_maxians" class="form-label">No. Telp :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="no_telepon_maxians"
                        name="no_telepon_maxians" placeholder="Masukkan nomor telepon">
                </div>

                <!-- Tanggal Lahir Maxians-->
                <div class="col-md-6 mb-3">
                    <label for="tanggal_lahir_maxians" class="form-label">Tanggal Lahir :</label>
                    <h5 class="input-group">
                        <input type="date" class="form-control rounded-start-5 custom-border rounded-5"
                            id="tanggal_lahir_maxians" name="tanggal_lahir_maxians" placeholder="dd/mm/yyyy">
                    </h5>
                </div>
            </div>

            <div class="row">
                <!-- Alamat Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="alamat_maxians" class="form-label">Alamat :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="alamat_maxians"
                        name="alamat_maxians" placeholder="Masukkan alamat">
                </div>

                <!-- Pendidikan Terakhir Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="pendidikan_terakhir_maxians" class="form-label">Pendidikan Terakhir :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="pendidikan_terakhir_maxians"
                        name="pendidikan_terakhir_maxians" placeholder="Masukkan pendidikan terakhir">
                </div>

                <!-- Jenis Kelamin Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin_maxians" class="form-label">Jenis Kelamin :</label>
                    <select class="form-select rounded-5 custom-border" id="jenis_kelamin_maxians"
                        name="jenis_kelamin_maxians" aria-label="Pilih Jenis Kelamin">
                        <option selected>Pilih jenis kelamin...</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <!-- Jurusan Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="jurusan_maxians" class="form-label">Jurusan :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="jurusan_maxians"
                        name="jurusan_maxians" placeholder="Masukkan jurusan">
                </div>

                <!-- Skill Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="skill_maxians" class="form-label">Skill :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="skill_maxians" name="skill_maxians"
                        placeholder="Masukkan keahlian">
                </div>

                <!-- Pengalaman Kerja Maxians -->
                <div class="col-md-6 mb-3">
                    <label for="pengalaman_kerja_maxians" class="form-label">Pengalaman Kerja :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="pengalaman_kerja_maxians"
                        name="pengalaman_kerja_maxians" placeholder="Masukkan pengalaman kerja">
                </div>
            </div>
        </form>
    </div>
@endsection

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">