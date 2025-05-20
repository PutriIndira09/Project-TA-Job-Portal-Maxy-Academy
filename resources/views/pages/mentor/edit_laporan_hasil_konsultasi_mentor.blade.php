@extends('partials.partials_mentor.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Edit Laporan Hasil Konsultasi</h2>

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

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Edit Form -->
        <form action="{{ route('update_laporan_hasil_konsultasi_mentor', $laporan->id_laporan_mentor) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Tanggal Konsultasi -->
                    <div class="mb-3">
                        <label for="tanggal" class="heading text-center fw-bold mb-3">Tanggal Konsultasi</label>
                        <input type="date" class="form-control custom-border" id="tanggal" name="tanggal" 
                               value="{{ old('tanggal', $laporan->tanggal) }}" required>
                    </div>

                    <!-- Jam Konsultasi -->
                    <div class="mb-3">
                        <label for="jam" class="heading text-center fw-bold mb-3">Jam Konsultasi</label>
                        <input type="time" class="form-control custom-border" id="jam" name="jam" 
                               value="{{ old('jam', $laporan->jam) }}" required>
                    </div>

                    <!-- Nama Maxians -->
                    <div class="mb-3">
                        <label for="nama_maxians" class="heading text-center fw-bold mb-3">Nama Maxians</label>
                        <input type="text" class="form-control custom-border" id="nama_maxians" name="nama_maxians" 
                               placeholder="Masukkan nama maxians" value="{{ old('nama_maxians', $laporan->nama_maxians) }}" required>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Komentar -->
                    <div class="mb-3">
                        <label for="komentar" class="heading text-center fw-bold mb-3">Komentar</label>
                        <textarea class="form-control custom-border" id="komentar" name="komentar" 
                                  placeholder="Masukkan komentar" rows="3" required>{{ old('komentar', $laporan->komentar) }}</textarea>
                    </div>

                    <!-- Bukti Konsultasi (Upload File) -->
                    <div class="mb-3">
                        <label for="bukti_konsultasi" class="heading text-center fw-bold mb-3">Bukti Konsultasi</label>
                        <div class="image-preview-container mb-2">
                            @if ($laporan->bukti_konsultasi)
                                <img id="imagePreview" src="{{ asset('storage/' . $laporan->bukti_konsultasi) }}" 
                                     class="rounded-circle" width="120" height="120" alt="Preview Bukti Konsultasi">
                            @else
                                <img id="imagePreview" src="{{ asset('images/profile-placeholder.jpg') }}" 
                                     class="rounded-circle" width="120" height="120" alt="Preview Foto Bukti Konsultasi">
                            @endif
                        </div>
                        <input type="file" class="form-control custom-border" id="bukti_konsultasi" 
                               name="bukti_konsultasi" accept=".jpg,.jpeg,.png,.pdf">
                        <small class="form-text text-muted">Format file: JPG/PNG/PDF (maks. 2MB)</small>
                        <div id="fileError" class="invalid-feedback d-none">Ukuran file melebihi 2MB</div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" onclick="window.location.href='{{ route('laporan_hasil_konsultasi_mentor') }}'" 
                        class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Perbarui</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Image Preview and Validation Functionality
            document.getElementById('bukti_konsultasi').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('imagePreview');
                const fileInput = document.getElementById('bukti_konsultasi');
                const fileError = document.getElementById('fileError');
                const submitBtn = document.querySelector('button[type="submit"]');
                const reader = new FileReader();

                // Validation parameters
                const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
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
                            text: 'Hanya file JPG/PNG/PDF yang diperbolehkan',
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
                        preview.src = "{{ asset('images/profile-placeholder.jpg') }}";
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