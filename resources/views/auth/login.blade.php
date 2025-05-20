<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maxy Academy - Login</title>

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
            /* Dark blue - for headers */
            --primary-medium: #0540F2;
            /* Bright blue - primary buttons */
            --primary-light: #056CF2;
            /* Light blue - accents */
            --secondary-blue: #DCE6F4;
            /* Very light blue - backgrounds */
            --accent-yellow: #FFB800;
            /* Gold yellow - important accents */
            --light-yellow: #F2CB05;
            /* Light yellow - secondary accents */
            --neutral-gray: #8C939D;
            /* Medium gray - text/icons */
            --pure-white: #FFFFFF;
            /* White - cards/text */
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
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

        .login-overlay {
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

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .login-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 0.5rem 1.5rem rgba(4, 25, 140, 0.15);
            overflow: hidden;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 2;
        }

        .login-card::before {
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
            border-radius: 1.5rem;
            pointer-events: none;
        }

        .card-header {
            background: linear-gradient(135deg,
                    rgba(5, 64, 242, 0.7),
                    rgba(5, 108, 242, 0.6));
            color: white;
            text-align: center;
            padding: 2.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(5, 64, 242, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(5, 64, 242, 0.2);
        }

        .btn-login {
            background-color: var(--primary-medium);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            color: white;
            border-radius: 0.75rem;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 64, 242, 0.2);
        }

        .input-group-text {
            background-color: var(--secondary-blue);
            border: 1px solid #e0e0e0;
            color: var(--primary-medium);
        }

        .logo {
            width: 50px;
            margin-bottom: 1.5rem;
        }

        /* Alert styling */
        .alert-danger {
            background-color: rgba(255, 184, 0, 0.1);
            border: 1px solid var(--accent-yellow);
            color: #5a5c69;
            border-radius: 0.75rem;
        }

        /* Links */
        a {
            color: var(--primary-medium);
            transition: color 0.2s;
        }

        a:hover {
            color: var(--primary-dark);
        }

        /* Toggle password eye */
        .toggle-password {
            color: var(--primary-medium);
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--primary-dark);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-container {
                padding: 0 20px;
            }

            .card-body {
                padding: 1.75rem;
            }

            .logo {
                width: 140px;
            }
        }
    </style>
</head>

<body>
    <!-- Background image moved to an img tag inside body -->
    <img src="{{ asset('images/login.JPG') }}" alt="Background" class="bg-image">
    <div class="login-overlay"></div>
    <div class="container">
        <div class="login-container">
            <div class="login-card">
                <div class="card-header">
                    <img src="{{ asset('images/logo.png') }}" alt="Maxy Academy Logo" class="logo">
                    <h4 class="mb-1">Selamat Datang!</h4>
                    <small>Silakan masuk ke akun Anda</small>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->has('email'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Akun Anda telah dinonaktifkan',
                                text: 'Silakan hubungi admin untuk informasi lebih lanjut.',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mx-4 my-4">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="your@email.com" required autofocus>
                                @error('email')
                                    <div class="text-danger mt-1" style="font-size: 0.875rem;">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mx-4 my-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="••••••••" required>
                                <span class="input-group-text toggle-password" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>

                <div class="mx-4 my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    {{-- <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa password?</a> --}}

                </div>

                <div class="d-grid mx-4 my-4">
                    <button type="submit" class="btn btn-primary btn-create">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </div>

                <div class="text-center mx-4 my-4">
                    <p class="mb-0">Silahkan hubungi Admin jika anda mengalami kendala
                        <a href="https://api.whatsapp.com/send/?phone=628113955599&text=Hi+Maxy+Academy%21+Mau+nanya-nanya+dong..%0D%0A%0D%0ANama%3A%0D%0AEmail%3A%0D%0AUniversitas%3A%0D%0ASemester%3A%0D%0AJurusan%3A%0D%0A%0D%0AThank+you%21&type=phone_number&app_absent=0"
                            class="text-decoration-none" target="_blank">
                            <i class="fab fa-whatsapp me-1"></i> Contact admin
                        </a>
                    </p>
                </div>
                <!-- register -->
                <div class="text-center mx-4 my-4">
                    <p class="mb-0">Belum punya akun? <a href="{{ 'register' }}"
                            class="text-decoration-none">Daftar disini</a></p>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

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
    </script>
</body>

</html>
