@extends('partials.partials_perusahaan.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Edit Lowongan Kerja</h2>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('update_daftar_lowongan_kerja_perusahaan', $lowongan->id_lowongan) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Logo Perusahaan Input -->
                    <div class="mb-3">
                        <label for="logo_perusahaan" class="heading text-center fw-bold mb-3">Logo Perusahaan</label>
                        <div class="d-flex align-items-center">
                            <div class="image-preview-container me-3">
                                @if ($lowongan->logo_perusahaan)
                                    <img id="imagePreview" src="{{ asset($lowongan->logo_perusahaan) }}"
                                        class="rounded-circle" width="80" height="80" alt="Logo Perusahaan">
                                @else
                                    <img id="imagePreview" src="{{ asset('images/logo-placeholder.jpg') }}"
                                        class="rounded-circle" width="80" height="80" alt="Default Logo">
                                @endif
                            </div>
                            <input type="file" class="form-control custom-border" name="logo_perusahaan"
                                id="logo_perusahaan" accept="image/jpeg,image/png">
                        </div>
                        <small class="text-muted">Format: JPG, PNG (max 2MB)</small>
                    </div>

                    <!-- Kategori Pekerjaan Input -->
                    <div class="mb-3">
                        <label for="nama_kategori" class="heading text-center fw-bold mb-3">Kategori Pekerjaan</label>
                        <select class="form-select custom-border" name="nama_kategori" required>
                            <option selected disabled value="">Pilih Kategori Pekerjaan...</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->nama_kategori }}"
                                    {{ old('nama_kategori', $lowongan->nama_kategori) == $kategori->nama_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Perusahaan Input -->
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="heading text-center fw-bold mb-3">Nama Perusahaan</label>
                        <input type="text" class="form-control custom-border" name="nama_perusahaan"
                            value="{{ old('nama_perusahaan', $lowongan->nama_perusahaan) }}" required>
                    </div>

                    <!-- Alamat Perusahaan Input -->
                    <div class="mb-3">
                        <label for="alamat" class="heading text-center fw-bold mb-3">Alamat Perusahaan</label>
                        <input type="text" class="form-control custom-border" name="alamat"
                            value="{{ old('alamat', $lowongan->alamat) }}" required>
                    </div>

                    <!-- Email Perusahaan Input -->
                    <div class="mb-3">
                        <label for="email" class="heading text-center fw-bold mb-3">Email Perusahaan</label>
                        <input type="email" class="form-control custom-border" name="email"
                            value="{{ old('email', $lowongan->email) }}" required>
                    </div>

                    <!-- Nomor Telepon Perusahaan Input -->
                    <div class="mb-3">
                        <label for="nomor_telepon" class="heading text-center fw-bold mb-3">Nomor Telepon Perusahaan</label>
                        <input type="tel" class="form-control custom-border" name="nomor_telepon"
                            value="{{ old('nomor_telepon', $lowongan->nomor_telepon) }}" required>
                    </div>

                    <!-- Deskripsi Pekerjaan Input -->
                    <div class="mb-3">
                        <label for="deskripsi_pekerjaan" class="heading text-center fw-bold mb-3">Deskripsi
                            Pekerjaan</label>
                        <textarea class="form-control custom-border" name="deskripsi_pekerjaan" rows="4" required>{{ old('deskripsi_pekerjaan', $lowongan->deskripsi_pekerjaan) }}</textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Jenis Kontrak Input -->
                    <div class="mb-3">
                        <label for="jenis_kontrak" class="heading text-center fw-bold mb-3">Jenis Kontrak</label>
                        <select class="form-select custom-border" name="jenis_kontrak" required>
                            <option value="Full Time"
                                {{ old('jenis_kontrak', $lowongan->jenis_kontrak) == 'Full Time' ? 'selected' : '' }}>Full
                                Time</option>
                            <option value="Part Time"
                                {{ old('jenis_kontrak', $lowongan->jenis_kontrak) == 'Part Time' ? 'selected' : '' }}>
                                Part Time</option>
                            <option value="Freelance"
                                {{ old('jenis_kontrak', $lowongan->jenis_kontrak) == 'Freelance' ? 'selected' : '' }}>
                                Freelance</option>
                            <option value="Internship"
                                {{ old('jenis_kontrak', $lowongan->jenis_kontrak) == 'Internship' ? 'selected' : '' }}>
                                Internship
                            </option>
                            <option value="Contract Based"
                                {{ old('jenis_kontrak', $lowongan->jenis_kontrak) == 'Contract Based' ? 'selected' : '' }}>
                                Contract Based
                            </option>
                        </select>
                    </div>

                    <!-- Lokasi Input -->
                    <div class="mb-3">
                        <label for="lokasi" class="heading text-center fw-bold mb-3">Lokasi</label>
                        <select class="form-select custom-border" name="lokasi" required>
                            <option value="WFO" {{ old('lokasi', $lowongan->lokasi) == 'WFO' ? 'selected' : '' }}>WFO
                            </option>
                            <option value="WFH" {{ old('lokasi', $lowongan->lokasi) == 'WFH' ? 'selected' : '' }}>WFH
                            </option>
                            <option value="Hybrid" {{ old('lokasi', $lowongan->lokasi) == 'Hybrid' ? 'selected' : '' }}>
                                Hybrid</option>
                        </select>
                    </div>

                    <!-- Gaji Input -->
                    <div class="mb-3">
                        <label for="gaji" class="heading text-center fw-bold mb-3">Gaji</label>
                        <input type="number" class="form-control custom-border" name="gaji"
                            value="{{ old('gaji', $lowongan->gaji) }}" step="0.01" required>
                    </div>

                    <!-- Status Input -->
                    <div class="mb-3">
                        <label class="heading text-center fw-bold mb-3">Status</label>

                        <!-- Hidden input untuk nilai default 0 (nonaktif) -->
                        <input type="hidden" name="is_active" value="0">

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                value="1" {{ old('is_active', $lowongan->is_active) == 1 ? 'checked' : '' }}>

                            <label class="form-check-label" for="is_active">
                                {{ $lowongan->is_active ? 'Aktifkan Lowongan' : 'Nonaktifkan Lowongan' }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" onclick="window.location.href='{{ route('daftar_lowongan_kerja_perusahaan') }}'"
                    class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Perbarui</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Toggle between file input and text input based on selected option
            document.querySelectorAll('input[name="deskripsi_option"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'file') {
                        document.getElementById('fileOption').classList.remove('d-none');
                        document.getElementById('textOption').classList.add('d-none');
                        document.querySelector('textarea[name="deskripsi_pekerjaan"]').value = '';
                    } else {
                        document.getElementById('fileOption').classList.add('d-none');
                        document.getElementById('textOption').classList.remove('d-none');
                        document.querySelector('input[name="deskripsi_pekerjaan"]').value = '';
                    }
                });
            });

            // Menunggu kategori pekerjaan dipilih dan memuat deskripsi pekerjaan
            document.getElementById('nama_kategori').addEventListener('change', function() {
                var kategori = this.value;
                var deskripsiPekerjaanField = document.getElementById('deskripsi_pekerjaan');

                // Menggunakan data kategori pekerjaan dan deskripsi yang ada di dalam form
                var deskripsi = '';

                @foreach ($kategoris as $kategori)
                    if (kategori === "{{ $kategori->nama_kategori }}") {
                        deskripsi =
                            "{{ $kategori->deskripsi_pekerjaan }}"; // Ambil deskripsi pekerjaan berdasarkan kategori yang dipilih
                    }
                @endforeach

                deskripsiPekerjaanField.value = deskripsi; // Menampilkan deskripsi di textarea
            });

            // Image Preview and Validation Functionality
            document.getElementById('logo_perusahaan').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('imagePreview');
                const fileInput = document.getElementById('logo_perusahaan');
                const reader = new FileReader();

                // Validation parameters
                const validTypes = ['image/jpeg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (file) {
                    // Check file type
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format tidak valid',
                            text: 'Hanya file JPG/PNG yang diperbolehkan',
                        });
                        fileInput.value = '';
                        preview.src =
                            "{{ asset($lowongan->logo_perusahaan ? $lowongan->logo_perusahaan : 'images/logo-placeholder.jpg') }}";
                        return;
                    }

                    // Check file size
                    if (file.size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran file terlalu besar',
                            text: 'Ukuran file maksimal 2MB',
                        });
                        fileInput.value = '';
                        preview.src =
                            "{{ asset($lowongan->logo_perusahaan ? $lowongan->logo_perusahaan : 'images/logo-placeholder.jpg') }}";
                        return;
                    }

                    // If validation passes, show preview
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Password Toggle Functionality
            document.querySelector('.toggle-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    this.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });

            // Toggle Switch Functionality
            const toggleSwitch = document.getElementById('is_active');

            // Update label text when toggled
            toggleSwitch.addEventListener('change', function() {
                const label = document.querySelector('label[for="is_active"]');
                label.textContent = this.checked ? 'Aktif' : 'Nonaktif';
            });
        </script>
    @endpush
@endsection
