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
                    <a href="{{ route('dasbor_perusahaan') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>Dasbor</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori_lowongan_kerja') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-list"></i>
                        <p>Kategori Lowongan Kerja</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftar_lowongan_kerja_perusahaan') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-magnifying-glass"></i>
                        <p>Daftar Lowongan Kerja</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tes_seleksi_pelamar') }}" class="nav-link">
                        <i class="nav-icon fa-regular fa-clipboard"></i>
                        <p>Tes Seleksi Pelamar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dokumen_lamaran_maxians') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-forward"></i>
                        <p>Dokumen Lamaran Maxians</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftar_pelamar_masuk') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>Daftar Pelamar Masuk</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
