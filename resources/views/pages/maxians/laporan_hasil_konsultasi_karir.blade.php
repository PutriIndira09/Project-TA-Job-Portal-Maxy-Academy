@extends('partials.partials_maxians.app')

@section('content')
    <!-- Section Header -->
    <div class="container-fluid">
        <h1 class="heading">
            <span class="text-dark">Bagaimana</span>
            <span class="text-primary">Hasil Konsultasinya?</span><br>
            <span class="text-dark">Yuk</span>
            <span class="text-primary">Tulis Laporannya</span>
            <span class="text-dark">Disini Ya...</span>
        </h1>

        <p class="sub-heading mt-3">
            Kamu bisa menuliskan hasil dari konsultasi karir berdasarkan <br> pengalamanmu ya, sebagai bahan evaluasi kami
            untuk
            kedepannya!</br>
        </p>
    </div>

    <div class="container-fluid mt-5 d-flex flex-wrap gap-2 mb-5">
        <a href="{{ route('daftar_mentor') }}" class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Daftar Mentor
        </a>
        <a href="{{ route('daftar_jadwal_konsultasi_karir') }}"
            class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Jadwal Konsultasi Karir
        </a>
        <a href="{{ route('laporan_hasil_konsultasi_karir') }}"
            class="btn btn-warning rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Laporan Hasil
        </a>
        <a href="{{ route('pengajuan_jadwal_konsultasi_karir') }}"
            class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Lihat Hasil Jadwal
        </a>
    </div>

    <!-- Section Form Input -->
    <div class="container-fluid">
        <form action="{{ route('laporan_hasil_konsultasi_karir') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Tanggal Konsultasi -->
                <div class="col-md-4 mb-3">
                    <label for="tanggal_konsultasi" class="form-label">Tanggal Konsultasi Karir :</label>
                    <h5 class="input-group">
                        <input type="date" class="form-control rounded-start-5 custom-border rounded-5"
                            id="tanggal_konsultasi" name="tanggal_konsultasi" placeholder="dd/mm/yyyy">
                    </h5>
                </div>

                <!-- Jam Konsultasi -->
                <div class="col-md-4 mb-3">
                    <label for="jam_konsultasi" class="form-label">Jam Konsultasi Karir :</label>
                    <input type="time" class="form-control custom-border rounded-5" id="jam_konsultasi"
                        name="jam_konsultasi">
                </div>

                <!-- Nama Mentor -->
                <div class="col-md-4 mb-3">
                    <label for="nama_mentor" class="form-label">Nama Mentor :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="nama_mentor" name="nama_mentor"
                        placeholder="Masukkan nama mentor">
                </div>
            </div>

            <div class="row">
                <!-- Komentar -->
                <div class="col-md-6 mt-3">
                    <label for="komentar" class="form-label">Komentar :</label>
                    <textarea class="form-control custom-border rounded-5" id="komentar" name="komentar" rows="3"
                        placeholder="Tulis sesuatu..."></textarea>
                </div>

                <!-- Upload Bukti Konsultasi -->
                <div class="col-md-6 mt-3">
                    <label for="file_bukti" class="form-label">Upload Bukti Konsultasi Karir :</label>
                    <input type="file" class="form-control custom-border rounded-5" id="file_bukti" name="file_bukti"
                        accept="image/*">
                    <!-- Preview Image -->
                    <img id="imagePreview" src="#" alt="Preview Image" class="mt-3"
                        style="max-width: 100%; max-height: 200px; display: none;">
                </div>
            </div>
        </form>
    </div>

    <!-- Section Hasil Pengajuan Jadwal Konsultasi Karir -->
    <div class="container-fluid">
        <div class="mt-5">
            <div class="d-flex align-items-start justify-content-between">
                <div class="d-flex align-items-center">
                    <div>
                        <button type="sumbit" class="btn btn-primary rounded-5" id="submitBtn">Kirim</button>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/logo-maxy.svg') }}" alt="Logo Maxy" class="img-fluid" width="300">
                </div>
            </div>
        </div>
    </div>

    <!-- Section Navigasi Lowongan Kerja dan Konsultasi Karir -->
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 position-relative">
                <a href="https://api.whatsapp.com/send/?phone=628113955599&text=Hi+Maxy+Academy%21+Mau+nanya-nanya+dong..%0D%0A%0D%0ANama%3A%0D%0AEmail%3A%0D%0AUniversitas%3A%0D%0ASemester%3A%0D%0AJurusan%3A%0D%0A%0D%0AThank+you%21&type=phone_number&app_absent=0"
                    target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/cta-whatsapp.png') }}" alt="Gambar Promosi" class="img-fluid" />
                </a>
            </div>
        </div>
    </div>
@endsection

<!-- SweetAlert2 Script for Notifications -->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        // Show image preview when file is selected
        document.getElementById('file_bukti').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const reader = new FileReader();

            if (file) {
                if (file.size > 2 * 1024 * 1024) { // Check if file size is larger than 2MB
                    Swal.fire({
                        title: 'File terlalu besar!',
                        text: 'Ukuran file tidak boleh lebih dari 2MB.',
                        icon: 'error',
                    });
                    event.target.value = ""; // Clear the file input
                    imagePreview.style.display = 'none'; // Hide the image preview
                } else {
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Handle form submission and show success notification
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission for now

            Swal.fire({
                title: 'Data Berhasil Disimpan',
                text: 'Laporan hasil konsultasi karir Anda berhasil disimpan!',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form after the notification
                    document.querySelector('form').submit();
                }
            });
        });
    </script>
@endpush
