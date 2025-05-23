@extends('partials.partials_maxians.app')

@section('content')
    <!-- Section Header -->
    <div class="container-fluid">
        <h1 class="heading">
            <span class="text-dark">Tunjukkan Potensimu!</span>
            <span class="text-primary">Unggah<br></span>
            <span class="text-primary">Dokumen Lamaran</span>
            <span class="text-dark">Sekarang!</span>
        </h1>

        <p class="sub-heading mt-3">
            Dokumen lengkap akan membuat lamaranmu lebih menonjol! Unggah CV, <br> portofolio, dan akun media sosialmu untuk
            memulai perjalanan karier impianmu.</br>
        </p>
    </div>

    <!-- Display flash messages -->
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Section Form Input -->
    <div class="container-fluid mt-5">
        <form action="{{ route('dokumen_lamaran_store') }}" method="POST" enctype="multipart/form-data" id="dokumenForm">
            @csrf
            <div class="row">
                <!-- Akun Instagram -->
                <div class="col-md-6 mb-3">
                    <label for="akun_instagram" class="form-label">Akun Instagram :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="akun_instagram"
                        name="akun_instagram" placeholder="Masukkan akun instagram" value="{{ old('akun_instagram') }}">
                </div>

                <!-- Akun LinkedIn -->
                <div class="col-md-6 mb-3">
                    <label for="akun_LinkedIn" class="form-label">Akun LinkedIn :</label>
                    <input type="text" class="form-control custom-border rounded-5" id="akun_LinkedIn"
                        name="akun_LinkedIn" placeholder="Masukkan akun LinkedIn" value="{{ old('akun_LinkedIn') }}">
                </div>
            </div>

            <div class="row">
                <!-- Upload Curriculum Vitae -->
                <div class="col-md-6 mt-3">
                    <label for="file_cv" class="form-label">Upload Curriculum Vitae :</label>
                    <input type="file" class="form-control custom-border rounded-5" id="file_cv" name="file_cv"
                        accept="application/pdf" onchange="validateFileSize(this, 'cv_error')">
                    <small class="text-muted">Format: PDF, Max: 2MB</small>
                    <div id="cv_error" class="text-danger" style="display: none;"></div>
                    <div id="cv_preview" style="margin-top: 10px; height: 300px; overflow-y: scroll; display: none;"></div>
                </div>

                <!-- Upload Portofolio -->
                <div class="col-md-6 mt-3">
                    <label for="file_portofolio" class="form-label">Upload Portofolio :</label>
                    <input type="file" class="form-control custom-border rounded-5" id="file_portofolio"
                        name="file_portofolio" accept="application/pdf"
                        onchange="validateFileSize(this, 'portofolio_error')">
                    <small class="text-muted">Format: PDF, Max: 2MB</small>
                    <div id="portofolio_error" class="text-danger" style="display: none;"></div>
                    <div id="portofolio_preview"
                        style="margin-top: 10px; height: 300px; overflow-y: scroll; display: none;"></div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="container-fluid">
                <div class="mt-5">
                    <div class="d-flex align-items-start justify-content-between" style="margin-left: -8px">
                        <div class="d-flex flex-wrap gap-2">
                            <div>
                                <button type="submit" class="btn btn-edit rounded-5">Kirim</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-create rounded-5"
                                    onclick="window.location='{{ route('dokumen_lamaran_hasil') }}'">Lihat hasil
                                    dokumen <i class="fa-solid fa-arrow-right ms-3"></i></button>
                            </div>
                        </div>
                        <div>
                            <img src="{{ asset('images/logo-maxy.svg') }}" alt="Logo Maxy" class="img-fluid" width="300">
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
@endsection

