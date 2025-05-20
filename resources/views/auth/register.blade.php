<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maxy Academy - Register</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-dark: #04198C;
            --primary-medium: #0540F2;
            --primary-light: #056CF2;
            --secondary-blue: #DCE6F4;
            --accent-yellow: #FFB800;
            --light-yellow: #F2CB05;
            --neutral-gray: #8C939D;
            --pure-white: #FFFFFF;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            font-size: 0.9rem;
            overflow: hidden;
        }

        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .register-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg,
                    rgba(4, 25, 140, 0.15),
                    rgba(5, 64, 242, 0.1));
            z-index: -1;
        }

        .register-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            max-height: 90vh;
            margin: 0 auto;
            padding: 0 15px;
            overflow-y: auto;
            /* Enable vertical scrolling */
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: var(--primary-light) rgba(255, 255, 255, 0.2);
        }

        /* Custom scrollbar for Webkit browsers */
        .register-container::-webkit-scrollbar {
            width: 6px;
        }

        .register-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .register-container::-webkit-scrollbar-thumb {
            background-color: var(--primary-medium);
            border-radius: 10px;
        }

        .register-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(4, 25, 140, 0.15);
            overflow: hidden;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 2;
            margin: 20px 0;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.4) 0%,
                    rgba(255, 255, 255, 0.1) 100%);
            z-index: -1;
            border-radius: 1rem;
            pointer-events: none;
        }

        .card-header {
            background: linear-gradient(135deg,
                    rgba(5, 64, 242, 0.7),
                    rgba(5, 108, 242, 0.6));
            color: white;
            text-align: center;
            padding: 1.75rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            font-size: 0.9rem;
            padding: 0.5rem 0.75rem;
            height: calc(1.5em + 1rem);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(5, 64, 242, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(5, 64, 242, 0.2);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            margin-bottom: 0.4rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-register {
            background-color: var(--primary-medium);
            border: none;
            padding: 0.6rem;
            font-weight: 600;
            color: white;
            border-radius: 0.6rem;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .btn-register:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 64, 242, 0.2);
        }

        .input-group-text {
            background-color: var(--secondary-blue);
            border: 1px solid #e0e0e0;
            color: var(--primary-medium);
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        .logo {
            width: 50px;
            margin-bottom: 1.25rem;
        }

        /* Judul diperbesar */
        .card-header h4 {
            font-size: 1.5rem;
            /* Diperbesar dari 1.25rem ke 1.5rem */
            margin-bottom: 0.5rem;
        }

        /* Subjudul diperbesar */
        .card-header small {
            font-size: 0.9rem;
            /* Diperbesar dari 0.8rem ke 0.9rem */
        }

        /* Form elements lebih lebar */
        .form-control {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            font-size: 0.95rem;
            /* Sedikit diperbesar */
            padding: 0.6rem 0.85rem;
            /* Ditambah padding */
            height: calc(1.5em + 1.1rem);
        }


        /* Alert styling */
        .alert-danger {
            background-color: rgba(255, 184, 0, 0.1);
            border: 1px solid var(--accent-yellow);
            color: #5a5c69;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            color: #5a5c69;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        /* Links */
        a {
            color: var(--primary-medium);
            transition: color 0.2s;
            font-size: 0.85rem;
        }

        a:hover {
            color: var(--primary-dark);
        }

        /* Toggle password eye */
        .toggle-password {
            color: var(--primary-medium);
            transition: color 0.2s;
            cursor: pointer;
        }

        .toggle-password:hover {
            color: var(--primary-dark);
        }

        /* Error messages */
        .error-message {
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .register-container {
                max-width: 100%;
                padding: 0 10px;
            }

            .card-header {
                padding: 1rem 0.5rem;
            }

            .card-body {
                padding: 1rem;
            }

            .form-control,
            .form-select {
                font-size: 0.85rem;
                padding: 0.45rem 0.65rem;
            }

            .btn-register {
                padding: 0.5rem;
                font-size: 0.85rem;
            }

            body {
                font-size: 0.85rem;
            }
        }

        .image-preview-container {
            margin-bottom: 1rem;
        }

        #imagePreview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 2px solid var(--primary-light);
        }

        #imagePreview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #imagePreview i {
            font-size: 3rem;
            color: var(--primary-light);
        }
    </style>
</head>

<body>
    <img src="{{ asset('images/login.JPG') }}" alt="Background" class="bg-image">
    <div class="register-overlay"></div>
    <div class="container">
        <div class="register-container">
            <div class="register-card">
                <div class="card-header">
                    <img src="{{ asset('images/logo.png') }}" alt="Maxy Academy Logo" class="logo">
                    <h4 class="mb-1" style="font-size: 1.25rem;">Daftar Akun Baru</h4>
                    <small style="font-size: 0.8rem;">Silakan isi data diri Anda</small>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0" style="padding-left: 1rem;">
                                @foreach ($errors->all() as $error)
                                    <li style="font-size: 0.8rem;">{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                style="font-size: 0.6rem;"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <span style="font-size: 0.8rem;">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                style="font-size: 0.6rem;"></button>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap"
                                    required>
                            </div>
                            @error('name')
                                <div class="text-danger error-message">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="your@email.com" required>
                            </div>
                            @error('email')
                                <div class="text-danger error-message">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="••••••••" required>
                                <span class="input-group-text toggle-password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="text-danger error-message">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="my-4">
                            <label for="profile_image" class="form-label">Foto Profil</label>
                            <div class="d-flex align-items-center">
                                <div class="image-preview-container me-3">
                                    <div id="imagePreview"
                                        class="rounded-circle d-flex align-items-center justify-content-center bg-light"
                                        style="width: 80px; height: 80px;">
                                        <i class="fa-solid fa-circle-user"
                                            style="font-size: 3rem; color: var(--primary-light);"></i>
                                    </div>
                                </div>
                                <input type="file" class="form-control" name="profile_image" id="profile_image"
                                    accept="image/*" style="width: auto;">
                            </div>
                            <small class="text-white">Format: JPG, PNG (max 2MB)</small>
                            @error('profile_image')
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role" class="form-label">Daftar Sebagai</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role"
                                name="role" required>
                                <option value="" selected disabled>Pilih Role</option>
                                <option value="perusahaan" {{ old('role') == 'perusahaan' ? 'selected' : '' }}>
                                    Perusahaan</option>
                                <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor</option>
                                <option value="maxians" {{ old('role') == 'maxians' ? 'selected' : '' }}>Maxians
                                </option>
                            </select>
                            @error('role')
                                <div class="text-danger error-message">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary btn-create">
                                <i class="fas fa-user-plus me-2"></i> Daftar
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="mb-0" style="font-size: 0.85rem;">Sudah punya akun? <a
                                    href="{{ route('login') }}" class="text-decoration-none">Login disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--SweatAlert2 untuk notifikasi validasi image profile-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JS -->
    <script>
        // Toggle password visibility
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Dynamic font size adjustment
        function adjustFontSize() {
            const viewportWidth = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
            const htmlElement = document.documentElement;

            if (viewportWidth < 400) {
                htmlElement.style.fontSize = '14px';
            } else {
                htmlElement.style.fontSize = '15px';
            }
        }

        // Run on load and resize
        window.addEventListener('load', adjustFontSize);
        window.addEventListener('resize', adjustFontSize);
    </script>

    <script>
        // Image Preview and Validation
        document.getElementById('profile_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const reader = new FileReader();

            if (file) {
                const validTypes = ['image/jpeg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format tidak valid',
                        text: 'Hanya file JPG/PNG yang diperbolehkan',
                        confirmButtonText: 'OK'
                    });
                    event.target.value = '';
                    return;
                }

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran file terlalu besar',
                        text: 'Ukuran foto profil maksimal 2MB',
                        confirmButtonText: 'OK'
                    });
                    event.target.value = '';
                    return;
                }

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script>
        document.getElementById('profile_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const maxSize = 2 * 1024 * 1024; // 2MB
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (file) {
                // Validasi tipe file
                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format tidak valid',
                        text: 'Hanya file JPG/PNG yang diperbolehkan',
                    });
                    event.target.value = '';
                    return;
                }

                // Validasi ukuran file
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran terlalu besar',
                        text: 'Ukuran file maksimal 2MB',
                    });
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    // Bersihkan preview sebelumnya
                    preview.innerHTML = '';

                    // Buat elemen gambar baru
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview Gambar';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
