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
                    <a href="{{ route('dasbor_mentor') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>Dasbor</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('atur_jadwal_konsultasi') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-calendar-days"></i>
                        <p>Atur Jadwal Konsultasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cek_ketersediaan_jadwal') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-list"></i>
                        <p>Cek Ketersediaan Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penjadwalan_ulang_konsultasi') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-calendar-days"></i>
                        <p>Penjadwalan Ulang Konsultasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelola_permintaan_jadwal') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-code-pull-request"></i>
                        <p>Kelola Permintaan Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan_hasil_konsultasi_mentor') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-contract"></i>
                        <p>Laporan Hasil Konsultasi</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->


