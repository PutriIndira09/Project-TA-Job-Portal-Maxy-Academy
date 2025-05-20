@extends('partials.partials_maxians.app')

@section('content')
    <!-- Section Header -->
    <div class="container-fluid">
        <h1 class="heading">
            <span class="text-dark">Riwayat Pengajuan</span><br>
            <span class="text-primary">Jadwal Konsultasi Karir</span>
        </h1>

        <p class="sub-heading mt-3">
            Kamu bisa melihat daftar pengajuan jadwal konsultasi karir ke mentor pilihanmu. <br>Jangan lupa catat tanggalnya
            ya!</br>
        </p>

        <!-- Asset Garis Biru Pada Header -->
        {{-- <div class="text-start mt-n2 mb-0">
            <img src="{{ asset('images/blue-line.svg') }}" alt="Blue line" class="img-fluid w-50 px-5">
        </div> --}}
    </div>

    <!-- Section Riwayat Pengajuan Jadwal Konsultasi Karir -->
    <div class="container-fluid mt-5">
        <div class="row g-3 g-lg-4">
            @foreach ($riwayatJadwal as $jadwal)
                <div class="col-12 col-lg-6">
                    <div class="custom-border p-4 rounded-5 d-flex flex-column justify-content-between mb-4">
                        <div class="text-start mb-3">
                            <h3 class="mentor">{{ $jadwal->maxians }}</h3>
                            <p class="sub-heading">
                                {{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') : 'Tanggal belum dipilih' }}
                            </p>
                        </div>

                        <!-- Date Row -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-container">
                                <i class="fas fa-calendar-days fa-lg fa-lg-2x"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <div class="date rounded-5 text-start p-2">
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Question Row -->
                        <div class="d-flex align-items-center">
                            <div class="icon-container">
                                <i class="fas fa-question fa-lg fa-lg-2x"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <div class="question rounded-5 bg-white text-start p-2">
                                    {{ $jadwal->pertanyaan }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