@push('scripts')
    <!-- Tambahkan SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.11.338/build/pdf.min.js"></script>

    <!-- Success Notification with SweetAlert -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                });
            });
        </script>
    @endif

    <script>
        // Set PDF.js worker
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@2.11.338/build/pdf.worker.min.js';

        // Function to validate file size
        function validateFileSize(input, errorElementId) {
            const errorElement = document.getElementById(errorElementId);
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes

            if (input.files.length > 0) {
                const file = input.files[0];
                const fileSize = file.size;

                // Check file type
                if (file.type !== 'application/pdf') {
                    errorElement.textContent = 'Format file harus PDF!';
                    errorElement.style.display = 'block';
                    input.value = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Salah',
                        text: 'Harap unggah file PDF yang valid.',
                        confirmButtonColor: '#d33',
                    });
                    return;
                }

                if (fileSize > maxSize) {
                    errorElement.textContent = 'Ukuran file melebihi 2MB!';
                    errorElement.style.display = 'block';
                    input.value = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Maksimal ukuran file adalah 2MB.',
                        confirmButtonColor: '#d33',
                    });
                } else {
                    errorElement.style.display = 'none';
                    // If file is valid, proceed with preview
                    if (input.id === 'file_cv') {
                        previewFile('file_cv', 'cv_preview');
                    } else if (input.id === 'file_portofolio') {
                        previewFile('file_portofolio', 'portofolio_preview');
                    }
                }
            } else {
                errorElement.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.getElementById('dokumenForm');
            form.addEventListener('submit', function(event) {
                let isValid = true;
                const instagram = document.getElementById('akun_instagram').value.trim();
                const linkedin = document.getElementById('akun_LinkedIn').value.trim();
                const cv = document.getElementById('file_cv').files.length;
                const portfolio = document.getElementById('file_portofolio').files.length;

                // Validate required fields
                if (!instagram || !linkedin || cv === 0 || portfolio === 0) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: 'Semua kolom harus diisi!',
                        confirmButtonColor: '#d33',
                    });
                    isValid = false;
                }

                // Validate file sizes
                if (cv > 0) {
                    const cvFile = document.getElementById('file_cv').files[0];
                    if (cvFile.size > 2 * 1024 * 1024) {
                        event.preventDefault();
                        document.getElementById('cv_error').textContent = 'File CV maksimal berukuran 2MB!';
                        document.getElementById('cv_error').style.display = 'block';
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File CV Terlalu Besar',
                            text: 'Maksimal ukuran file CV adalah 2MB.',
                            confirmButtonColor: '#d33',
                        });
                        isValid = false;
                    }
                }

                if (portfolio > 0) {
                    const portfolioFile = document.getElementById('file_portofolio').files[0];
                    if (portfolioFile.size > 2 * 1024 * 1024) {
                        event.preventDefault();
                        document.getElementById('portofolio_error').textContent =
                            'File Portofolio maksimal berukuran 2MB!';
                        document.getElementById('portofolio_error').style.display = 'block';
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File Portofolio Terlalu Besar',
                            text: 'Maksimal ukuran file Portofolio adalah 2MB.',
                            confirmButtonColor: '#d33',
                        });
                        isValid = false;
                    }
                }

                return isValid;
            });
        });

        function previewFile(inputId, previewId) {
            var file = document.getElementById(inputId).files[0];
            var reader = new FileReader();

            // Check if the file exists
            if (!file) return;

            reader.onload = function(e) {
                var url = e.target.result;
                var previewContainer = document.getElementById(previewId);
                previewContainer.innerHTML = '<p>Loading preview...</p>';
                previewContainer.style.display = 'block';

                var loadingTask = pdfjsLib.getDocument(url);
                loadingTask.promise.then(function(pdf) {
                    previewContainer.innerHTML = '';

                    // Just load first page for preview
                    pdf.getPage(1).then(function(page) {
                        var viewport = page.getViewport({
                            scale: 1
                        });
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };

                        page.render(renderContext).promise.then(function() {
                            previewContainer.appendChild(canvas);
                        });
                    });
                }).catch(function(error) {
                    previewContainer.innerHTML = '<p>Error loading PDF: ' + error.message + '</p>';
                });
            };

            reader.readAsDataURL(file);
        }
    </script>
@endpush
