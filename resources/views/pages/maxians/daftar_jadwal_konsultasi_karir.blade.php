@extends('partials.partials_maxians.app')

@section('content')
    <!-- Section Header -->
    <div class="container-fluid">
        <h1 class="heading">
            <span class="text-dark">Jadilah Versi Terbaik Dirimu</span><br>
            <span class="text-dark">dengan</span> <span class="text-primary">Bimbingan Mentor Terbaik!</span>
        </h1>

        <!-- Asset Garis Biru Pada Header -->
        <div class="text-end mt-n2 mb-0">
            <img src="{{ asset('images/blue-line.svg') }}" alt="Blue line" class="img-fluid w-50 px-5">
        </div>

        <p class="sub-heading mt-3">
            Dapatkan bimbingan dari mentor ahli di Maxy<br> Academy dan raih kesuksesan karirmu lebih cepat!</br>
        </p>
    </div>

    <div class="container-fluid mt-5 d-flex flex-wrap gap-2 mb-5">
        <a href="{{ route('daftar_mentor') }}" class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Daftar Mentor
        </a>
        <a href="{{ route('daftar_jadwal_konsultasi_karir') }}"
            class="btn btn-warning rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Jadwal Konsultasi Karir
        </a>
        <a href="{{ route('laporan_hasil_konsultasi_karir') }}"
            class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Laporan Hasil
        </a>
        <a href="{{ route('pengajuan_jadwal_konsultasi_karir') }}"
            class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Lihat Hasil Jadwal
        </a>
    </div>

    <!-- Section Mentor -->
    <div class="container-fluid">
        <div class="p-0">
            <div class="row align-items-center">
                <div class="col-lg-6 px-3 position-relative mb-0">
                    <div class="ms-n2">
                        <img src="{{ asset('images/ko-isaac.png') }}" alt="Career Consultation" class="img-fluid">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="position-relative mt-n5 pt-0 mt-5">
                        <div class="position-absolute" style="left: -30px; top: 5px;">
                            <img src="{{ asset('images/quote.svg') }}" alt="Quote" class="img-fluid" width="35">
                        </div>

                        <div class="ms-4 pe-0">
                            <h1 class="header-schedule-career-consultation">
                                Sebagai CEO, saya memimpin tim, mengembangkan strategi, dan memastikan pertumbuhan
                                perusahaan
                                melalui keputusan berbasis data.
                            </h1>
                        </div>

                        <!-- Ganti bagian form dengan ini -->
                        <form id="jadwalForm" action="{{ route('submit_jadwal_konsultasi') }}" method="POST">
                            @csrf
                            <div class="d-flex align-items-center mt-4">
                                <!-- Kolom Kalender -->
                                <div class="d-flex align-items-center justify-content-center"
                                    style="width: 45px; height: 45px; margin-left: -38px;">
                                    <i class="fas fa-calendar-days fa-2x"></i>
                                </div>
                                <!-- Kolom Tanggal -->
                                <div class="ms-3 flex-grow-1">
                                    <select class="form-select rounded-5 custom-border" id="tanggalDropdown" name="tanggal"
                                        required>
                                        <option value="" selected disabled>Pilih Tanggal</option>
                                        @foreach ($dates as $date)
                                            @if (!empty($date))
                                                <option value="{{ $date }}">
                                                    {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-4">
                                <!-- Kolom Pertanyaan -->
                                <div class="d-flex align-items-center justify-content-center"
                                    style="width: 45px; height: 45px; margin-left: -38px;">
                                    <i class="fas fa-question fa-2x"></i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h5 class="input-group">
                                        <input type="text" class="form-control rounded-5 custom-border" name="pertanyaan"
                                            placeholder="Ketik pertanyaanmu disini..." required>
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary rounded-5 ms-3">Ajukan jadwal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Nama, Profesi, dan Gambar Logo Maxy -->
        <div class="mt-5">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <img src="{{ asset('images/rectangle.svg') }}" alt="Rectangle" class="img-fluid" width="15">
                    </div>
                    <div>
                        <h2 class="mentor-name">Isaac Munandar</h2>
                        <p class="mentor-profession">Chief Executive Officer</p>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalDropdown = document.getElementById('tanggalDropdown');
            const waktuDropdown = document.getElementById('waktuDropdown');
            const form = document.getElementById('jadwalForm');

            // Handle session alerts
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @elseif (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif

            // Handle tanggal dropdown change
            tanggalDropdown.addEventListener('change', function() {
                const selectedDate = this.value;
                waktuDropdown.innerHTML = '<option value="" selected disabled>Pilih Waktu</option>';
                waktuDropdown.disabled = !selectedDate;

                if (selectedDate) {
                    // Mengambil data jadwal via AJAX
                    axios.get('{{ route('api.jadwal_konsultasi') }}', {
                            params: {
                                tanggal: selectedDate
                            }
                        })
                        .then(response => {
                            if (response.data.success && response.data.data.length > 0) {
                                response.data.data.forEach(jam => {
                                    const option = document.createElement('option');
                                    option.value = jam.raw_jam;
                                    option.textContent = jam.jam;
                                    waktuDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.textContent = 'Tidak ada jadwal tersedia';
                                option.disabled = true;
                                waktuDropdown.appendChild(option);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching jadwal:', error);
                            const option = document.createElement('option');
                            option.textContent = 'Error memuat jadwal';
                            option.disabled = true;
                            waktuDropdown.appendChild(option);
                        });
                }
            });

            // Handle form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Ini penting supaya nggak reload halaman

                Swal.fire({
                    title: 'Konfirmasi Pengajuan',
                    text: 'Apakah Anda yakin ingin mengajukan jadwal konsultasi ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                   confirmButtonText: '<span class="rounded-pill px-4 py-2 d-inline-block text-white">Ya, Ajukan!</span>',
    cancelButtonText: '<span class="rounded-pill px-4 py-2 d-inline-block text-white">Batal</span>',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData(form);

                        axios.post(form.action, formData)
                            .then(response => {
                                const res = response.data;

                                if (res.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: res.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Redirect ke halaman setelah OK diklik
                                        window.location.href = res.redirect;
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: error.response?.data?.message ||
                                        'Terjadi kesalahan saat mengirim jadwal.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                    }
                });
            });
        });
    </script>
@endpush
