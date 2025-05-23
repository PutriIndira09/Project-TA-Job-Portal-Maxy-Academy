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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tambahkan di head -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('daftar_mentor') }}">Konsultasi Karir</a></li>
                            <li><a href="{{ route('daftar_lowongan_kerja') }}">Lowongan Kerja</a></li>
                            <li><a href="{{ route('status_lamaran_kerja') }}">Status Lamaran Kerja</a></li>
                            <li><a href="{{ route('dokumen_lamaran_kerja') }}">Dokumen Lamaran</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 3: Lainnya -->
                <div class="col-lg-3 col-md-6 mb-4 footer-column">
                    <div class="footer-section">
                        <h5>Lainnya</h5>
                        <ul class="list-unstyled">
                            <li><a href="#alur-melamar">Alur Melamar Kerja</a></li>
                            <li><a href="#alur-konsultasi-karir">Alur Konsultasi Karir</a></li>
                            <li><a href="#benefit-konsultasi-karir">Benefit Konsultasi Karir</a></li>
                            <li><a href="#mitra">Mitra Kami</a></li>
                            <li>
                                <a
                                    href="https://api.whatsapp.com/send/?phone=628113955599&text=Hi%20Maxy%20Academy%21%20Mau%20nanya-nanya%20dong..%0D%0A%0D%0ANama%3A%0D%0AEmail%3A%0D%0AUniversitas%3A%0D%0ASemester%3A%0D%0AJurusan%3A%0D%0A%0D%0AThank%20you%21&type=phone_number&app_absent=0">
                                    Hubungi Kami
                                </a>
                            </li>
                            <li><a href="#FAQ">FAQs</a></li>
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
                    <p class="mb-0">Copyrighted @ 2025 by Putri Indira</p>
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


    <!-- WhatsApp Floating Button -->
    <div class="whatsapp-float">
        <a href="https://api.whatsapp.com/send/?phone=628113955599&text=Hi+Maxy+Academy%21+Mau+nanya-nanya+dong..%0D%0A%0D%0ANama%3A%0D%0AEmail%3A%0D%0AUniversitas%3A%0D%0ASemester%3A%0D%0AJurusan%3A%0D%0A%0D%0AThank+you%21&type=phone_number&app_absent=0"
            class="whatsapp-btn" target="_blank">
            <i class="fab fa-whatsapp"></i>
            <span class="whatsapp-tooltip">Chat dengan kami!</span>
        </a>
    </div>

    <!-- CSS untuk WhatsApp Floating Button -->
    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        .whatsapp-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #25D366;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
        }

        .whatsapp-btn i {
            font-size: 32px;
            color: white;
        }

        .whatsapp-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.4);
        }

        .whatsapp-tooltip {
            position: absolute;
            right: 70px;
            background-color: #333;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .whatsapp-tooltip::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -5px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-left: 5px solid #333;
            border-bottom: 5px solid transparent;
        }

        .whatsapp-btn:hover .whatsapp-tooltip {
            opacity: 1;
            visibility: visible;
            right: 75px;
        }

        /* Animasi pulsing untuk menarik perhatian */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* Terapkan animasi */
        .whatsapp-btn {
            animation: pulse 2s infinite;
        }

        /* Responsif untuk perangkat mobile */
        @media (max-width: 767px) {
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-btn {
                width: 50px;
                height: 50px;
            }

            .whatsapp-btn i {
                font-size: 26px;
            }
        }
    </style>

    <!-- Script untuk efek tambahan (opsional) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menampilkan tombol setelah 2 detik
            setTimeout(function() {
                document.querySelector('.whatsapp-float').style.display = 'block';
            }, 2000);

            // Log ketika tombol diklik (opsional)
            document.querySelector('.whatsapp-btn').addEventListener('click', function() {
                console.log('WhatsApp button clicked');
            });
        });
    </script>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
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
