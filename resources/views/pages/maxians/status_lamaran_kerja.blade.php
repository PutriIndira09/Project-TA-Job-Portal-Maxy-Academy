@extends('partials.partials_maxians.app')

@section('content')
    <!-- Section Header -->
    <div class="container-fluid">
        <h1 class="heading">
            <span class="text-dark">Sudah Siap Menemukan<br></span>
            <span class="text-primary">Pekerjaan Impianmu?</span>
        </h1>

        <p class="sub-heading mt-3">
            Setelah mengirimkan lamaran, kamu bisa memantau status lamaran<br>
            dan melihat jadwal tes seleksi dengan mudah di sini!</br>
        </p>
    </div>

    <div class="container-fluid">
        <div class="mt-5">
            <div class="d-flex align-items-start justify-content-start">
                <div>
                    <img src="{{ asset('images/logo-maxy.svg') }}" alt="Logo Maxy" class="img-fluid" width="300">
                </div>
            </div>
        </div>
    </div>

    <!-- Section Status Lamaran Kerja -->
    <div class="container-fluid mt-5">
        @foreach ($lamarans as $lamaran)
            <div class="col-md-12">
                <div class="card custom-border rounded-5 p-5 mb-3" style="height: auto">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($lamaran->lowongan->logo_perusahaan ?? 'images/default-logo.png') }}"
                                alt="Logo {{ $lamaran->lowongan->nama_perusahaan }}" width="100" height="100"
                                class="rounded-circle me-3">
                            <div>
                                <h4 class="card-title mb-0">{{ $lamaran->lowongan->nama_perusahaan }}</h4>
                                <h6 class="location-job mt-1">{{ $lamaran->lowongan->kategoriPekerjaan->nama_kategori }}
                                </h6>
                                <h6 class="location-job mb-0">{{ $lamaran->lowongan->alamat }}</h6>
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <a href="#" type="button" class="btn btn-date-job rounded-5 btn-sm me-3 px-3 mb-2">
                                {{ $lamaran->created_at->format('d F Y') }}
                            </a>
                            <a href="#" type="button"
                                class="btn rounded-5 btn-sm me-3 px-3 mb-2 
                                @if ($lamaran->status_lamaran == 'diproses') btn-create
                                @elseif($lamaran->status_lamaran == 'diterima') btn-edit
                                @elseif($lamaran->status_lamaran == 'ditolak') btn-delete @endif"
                                onclick="updateStatus({{ $lamaran->id_lamaran }}, '{{ $lamaran->status_lamaran }}')">
                                {{ ucfirst($lamaran->status_lamaran) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
