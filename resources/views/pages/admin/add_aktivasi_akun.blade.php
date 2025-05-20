@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Tambah aktivasi Akun Pengguna</h2>

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
        <form action="{{ route('store_aktivasi_akun') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Photo profile Input -->
                    <div class="mb-3">
                        <label for="photo" class="heading text-center fw-bold mb-3">Foto Profil</label>
                        <div class="image-preview-container mb-2">
                            <img id="imagePreview" src="{{ asset('images/profile-placeholder.jpg') }}"
                                class="rounded-circle" width="120" height="120" alt="Preview Foto Profil">
                        </div>
                        <input type="file" class="form-control custom-border" id="photo" name="photo"
                            accept=".jpg,.jpeg,.png" required>
                        <small class="form-text text-muted">Format file: JPG/PNG (maks. 2MB)</small>
                        <div id="fileError" class="invalid-feedback d-none">Ukuran file melebihi 2MB</div>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="heading text-center fw-bold mb-3">Email</label>
                        <input type="email" class="form-control custom-border" id="email" name="email"
                            placeholder="Masukkan email" value="{{ old('email') }}" required>
                    </div>

                    {{-- <!-- Username Input -->
                    <div class="mb-3">
                        <label for="username" class="heading text-center fw-bold mb-3">Username</label>
                        <input type="text" class="form-control custom-border" id="username" name="username"
                            placeholder="Masukkan username" value="{{ old('username') }}" required>
                    </div> --}}

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="heading text-center fw-bold mb-3">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control custom-border rounded-3" id="password" name="password"
                                placeholder="Masukkan password" required>
                            <button class="toggle-password" type="button"
                                style="border: none; background: transparent; margin-left: -40px; z-index: 10;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-text text-muted">Minimal 8 karakter</small>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Peran Input -->
                    <div class="mb-3">
                        <label for="role" class="heading text-center fw-bold mb-3">Peran</label>
                        <select class="form-select custom-border" id="role" name="role" required>
                            <option selected disabled value="">Pilih Peran...</option>
                            <option value="Mentor" {{ old('role') == 'Mentor' ? 'selected' : '' }}>Mentor</option>
                            <option value="Perusahaan" {{ old('role') == 'Perusahaan' ? 'selected' : '' }}>Perusahaan
                            </option>
                            <option value="Maxians" {{ old('role') == 'Maxians' ? 'selected' : '' }}>Maxians</option>
                        </select>
                    </div>

                    <!-- Last login Input -->
                    <div class="mb-3">
                        <label for="last_login" class="heading text-center fw-bold mb-3">Terakhir Login</label>
                        <input type="datetime-local" class="form-control custom-border" id="last_login" name="last_login"
                            value="{{ old('last_login') }}">
                    </div>

                    <!-- Activation Input -->
                    <div class="mb-3">
                        <label class="heading text-center fw-bold mb-3">Aktivasi</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active"
                                value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktifkan Akun</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" onclick="window.location.href='{{ route('aktivasi_akun') }}'"
                    class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Image Preview and Validation Functionality
            document.getElementById('photo').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('imagePreview');
                const fileInput = document.getElementById('photo');
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

            // Toggle Password Visibility
            document.querySelector('.toggle-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });

            // Handle toggle switch value
            document.getElementById('is_active').addEventListener('change', function(e) {
                if (this.checked) {
                    this.value = '1';
                } else {
                    this.value = '0';
                }
            });
        </script>
    @endpush
@endsection
