@extends('partials.partials_maxians.app')

@section('content')
    <!-- Section Detail Lowongan Kerja -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card custom-border rounded-5">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3 img-items-top">
                                <img src="{{ asset($lowongan->logo_perusahaan ?? 'images/default-logo.png') }}"
                                    alt="Logo {{ $lowongan->nama_perusahaan }}" width="100" height="100">
                            </div>
                            <div>
                                <h4 class="card-title mb-0">{{ $lowongan->kategoriPekerjaan->nama_kategori }}</h4>
                                <h6 class="location-job mt-1">{{ $lowongan->nama_perusahaan }}</h6>
                                <h6 class="location-job mb-0">{{ $lowongan->alamat }}</h6>
                            </div>
                        </div>

                        <div class="mb-4 position-relative">
                            <div class="bg-primary text-white mb-5"
                                style="margin-left: -24px; margin-right: -24px; padding-left: 24px;">
                                <h4 class="description fw-bold m-0 p-3 ps-0">Deskripsi Pekerjaan</h4>
                            </div>

                            <h5 class="description-job lh-base mb-5 text-justify">
                                {!! nl2br(e($lowongan->deskripsi_pekerjaan)) !!}
                            </h5>
                        </div>

                        <div class="d-flex align-items-center">
                            <h5 class="description-job fw-bold">Lokasi Kerja : </h5>
                            <h5 class="description-job lh-base ms-3">{{ $lowongan->lokasi }}</h5>
                        </div>

                        <div class="d-flex align-items-center mt-3">
                            <h5 class="description-job fw-bold">Gaji : </h5>
                            <h5 class="description-job lh-base ms-3">
                                Rp {{ number_format($lowongan->gaji, 0, ',', '.') }} / bulan
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card custom-border rounded-5">
                            <div class="justify-content-center">
                                <div class="card-body p-5">
                                    <div class="bg-primary text-white mb-5 mt-3 text-center"
                                        style="margin-left: -24px; margin-right: -24px; padding-left: 24px;">
                                        <h4 class="description fw-bold m-0 p-3 ps-0">
                                            Rp {{ number_format($lowongan->gaji, 0, ',', '.') }} / bulan
                                        </h4>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar text-warning mt-1" style="font-size: 1.5rem;"></i>
                                        <h4 class="form-label mb-0 ms-3">
                                            {{ $lowongan->created_at->format('d F Y') }}
                                        </h4>
                                    </div>

                                    <div class="d-flex align-items-center mt-3">
                                        <i class="bi bi-funnel text-warning mt-1" style="font-size: 1.5rem;"></i>
                                        <h4 class="form-label mb-0 ms-3">{{ $lowongan->jenis_kontrak }}</h4>
                                    </div>

                                    <div class="d-flex align-items-center mt-3">
                                        <i class="bi bi-file-earmark-text text-warning mt-1" style="font-size: 1.5rem;"></i>
                                        <h4 class="form-label mb-0 ms-3">{{ $lowongan->lokasi }}</h4>
                                    </div>

                                    <div class="d-flex align-items-center mt-3">
                                        <i class="bi bi-bar-chart-line text-warning mt-1" style="font-size: 1.5rem;"></i>
                                        <h4 class="form-label mb-0 ms-3">
                                            {{ $lowongan->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </h4>
                                    </div>

                                    <!-- Tombol Lamaran -->
                                    @auth
                                        <form method="POST" action="{{ route('melamar', $lowongan->id_lowongan) }}"
                                            id="applicationForm">
                                            @csrf
                                            <button type="submit" id="applyButton" class="btn btn-primary rounded-5 mt-4">
                                                Melamar Pekerjaan <i class="fa-solid fa-arrow-right ms-3"></i>
                                            </button>
                                        </form>
                                    @else
                                        <p>Silakan <a href="{{ route('login') }}">login</a> untuk melamar pekerjaan.</p>
                                    @endauth

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="card custom-border rounded-5">
                            <div class="card-body p-5 px-5">
                                <div class="d-flex align-items-center mt-3">
                                    <i class="bi bi-envelope text-warning mt-1" style="font-size: 1.5rem;"></i>
                                    <h5 class="description-job mb-0 ms-3" style="word-wrap: break-word; max-width: 100%;">
                                        {{ $lowongan->email }}
                                    </h5>
                                </div>

                                <div class="d-flex align-items-center mt-3 mb-3">
                                    <i class="bi bi-telephone text-warning" style="font-size: 1.5rem;"></i>
                                    <h5 class="description-job mb-0 ms-3" style="word-wrap: break-word; max-width: 100%;">
                                        {{ $lowongan->nomor_telepon }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- SweetAlert Script -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Lamaran Terkirim!',
                    text: 'Silahkan pantau status lamaran kerja Anda.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then(function() {
                    window.location.href = "{{ route('status_lamaran_kerja') }}";
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Anda sudah melamar di tempat ini',
                    text: 'Silakan pantau status lamaran Anda.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                }).then(function() {
                    // Setelah pengguna mengklik OK, arahkan ke route status lamaran kerja
                    window.location.href = "{{ route('status_lamaran_kerja') }}";
                });
            });
        </script>
    @endif
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        document.getElementById('applicationForm')?.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form secara otomatis agar bisa kita kontrol

            // Nonaktifkan tombol dan ubah teks
            const applyButton = document.getElementById('applyButton');
            applyButton.disabled = true;
            applyButton.textContent = 'Anda sudah melamar';

            // Kirim form secara manual setelah tombol dinonaktifkan dan teks diubah
            this.submit(); // Ini yang akan mengirim form

            // Tampilkan SweetAlert setelah form dikirim
            Swal.fire({
                title: 'Lamaran Terkirim!',
                text: 'Silahkan pantau status lamaran kerja Anda.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then(function() {
                // Arahkan ke halaman status lamaran setelah pengguna menekan OK
                window.location.href = "{{ route('status_lamaran_kerja') }}";
            });
        });
    </script>
@endsection
