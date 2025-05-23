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
            <img src="{{ asset('images/blue-line.svg') }}" alt="Blue line" class="img-fluid w-30 px-5">
        </div>

        <p class="sub-heading mt-5">
            Dapatkan bimbingan dari mentor ahli di Maxy<br> Academy dan raih kesuksesan karirmu lebih cepat!</br>
        </p>
    </div>

    <div class="container-fluid mt-5 d-flex flex-wrap gap-2">
        <a href="{{ route('daftar_mentor') }}" class="btn btn-warning rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
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
            class="btn btn-primary rounded-5 btn-sm px-3 flex-grow-1 flex-md-grow-0">
           Lihat Hasil Jadwal
        </a>
    </div>

    <!-- Section Daftar Mentor -->
    <div class="container-fluid">
        <div class="row g-4 mt-5">
            <div class="col-md-3 text-center">
                <div class="card custom-border position-relative">
                    <a href="{{ route('daftar_jadwal_konsultasi_karir') }}" class="stretched-link"></a>
                    <img src="{{ asset('images/isaac-munandar.png') }}" alt="Isaac Munandar" class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Isaac Munandar</h5>
                        <p class="card-text">Chief Executive Office</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/isaacmunandar/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <div class="card custom-border">
                    <img src="{{ asset('images/stefen-laksana.png') }}" alt="Stefen Laksana" class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Stefen Laksana</h5>
                        <p class="card-text">VP of Product Delivery</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/stefenlaksana/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card custom-border">
                    <img src="{{ asset('images/andy-febrico.png') }}" alt="Andy Febrico B." class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Andy Febrico B.</h5>
                        <p class="card-text">Chief Technology Office</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/andytoro/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card custom-border">
                    <img src="{{ asset('images/william-wibisono.png') }}" alt="William Wibisono" class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">William Wibisono</h5>
                        <p class="card-text">Operational Manager</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/william-ch/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-4 mt-3">
            <div class="col-md-3 text-center">
                <div class="card custom-border">
                    <img src="{{ asset('images/ika-noviani.png') }}" alt="Ika Noviani" class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Ika Noviani</h5>
                        <p class="card-text">Operational Manager</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/ika-pratiwi-4030a72b/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card">
                    <img src="{{ asset('images/sydney-rosalind.png') }}" alt="Sydney Rosalind" class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Sydney Rosalind</h5>
                        <p class="card-text">Operational Manager</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/sydney-rosalind/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card custom-border">
                    <img src="{{ asset('images/jessica-charisma.png') }}" alt="Jessica Charisma" class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Jessica Charisma</h5>
                        <p class="card-text">Operational Manager</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/jessicacharisma/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="card custom-border">
                    <img src="{{ asset('images/indana-nazulfa.png') }}" alt="Indana Nazulfa" class="rounded-top-1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Indana Nazulfa</h5>
                        <p class="card-text">Operational Manager</p>
                        <div class="mt-auto">
                            <a href="https://www.linkedin.com/in/indana-nazulfa-942933188/" class="btn btn-link d-flex justify-content-start">
                                <i class="fa-brands fa-linkedin linkedin-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Navigasi Lowongan Kerja dan Konsultasi Karir -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 position-relative mt-5">
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
