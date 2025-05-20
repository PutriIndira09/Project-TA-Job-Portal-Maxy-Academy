@extends('partials.partials_perusahaan.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Tambah Lowongan Kerja</h2>

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

        <!-- Create Form -->
        <form action="{{ route('store_daftar_lowongan_kerja_perusahaan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Logo Perusahaan Input -->
                    <div class="mb-3">
                        <label for="logo_perusahaan" class="heading text-center fw-bold mb-3">Logo Perusahaan</label>
                        <div class="image-preview-container mb-2">
                            <img id="imagePreview" src="{{ asset('images/logo-placeholder.jpg') }}" class="rounded-circle"
                                width="120" height="120" alt="Preview Logo Perusahaan">
                        </div>
                        <input type="file" class="form-control custom-border" id="logo_perusahaan" name="logo_perusahaan"
                            accept=".jpg,.jpeg,.png" required>
                        <small class="form-text text-muted">Format file: JPG/PNG (maks. 2MB)</small>
                        <div id="fileError" class="invalid-feedback d-none">Ukuran file melebihi 2MB</div>
                    </div>

                    <!-- Kategori Pekerjaan Input -->
                    <div class="mb-3">
                        <label for="nama_kategori" class="heading text-center fw-bold mb-3">Kategori Pekerjaan</label>
                        <select class="form-select custom-border" id="nama_kategori" name="nama_kategori" required>
                            <option selected disabled value="">Pilih Kategori Pekerjaan...</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->nama_kategori }}"
                                    {{ old('nama_kategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Perusahaan Input -->
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="heading text-center fw-bold mb-3">Nama Perusahaan</label>
                        <input type="text" class="form-control custom-border" id="nama_perusahaan" name="nama_perusahaan"
                            placeholder="Masukkan nama perusahaan" value="{{ old('nama_perusahaan') }}" required>
                    </div>

                    <!-- Alamat Perusahaan Input -->
                    <div class="mb-3">
                        <label for="alamat" class="heading text-center fw-bold mb-3">Alamat Perusahaan</label>
                        <input type="text" class="form-control custom-border" id="alamat" name="alamat"
                            placeholder="Masukkan alamat perusahaan" value="{{ old('alamat') }}" required>
                    </div>

                    <!-- Email Perusahaan Input -->
                    <div class="mb-3">
                        <label for="email" class="heading text-center fw-bold mb-3">Email Perusahaan</label>
                        <input type="email" class="form-control custom-border" id="email" name="email"
                            placeholder="Masukkan email perusahaan" value="{{ old('email') }}" required>
                    </div>

                    <!-- Nomor Telepon Perusahaan Input -->
                    <div class="mb-3">
                        <label for="nomor_telepon" class="heading text-center fw-bold mb-3">Nomor Telepon Perusahaan</label>
                        <input type="tel" class="form-control custom-border" id="nomor_telepon" name="nomor_telepon"
                            placeholder="Masukkan nomor telepon perusahaan" value="{{ old('nomor_telepon') }}" required>
                    </div>

                    <!-- Deskripsi Pekerjaan Input -->
                    <div class="mb-3">
                        <label for="deskripsi_pekerjaan" class="heading text-center fw-bold mb-3">Deskripsi
                            Pekerjaan</label>
                        <textarea class="form-control custom-border" name="deskripsi_pekerjaan" rows="4" required>{{ old('deskripsi_pekerjaan') }}</textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Jenis Kontrak Input -->
                    <div class="mb-3">
                        <label for="jenis_kontrak" class="heading text-center fw-bold mb-3">Jenis Kontrak</label>
                        <select class="form-select custom-border" id="jenis_kontrak" name="jenis_kontrak" required>
                            <option selected disabled value="">Pilih Jenis Kontrak...</option>
                            <option value="Full Time" {{ old('jenis_kontrak') == 'Full Time' ? 'selected' : '' }}>Full
                                Time
                            </option>
                            <option value="Part Time" {{ old('jenis_kontrak') == 'Part Time' ? 'selected' : '' }}>Part
                                Time
                            </option>
                            <option value="Freelance" {{ old('jenis_kontrak') == 'Freelance' ? 'selected' : '' }}>
                                Freelance
                            </option>
                            <option value="Internship" {{ old('jenis_kontrak') == 'Internship' ? 'selected' : '' }}>
                                Internship</option>
                            <option value="Contract Based"
                                {{ old('jenis_kontrak') == 'Contract Based' ? 'selected' : '' }}>
                                Contract Based</option>
                        </select>
                    </div>

                    <!-- Lokasi Input -->
                    <div class="mb-3">
                        <label for="lokasi" class="heading text-center fw-bold mb-3">Lokasi</label>
                        <select class="form-select custom-border" id="lokasi" name="lokasi" required>
                            <option selected disabled value="">Pilih Lokasi...</option>
                            <option value="WFO" {{ old('lokasi') == 'WFO' ? 'selected' : '' }}>WFO</option>
                            <option value="WFH" {{ old('lokasi') == 'WFH' ? 'selected' : '' }}>WFH</option>
                            <option value="Hybrid" {{ old('lokasi') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <!-- Gaji Input -->
                    <div class="mb-3">
                        <label for="gaji" class="heading text-center fw-bold mb-3">Gaji</label>
                        <input type="number" class="form-control custom-border" id="gaji" name="gaji"
                            placeholder="Masukkan gaji" value="{{ old('gaji') }}" step="0.01" required>
                    </div>

                    <!-- Status Input -->
                    <div class="mb-3">
                        <label class="heading text-center fw-bold mb-3">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                {{ old('is_active') == '1' ? 'Nonaktifkan Lowongan' : 'Aktifkan Lowongan' }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" onclick="window.location.href='{{ route('daftar_lowongan_kerja_perusahaan') }}'"
                    class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Toggle between file input and text input based on selected option
            // Toggle between file input and text input based on selected option
            document.querySelectorAll('input[name="deskripsi_option"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    // Jika memilih opsi "Upload File"
                    if (this.value === 'file') {
                        document.getElementById('fileOption').classList.remove(
                            'd-none'); // Tampilkan input file
                        document.getElementById('textOption').classList.add('d-none'); // Sembunyikan input teks
                        // Kosongkan input teks jika memilih file
                        document.querySelector('textarea[name="deskripsi_pekerjaan"]').value = '';
                    } else {
                        document.getElementById('fileOption').classList.add('d-none'); // Sembunyikan input file
                        document.getElementById('textOption').classList.remove(
                            'd-none'); // Tampilkan input teks
                        // Kosongkan input file jika memilih teks
                        document.querySelector('input[name="deskripsi_pekerjaan"]').value = '';
                    }
                });
            });

            // Image Preview and Validation Functionality
            document.getElementById('logo_perusahaan').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('imagePreview');
                const fileInput = document.getElementById('logo_perusahaan');
                const fileError = document.getElementById('fileError');
                const submitBtn = document.querySelector('button[type="submit"]');
                const reader = new FileReader();

                // Validation parameters
                const validTypes = ['image/jpeg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                // Reset previous states
                fileInput.classList.remove('is-invalid');
                fileError.classList.add('d-none');
                submitBtn.disabled = false;

                if (file) {
                    // Check file type
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format tidak valid',
                            text: 'Hanya file JPG/PNG yang diperbolehkan',
                        });
                        fileInput.value = '';
                        return;
                    }

                    // Check file size
                    if (file.size > maxSize) {
                        fileInput.classList.add('is-invalid');
                        fileError.classList.remove('d-none');
                        submitBtn.disabled = true;

                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran file terlalu besar',
                            text: 'Ukuran file maksimal 2MB',
                        });

                        // Reset preview and input
                        preview.src = "{{ asset('images/logo-placeholder.jpg') }}";
                        fileInput.value = '';
                        return;
                    }

                    // If validation passes, show preview
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection
