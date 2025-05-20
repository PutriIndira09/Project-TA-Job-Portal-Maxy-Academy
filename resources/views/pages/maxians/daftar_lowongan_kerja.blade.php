@extends('partials.partials_maxians.app')

@section('content')
    <!-- Section Header -->
    <div class="container-fluid">
        <div class="col-md-12">
            <img src="{{ asset('images/lowongan-kerja.png') }}" alt="Gambar Promosi" class="img-fluid" />
        </div>
    </div>

    <!-- Section Search Bar -->
    <div class="container-fluid">
        <form method="GET" action="{{ route('daftar_lowongan_kerja') }}">
            <div class="mt-5 d-flex justify-content-start">
                <div class="col-md-5">
                    <h5 class="input-group">
                        <select name="id_kategori" class="form-select rounded-5 custom-border"
                            aria-label="Cari Kategori Pekerjaan" onchange="this.form.submit()">
                            <option value="" disabled selected>Pilih Kategori Pekerjaan...</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}"
                                    {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </h5>
                </div>

                <div class="col-md-5 ms-3">
                    <h5 class="input-group">
                        <input type="text" name="alamat" class="form-control rounded-5 custom-border"
                            placeholder="Cari Lokasi Pekerjaan" value="{{ request('alamat') }}">
                        <button type="submit" class="btn btn-primary rounded-5 ms-3">Cari</button>
                    </h5>
                </div>
            </div>
        </form>
    </div>

    <!-- Section Filter dan Daftar Lowongan Kerja -->
    <div class="container-fluid mt-5">
        <form method="GET" action="{{ route('daftar_lowongan_kerja') }}">
            <div class="row">
                <!-- Filter Section -->
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="card rounded-5 custom-border" style="height:auto;">
                        <div class="card-body">
                            <h4 class="card-title mt-3 ms-3">Filter</h4>

                            <div class="mt-3 ms-3">
                                <button type="submit" name="sort" value="relevan"
                                    class="btn {{ $activeFilters['sort'] === 'relevan' ? 'btn-primary' : 'btn-filter-outline' }} rounded-5 btn-sm me-3 px-3">
                                    Relevan
                                </button>
                                <button type="submit" name="sort" value="baru"
                                    class="btn {{ $activeFilters['sort'] === 'baru' ? 'btn-primary' : 'btn-filter-outline' }} rounded-5 btn-sm me-3 px-3">
                                    Baru
                                </button>
                            </div>

                            <hr class="hr-custom"
                                style="margin-left: 6px; margin-right: 6px; margin-top: 25px; margin-bottom: 20px;">

                            <!-- Filter Jenis Kontrak -->
                            <div class="container-fluid">
                                <div class="filter-container">
                                    <div class="row">
                                        <div class="filter-section mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3 filter-header"
                                                data-target="kontrak-options">
                                                <h5 class="filter mb-0" style="margin-left: -15px">Jenis Kontrak :</h5>
                                                <i class="fas fa-chevron-up text-secondary toggle-icon"></i>
                                            </div>

                                            <div class="filter-options" id="kontrak-options">
                                                @php
                                                    $jenisKontrakOptions = [
                                                        'Full Time' => 'fullTime',
                                                        'Part Time' => 'partTime',
                                                        'Freelance' => 'freelance',
                                                        'Internship' => 'internship',
                                                        'Contract Based' => 'contractBased',
                                                    ];
                                                @endphp

                                                @foreach ($jenisKontrakOptions as $label => $value)
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="jenis_kontrak[]" id="{{ $value }}"
                                                            value="{{ $label }}"
                                                            {{ in_array($label, $activeFilters['jenis_kontrak']) ? 'checked' : '' }}>
                                                        <label class="form-check-label text-secondary"
                                                            for="{{ $value }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="hr-custom"
                                        style="margin-left: -10px; margin-right: -5px; margin-bottom: 20px;">

                                    <!-- Filter Lokasi -->
                                    <div class="filter-section mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-3 filter-header"
                                            data-target="lokasi-options">
                                            <h5 class="filter mb-0" style="margin-left: -15px">Lokasi Penempatan:</h5>
                                            <i class="fas fa-chevron-up text-secondary toggle-icon"></i>
                                        </div>

                                        <div class="filter-options" id="lokasi-options">
                                            @php
                                                $lokasiOptions = [
                                                    'WFO' => 'wfo',
                                                    'WFH' => 'wfh',
                                                    'Hybrid' => 'hybrid',
                                                ];
                                            @endphp

                                            @foreach ($lokasiOptions as $label => $value)
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" name="lokasi[]"
                                                        id="{{ $value }}" value="{{ $label }}"
                                                        {{ in_array($label, $activeFilters['lokasi']) ? 'checked' : '' }}>
                                                    <label class="form-check-label text-secondary"
                                                        for="{{ $value }}">
                                                        {{ $label }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="submit" class="btn btn-primary rounded-5 btn-sm px-4">
                                            Terapkan Filter
                                        </button>
                                        <a href="{{ route('daftar_lowongan_kerja') }}"
                                            class="btn btn-outline-secondary rounded-5 btn-sm px-4">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @forelse ($lowongans as $lowongan)
                            <div class="col d-flex">
                                <a href="{{ route('detail_lowongan_kerja', ['id' => $lowongan->id_lowongan]) }}"
                                    class="card-link w-100">
                                    <div class="card rounded-5 custom-border h-100 d-flex flex-column">
                                        <div class="card-body p-5 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3 img-items-top">
                                                        <img src="{{ asset($lowongan->logo_perusahaan ?? 'path/to/default/logo.png') }}"
                                                            alt="Logo {{ $lowongan->nama_perusahaan }}" width="60"
                                                            height="60" class="img-fluid rounded-circle">
                                                    </div>
                                                    <div>
                                                        <h4 class="card-title mb-0">
                                                            {{ $lowongan->kategoriPekerjaan->nama_kategori }}</h4>
                                                        <h6 class="location-job mt-1">{{ $lowongan->nama_perusahaan }}
                                                        </h6>
                                                        <h6 class="location-job mb-0">{{ $lowongan->alamat }}</h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <span
                                                    class="btn btn-date-job rounded-5 btn-sm me-3 px-3">{{ $lowongan->created_at->format('d F Y') }}</span>
                                            </div>

                                            <div class="mb-2">
                                                <span
                                                    class="btn btn-contract-job rounded-5 btn-sm">{{ $lowongan->jenis_kontrak }}</span>
                                                <span
                                                    class="btn btn-active-job rounded-5 btn-sm me-2 px-3">{{ $lowongan->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                                            </div>

                                            <div class="mb-3 d-flex">
                                                <span
                                                    class="btn btn-location-job rounded-5 btn-sm me-2 px-3">{{ $lowongan->lokasi }}</span>
                                            </div>

                                            <div class="pt-3 mt-auto">
                                                <hr class="hr-custom">
                                                <p class="filter mb-0">
                                                    {{ 'Rp ' . number_format($lowongan->gaji, 0, ',', '.') . ' / bulan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Tidak ada lowongan kerja yang tersedia dengan filter yang dipilih.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk dropdown kategori
            $('select[name="kategori"]').select2({
                placeholder: "Pilih Kategori Pekerjaan...",
                allowClear: true,
                width: '100%'
            });

            // Submit form ketika kategori dipilih
            $('select[name="kategori"]').on('change', function() {
                $(this).closest('form').submit();
            });
        });
        // Script untuk toggle filter options
        document.querySelectorAll('.filter-header').forEach(header => {
            header.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const target = document.getElementById(targetId);
                const icon = this.querySelector('.toggle-icon');

                if (target.style.display === 'none') {
                    target.style.display = 'block';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    target.style.display = 'none';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });
        });

        // Set all filter options to be visible by default
        document.querySelectorAll('.filter-options').forEach(options => {
            options.style.display = 'block';
        });
    </script>
@endsection
