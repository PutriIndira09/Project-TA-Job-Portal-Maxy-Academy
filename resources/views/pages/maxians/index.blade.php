@extends('partials.partials_maxians.app')

@section('content')
    <div class="container-fluid">
        <!-- Section Hero Banner -->
        <div class="row hero-section">
            <!-- Text pada Hero Banner -->
            <div class="col-lg-6 d-flex flex-column justify-content-center hero-text-container">
                <h1 class="hero-text text-nowrap">
                    Yuk Raih Peluang
                </h1>
                <h1 class="hero-text text-nowrap">
                    Karirmu Bersama
                </h1>

                <h1 class="hero-text custom-text text-uppercase text-center">
                    MAXY ACADEMY
                    <span class="top-right"></span>
                    <span class="bottom-left"></span>
                </h1>
                <p class="sub-heading mt-3">
                    Bergabunglah dengan perusahaan terkemuka! Proses rekrutmen cepat dan transparan untuk meraih karier
                    impian!
                </p>

                <!-- Search Bar -->
                <div class="mt-5">
                    <a type="button" href="{{ route('daftar_lowongan_kerja') }}" class="btn btn-primary rounded-5">Yuk cari
                        peluang kerja kamu disini! <i class="fa-solid fa-arrow-right ms-3"></i></a>
                </div>
            </div>

            <!-- Gambar pada Hero Banner -->
            <div class="col-lg-6 d-flex justify-content-end align-items-end hero-image-container">
                <img src="{{ asset('images/hero.png') }}" alt="Maxy Academy Image" class="img-fluid">
            </div>

            <!-- Alur Melamar Pekerjaan-->
            <div class="mt-0">
                <img src="{{ asset('images/alur melamar pekerjaan.png') }} "
                    class="image-workflow w-100 h-100 object-fit-cover" alt="Maxy Academy Image">
            </div>
        </div>

        <!-- Section Owl Carousel Partner Maxy Academy -->
        <!-- Baris Ke-1 -->
        <div class="mt-5">
            <div class="owl-carousel owl-theme" id="carousel-row1">
                <div class="item">
                    <img src="{{ asset('images/skintific.png') }}" alt="SKINTIFIC" class="logo-img">
                </div>
                <div class="item">
                    <img src="{{ asset('images/schneider.png') }}" alt="Schneider Electric" class="logo-img">
                </div>
                <div class="item">
                    <img src="{{ asset('images/anteraja.png') }}" alt="Anteraja" class="logo-img">
                </div>
                <div class="item">
                    <img src="{{ asset('images/loreal.png') }}" alt="L'OREAL" class="logo-img">
                </div>
                <div class="item">
                    <img src="{{ asset('images/kedaisayur.png') }}" alt="Kedaisayur" class="logo-img">
                </div>
                <div class="item">
                    <img src="{{ asset('images/ituloh.png') }}" alt="Ituloh" class="logo-img">
                </div>
            </div>
        </div>

        <!-- Baris Ke-2 -->
        <div class="mb-5 mt-5">
            <div class="owl-carousel owl-theme" id="carousel-row2">
                <div class="item">
                    <img src="{{ asset('images/unesa.png') }}" alt="Unesa" class="logo-img2">
                </div>
                <div class="item">
                    <img src="{{ asset('images/pradita.png') }}" alt="Pradita" class="logo-img2">
                </div>
                <div class="item">
                    <img src="{{ asset('images/telkom.png') }}" alt="Telkom" class="logo-img2">
                </div>
                <div class="item">
                    <img src="{{ asset('images/umn.png') }}" alt="Umn" class="logo-img2">
                </div>
                <div class="item">
                    <img src="{{ asset('images/um.png') }}" alt="Um" class="logo-img2">
                </div>
                <div class="item">
                    <img src="{{ asset('images/unj.png') }}" alt="Unj" class="logo-img2">
                </div>
            </div>
        </div>

        {{-- <!-- Section Navigasi Lowongan Kerja dan Konsultasi Karir -->
        <div class="row justify-content-center">
            <div class="col-md-12 position-relative">
                <img src="{{ asset('images/navigasi-2.png') }}" alt="Gambar Promosi" class="img-fluid" />

                <!-- First Button (Pelajari Lebih Lanjut - Left) -->
                <a href="{{ route('daftar_lowongan_kerja') }}" class="promo-btn position-absolute"
                    style="bottom: 20%; left: 17%;">
                    Pelajari Lebih Lanjut
                </a>

                <!-- Second Button (Pelajari Lebih Lanjut - Right) -->
                <a href="{{ route('daftar_mentor') }}" class="promo-btn position-absolute"
                    style="bottom: 20%; right: 25%;">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div> --}}

        <!-- Section Navigasi Lowongan Kerja dan Konsultasi Karir -->
        <div class="row justify-content-center">
            <div class="col-md-12 position-relative">
                <img src="{{ asset('images/navigasi-2.png') }}" alt="Gambar Promosi" class="img-fluid w-100" />

                <!-- First Button (Pelajari Lebih Lanjut - Left) -->
                <a href="{{ route('daftar_lowongan_kerja') }}" class="promo-btn position-absolute left-button">
                    Pelajari Lebih Lanjut
                </a>

                <!-- Second Button (Pelajari Lebih Lanjut - Right) -->
                <a href="{{ route('daftar_mentor') }}" class="promo-btn position-absolute right-button">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>

        <!-- Section Alur Konsultasi Karir -->
        <div class="mt-5 p-0">
            <div class="row align-items-center">
                <!-- Image Section -->
                <div class="col-lg-6 px-3 position-relative">
                    <div class="ms-n4"> <!-- negative margin to shift left -->
                        <img src="{{ asset('images/alur-konsultasi-karir.png') }}" alt="Career Consultation"
                            class="img-fluid">
                    </div>
                </div>

                <!-- Text Section -->
                <div class="col-lg-6 text-left">
                    <h1 class="heading">
                        <span class="text-dark">Ikuti </span><span class="text-primary">konsultasi karir</span><span
                            class="text-dark"> & Raih </span><span class="text-primary">Masa Depan</span><span
                            class="text-dark">mu!</span>
                    </h1>

                    <p class="sub-heading mt-3 mb-5">
                        Maxians dapat mengikuti alur berikut :
                    </p>

                    <!-- Langkah-Langkah Konsultasi Karir -->
                    <div class="steps-career">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; min-width: 40px;">
                                <span>1.</span>
                            </div>
                            <div class="ms-3 w-100">
                                <button class="btn btn-outline-primary rounded-pill w-100 step-button">Lihat daftar
                                    mentor</button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; min-width: 40px;">
                                <span>2.</span>
                            </div>
                            <div class="ms-3 w-100">
                                <button class="btn btn-outline-primary rounded-pill w-100 step-button">Pilih mentor yang
                                    sesuai</button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; min-width: 40px;">
                                <span>3.</span>
                            </div>
                            <div class="ms-3 w-100">
                                <button class="btn btn-outline-primary rounded-pill w-100 step-button">Ajukan jadwal
                                    konsultasi karir</button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; min-width: 40px;">
                                <span>4.</span>
                            </div>
                            <div class="ms-3 w-100">
                                <button class="btn btn-outline-primary rounded-pill w-100 step-button">Ajukan pertanyaan
                                    pada form</button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="mb-5 rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; min-width: 40px;">
                                <span>5.</span>
                            </div>
                            <div class="ms-3 mb-5 w-100">
                                <button class="btn btn-outline-primary rounded-pill w-100 step-button">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section CTA Konsultasi Karir -->
        <div class="row hero-section mt-5">
            <div class="col-lg-6 d-flex flex-column justify-content-center hero-text-container">
                <h1 class="heading mb-3">
                    <span class="text-dark">Bersama Mentor Tepat, </span><span class="text-primary">Kesuksesan Lebih
                        Dekat!</span>
                </h1>
                <p class="sub-heading mt-3">
                    Dapatkan bimbingan langsung dari mentor ahli untuk sukses! Jangan biarkan kebingungan menghalangi
                    potensimu!
                </p>
                <!-- CTA Halaman Konsultasi Karir -->
                <h5 class="mt-5">
                    <a href="{{ route('daftar_mentor') }}" class="btn btn-primary rounded-5 custom-btn"
                        style="width: 250px;" role="button">
                        Konsultasi Sekarang <i class="fa-solid fa-arrow-right ms-3"></i>
                    </a>
                </h5>
            </div>

            <!-- Gambar Mentor -->
            <div class="col-lg-6 mb-5 d-flex justify-content-end align-items-end hero-image-container">
                <img src="{{ asset('images/mentor.png') }}" alt="Maxy Academy Image" class="img-fluid">
            </div>
        </div>

        <!-- Section Navigasi Lowongan Kerja dan Konsultasi Karir -->
        <div class="row justify-content-center">
            <div class="col-md-12 position-relative">
                <a href="https://api.whatsapp.com/send/?phone=628113955599&text=Hi+Maxy+Academy%21+Mau+nanya-nanya+dong..%0D%0A%0D%0ANama%3A%0D%0AEmail%3A%0D%0AUniversitas%3A%0D%0ASemester%3A%0D%0AJurusan%3A%0D%0A%0D%0AThank+you%21&type=phone_number&app_absent=0"
                    target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/cta-whatsapp.png') }}" alt="Gambar Promosi" class="img-fluid" />
                </a>
            </div>
        </div>

        <!-- Section Benefit Konsultasi Karir -->
        <div class="col-lg-12 mt-5">
            <h1 class="heading">
                <span class="text-primary">Benefit </span><span class="text-dark">yang Akan Kamu Dapatkan Jika Kamu
                    Mengikuti</span>
                <span class="text-primary">Konsultasi Karir</span><span class="text-dark">...</span>
            </h1>
            <p class="sub-heading mt-3">Maxians akan mendapatkan :</p>
        </div>

        <!-- Section Benefit Konsultasi Karir -->
        <div class="container py-5 mb-0">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- First Slide: Two Cards -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <!-- First Card: Panduan Karir -->
                            <div class="col-12 col-md-6 position-relative mb-4 mb-md-0">
                                <div class="card p-5 rounded-5 custom-border">
                                    <h4 class="title-benefit">Panduan Karir yang Lebih Jelas</h4>
                                    <p class="sub-heading mt-3">Dapatkan posisi impianmu bersama mitra kami.
                                    </p>
                                </div>
                            </div>

                            <!-- Second Card: Jaringan dan Peluang Kerja -->
                            <div class="col-12 col-md-6 position-relative">
                                <div class="card p-5 rounded-5 custom-border">
                                    <h4 class="title-benefit">Jaringan dan Peluang Kerja</h4>
                                    <p class="sub-heading mt-3">Akses peluang karir eksklusif melalui jaringan luas.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Slide: Two Cards -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <!-- Third Card: Bimbingan dari Mentor Profesional -->
                            <div class="col-12 col-md-6 position-relative mb-4 mb-md-0">
                                <div class="card p-5 rounded-5 custom-border">
                                    <h4 class="title-benefit">Bimbingan dari Mentor Profesional</h4>
                                    <p class="sub-heading mt-3">Temukan jalur karir yang tepat bersama mentor professional.
                                    </p>
                                </div>
                            </div>

                            <!-- Fourth Card: Pelatihan & Pengembangan -->
                            <div class="col-12 col-md-6 position-relative">
                                <div class="card p-5 rounded-5 custom-border">
                                    <h4 class="title-benefit">Pelatihan & Pengembangan</h4>
                                    <p class="sub-heading mt-3">Dapatkan pelatihan dari untuk meningkatkan
                                        keterampilan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Custom Carousel Controls (using btn-circle) -->
                <div class="d-flex justify-content-between position-absolute w-100"
                    style="top: 50%; transform: translateY(-50%);">
                    <button class="btn-circle left-btn ms-3" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button class="btn-circle right-btn me-3" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Section FAQ -->
        <div class="col-lg-12">
            <h1 class="heading">
                <span class="text-dark">Temukan Jawaban untuk Memulai Karir Anda Bersama </span><span
                    class="text-primary">Maxy
                    Academy!</span>
            </h1>
            <p class="sub-heading mt-3">Maxy Academy siap bantu Anda cari pekerjaan! Temukan info cepat di job portal
                kami
                dan wujudkan karir impian Anda!</p>
        </div>

        <!-- Accordion FAQ -->
        <div class="accordion mt-5" id="faqAccordion">
            <!-- First Accordion Item -->
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button custom-accordion-btn collapsed custom-border" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne">
                        Bagaimana cara mendaftar akun sebagai pelamar di platform ini?
                        <span class="accordion-icon">
                            <i class="bi bi-plus"></i> <!-- Ikon plus (+) -->
                            <i class="bi bi-dash"></i> <!-- Ikon minus (-) -->
                        </span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Anda dapat mendaftar dengan mengunjungi halaman pendaftaran platform, memasukkan detail pribadi,
                        dan
                        mengunggah dokumen yang diperlukan.
                    </div>
                </div>
            </div>

            <!-- Second Accordion Item -->
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button custom-accordion-btn collapsed custom-border" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        Bagaimana cara pelamar mengubah atau memperbarui profil dan berkas lamaran mereka?
                        <span class="accordion-icon">
                            <i class="bi bi-plus"></i> <!-- Ikon plus (+) -->
                            <i class="bi bi-dash"></i> <!-- Ikon minus (-) -->
                        </span>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Anda dapat memperbarui profil dan mengunggah dokumen baru dengan mengunjungi halaman pengaturan
                        profil.
                    </div>
                </div>
            </div>

            <!-- Third Accordion Item -->
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button custom-accordion-btn collapsed custom-border" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                        Bagaimana cara melihat dan melamar lowongan pekerjaan yang tersedia?
                        <span class="accordion-icon">
                            <i class="bi bi-plus"></i> <!-- Ikon plus (+) -->
                            <i class="bi bi-dash"></i> <!-- Ikon minus (-) -->
                        </span>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Anda dapat menjelajahi daftar lowongan pekerjaan yang tersedia dengan mengunjungi portal
                        pekerjaan.
                        Pilih lowongan dan lamar dengan mengirimkan resume dan surat lamaran yang diperbarui.
                    </div>
                </div>
            </div>

            <!-- Fourth Accordion Item -->
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button custom-accordion-btn collapsed custom-border" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                        aria-controls="collapseFour">
                        Bagaimana cara pelamar mengetahui status lamaran mereka?
                        <span class="accordion-icon">
                            <i class="bi bi-plus"></i>
                            <i class="bi bi-dash"></i>
                        </span>
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Anda dapat memeriksa status lamaran Anda dengan mengunjungi bagian "Lamaran Saya" di profil
                        Anda, di
                        mana pembaruan akan ditampilkan.
                    </div>
                </div>
            </div>

            <!-- Fifth Accordion Item -->
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button custom-accordion-btn collapsed custom-border" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                        aria-controls="collapseFive">
                        Bagaimana cara pelamar melihat jadwal tes atau wawancara?
                        <span class="accordion-icon">
                            <i class="bi bi-plus"></i> <!-- Ikon plus (+) -->
                            <i class="bi bi-dash"></i> <!-- Ikon minus (-) -->
                        </span>
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pelamar dapat melihat jadwal tes atau wawancara di halaman profil pada bagian "Jadwal Tes dan
                        Konsultasi." Sistem akan menampilkan detail jadwal seperti tanggal, waktu, dan lokasi (atau link
                        jika
                        tes dilakukan secara online). Pelamar juga akan menerima notifikasi saat jadwal ditetapkan atau
                        diubah.
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<!-- Add Font Awesome CDN in your head section -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function() {
        // Owl Carousel untuk Baris 1
        $('#carousel-row1').owlCarousel({
            loop: true,
            margin: 10, // Jarak antar logo
            nav: true, // Menampilkan tombol navigasi
            autoplay: true,
            autoplayTimeout: 1000, // Waktu antara transisi, 1 detik
            autoplaySpeed: 1000, // Kecepatan transisi antar logo
            smartSpeed: 1000, // Transisi lebih halus dan cepat
            fluidSpeed: true, // Transisi lebih halus
            rtl: false, // Arahkan ke kanan
            responsive: {
                0: {
                    items: 2, // Menampilkan 2 logo pada ukuran layar kecil
                    margin: 10
                },
                600: {
                    items: 4, // Menampilkan 4 logo pada ukuran layar sedang
                    margin: 10
                },
                1000: {
                    items: 6, // Menampilkan 6 logo pada ukuran layar besar
                    margin: 20
                }
            }
        });

        // Owl Carousel untuk Baris 2
        $('#carousel-row2').owlCarousel({
            loop: true,
            margin: 10, // Jarak antar logo
            nav: true, // Menampilkan tombol navigasi
            autoplay: true,
            autoplayTimeout: 1000, // Waktu antara transisi, 1 detik
            autoplaySpeed: 1000, // Kecepatan transisi antar logo
            smartSpeed: 1000, // Transisi lebih halus dan cepat
            fluidSpeed: true, // Transisi lebih smooth
            rtl: true, // Bergerak ke kiri
            responsive: {
                0: {
                    items: 2, // Menampilkan 2 logo pada ukuran layar kecil
                    margin: 10
                },
                600: {
                    items: 4, // Menampilkan 4 logo pada ukuran layar sedang
                    margin: 10
                },
                1000: {
                    items: 6, // Menampilkan 6 logo pada ukuran layar besar
                    margin: 20
                }
            }
        });
    });
</script>
