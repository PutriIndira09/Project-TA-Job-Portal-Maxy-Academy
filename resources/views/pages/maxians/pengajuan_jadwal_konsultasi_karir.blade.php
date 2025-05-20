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
            class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Jadwal Konsultasi Karir
        </a>
        <a href="{{ route('laporan_hasil_konsultasi_karir') }}"
            class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Laporan Hasil
        </a>
        <a href="{{ route('pengajuan_jadwal_konsultasi_karir') }}"
            class="btn btn-warning rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
            Lihat Hasil Jadwal
        </a>
    </div>

    <!-- Section Hasil Pengajuan Jadwal Konsultasi Karir -->
    <div class="container-fluid mt-3 mt-md-5 mb-4">
        <div class="row g-3 g-lg-4">
            <!-- Card Mentor -->
            <div class="col-12 col-lg-12">
                <div
                    class="custom-border p-4 p-lg-5 rounded-5 d-flex flex-column justify-content-center h-100 mb-3 mb-lg-0">
                    <div class="text-start mb-3 mb-lg-4">
                        <h3 class="mentor">Isaac Munandar</h3>
                        <p class="sub-heading mb-4 mb-lg-5">
                            Chief Executive Officer
                        </p>
                    </div>

                    <!-- Date Row -->
                    <div class="d-flex align-items-center mb-3" style="margin-left: -13px">
                        <div class="icon-container">
                            <i class="fas fa-calendar-days fa-lg fa-lg-2x"></i>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="date rounded-5 text-start p-2">
                                {{-- Display the selected date --}}
                                {{ session('tanggal') ? \Carbon\Carbon::parse(session('tanggal'))->translatedFormat('d F Y') : 'Tanggal belum dipilih' }}
                            </div>
                        </div>
                    </div>

                    <!-- Question Row -->
                    <div class="d-flex align-items-center" style="margin-left: -13px">
                        <div class="icon-container">
                            <i class="fas fa-question fa-lg fa-lg-2x"></i>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="question rounded-5 bg-white text-start p-2">
                                {{-- Display the submitted question --}}
                                {{ session('pertanyaan') ?? 'Pertanyaan belum diajukan' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button type="button" class="btn btn-create rounded-5"
                    onclick="window.location='{{ route('riwayat_pengajuan_jadwal_konsultasi') }}'">Lihat Riwayat
                    Pengajuan <i class="fa-solid fa-arrow-right ms-3"></i></button>
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

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
