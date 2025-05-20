<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxy Academy</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/maxians.css') }}">
    <link href="{{ asset('css/maxians.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <header class="container-fluid mt-2 mb-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Maxy Academy" class="img-fluid"
                        style="max-width: 150px;">
                </a>

                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" id="navbar-toggler" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu Navigasi -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link 
                                {{ request()->routeIs('daftar_mentor') || request()->routeIs('daftar_jadwal_konsultasi_karir') || request()->routeIs('pengajuan_jadwal_konsultasi_karir') || request()->routeIs('laporan_hasil_konsultasi_karir') || request()->routeIs('konsultasi_karir') ? 'active' : '' }}"
                                href="{{ route('daftar_mentor') }}">Konsultasi Karir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link
                                {{ request()->routeIs('daftar_lowongan_kerja') || request()->routeIs('detail_lowongan_kerja') ? 'active' : '' }}"
                                href="{{ route('daftar_lowongan_kerja') }}">Lowongan Kerja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link
                                {{ request()->routeIs('status_lamaran_kerja') ? 'active' : '' }}"
                                href="{{ route('status_lamaran_kerja') }}">Status Lamaran Kerja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link
                                {{ request()->routeIs('dokumen_lamaran_kerja') ? 'active' : '' }}"
                                href="{{ route('dokumen_lamaran_kerja') }}">Dokumen Lamaran</a>
                        </li>
                    </ul>

                    <!-- Profile -->
                    <div class="ms-lg-3" style="position: relative;">
                        <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="rounded-circle"
                            style="height: 45px; cursor: pointer;" id="profileImage">

                        <div class="dropdown-card" id="profileDropdown">
                            <div class="card-body p-0">
                                {{-- <a href="{{ route('profil_maxians') }}" class="dropdown-item profile-item">
                                    <i class="fas fa-user me-3" style="font-size: 24px;"></i>
                                    <span class="profile-text">Profil</span>
                                </a> --}}
                                {{-- <hr class="my-1"> --}}
                                <a href="{{ route('logout') }}" class="dropdown-item logout-item">
                                    <i class="fas fa-sign-out-alt me-3" style="font-size: 24px;"></i>
                                    <span class="logout-text">Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Garis setelah header -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-line mb-3"></div>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="container-fluid">
        <div class="container">
            <div class="row footer-columns">
                <!-- Column 1: Logo & Address -->
                <div class="col-lg-3 col-md-6 mb-2 footer-column">
                    <div class="footer-section">
                        <img src="{{ asset('images/logo.png') }}" alt="Maxy Academy" class="img-fluid mb-3"
                            style="max-width: 150px;">
                        <!-- Jakarta -->
                        <div class="mt-4 footer-address">
                            <p><strong>Jakarta HQ</strong><br>
                                Pakuwon Tower 26-J<br>
                                Jl. Casablanca Raya No.88<br>
                                Jakarta Selatan, DKI Jakarta 12960</p>
                        </div>
                        <!-- Surabaya -->
                        <div class="mt-4 footer-address">
                            <p><strong>Surabaya</strong><br>
                                Ciputra World Office 15(15-16)<br>
                                Jl. Mayjen Sungkono Kav.89<br>
                                Surabaya, Jawa Timur 60224</p>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Menu -->
                <div class="col-lg-3 col-md-6 mb-4 footer-column">
                    <div class="footer-section">
                        <h5>Menu</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/konsultasi-karir') }}">Konsultasi Karir</a></li>
                            <li><a href="{{ url('/lowongan-kerja') }}">Lowongan Kerja</a></li>
                            <li><a href="{{ url('/status-lamaran') }}">Status Lamaran Kerja</a></li>
                            <li><a href="{{ url('/dokumen-lamaran') }}">Dokumen Lamaran</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 3: Lainnya -->
                <div class="col-lg-3 col-md-6 mb-4 footer-column">
                    <div class="footer-section">
                        <h5>Lainnya</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Alur Melamar Kerja</a></li>
                            <li><a href="#">Alur Konsultasi Karir</a></li>
                            <li><a href="#">Benefit Konsultasi Karir</a></li>
                            <li><a href="#">Mitra</a></li>
                            <li><a href="#">Hubungi Kami</a></li>
                            <li><a href="#">FAQs</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 4: Sosial Media -->
                <div class="col-lg-2 col-md-6 mb-4 footer-column">
                    <div class="footer-section">
                        <h5>Sosial Media</h5>
                        <div class="d-flex gap-3 mb-3">
                            <a href="https://www.facebook.com/maxy.academy" target="_blank">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://www.linkedin.com/company/maxyacademy/" target="_blank">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://www.tiktok.com/@maxy.academy?_t=8XjFgVmDMOY&_r=1" target="_blank">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        </div>
                        <div class="d-flex gap-3">
                            <a href="https://www.instagram.com/maxy.academy" target="_blank">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="mailto:people@maxy.academy" target="_blank">
                                <i class="bi bi-envelope"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send/?phone=628113955599&text=Hi+Maxy+Academy%21+Mau+nanya-nanya+dong..%0D%0A%0D%0ANama%3A%0D%0AEmail%3A%0D%0AUniversitas%3A%0D%0ASemester%3A%0D%0AJurusan%3A%0D%0A%0D%0AThank+you%21&type=phone_number&app_absent=0"
                                target="_blank">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row mt-0 mb-0">
                <div class="col-12">
                    <div class="header-line mt-3"></div>
                </div>
                <div class="col-12 text-center mb-3">
                    <p class="mb-0">Copyrighted @ 2023 by Maxy Academy</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript untuk toggle navbar
        document.getElementById('navbar-toggler').addEventListener('click', function() {
            var navbar = document.getElementById('navbarNav');
            var expanded = this.getAttribute('aria-expanded') === 'true';

            // Toggle the expanded state
            this.setAttribute('aria-expanded', !expanded);

            // Toggle the collapse class
            navbar.classList.toggle('collapse');
        });
    </script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Menambahkan Bootstrap 5.3 JS dan FontAwesome untuk ikon -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    @stack('scripts')


</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navToggle = document.querySelector('.nav-toggle');
        const navList = document.querySelector('.nav-list');

        navToggle.addEventListener('click', function() {
            navList.classList.toggle('active');
        });
    });

    // Add this JavaScript to handle the toggle behavior
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle dropdown when profile image is clicked
        document.getElementById('profileImage').addEventListener('click', function(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('profileDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            }
        });

        // Prevent dropdown from closing when clicking inside it
        document.getElementById('profileDropdown').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
</script>

</html>
