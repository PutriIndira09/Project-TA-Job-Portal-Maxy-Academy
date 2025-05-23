<!--Mengganti warna background-->
<aside class="app-sidebar bg-custom-sidebar shadow" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="{{ asset('images/logo-maxy.png') }}" alt="Maxy Academy Logo" class="brand-image">
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dasbor_admin') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>Dasbor</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tag_lowongan_kerja') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-hashtag"></i>
                        <p>Tag Lowongan Kerja</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('aktivasi_akun') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>Aktivasi Akun</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftar_lowongan_kerja_admin') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-magnifying-glass"></i>
                        <p>Lowongan Kerja</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-calendar-days"></i>
                        <p>Konsultasi Karir
                            <i class="nav-arrow bi bi-chevron-right ms-auto"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('daftar_jadwal_konsultasi_karir_mentor') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Jadwal Konsultasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('daftar_penjadwalan_ulang_konsultasi_karir') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Penjadwalan Ulang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-contract"></i>
                        <p>Laporan Hasil
                            <i class="nav-arrow bi bi-chevron-right ms-auto"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan_hasil_konsultasi_karir_mentor') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Laporan Mentor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan_hasil_konsultasi_karir_maxians') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Laporan Maxians</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftar_pelamar_masuk_perusahaan') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>Data Pelamar</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
