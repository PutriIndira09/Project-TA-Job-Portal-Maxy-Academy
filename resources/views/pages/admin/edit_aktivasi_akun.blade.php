@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Edit Akun Pengguna</h2>

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

        <form action="{{ route('update_aktivasi_akun', $account->id_pengguna) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Photo profile -->
                    <div class="mb-3">
                        <label class="heading text-center fw-bold mb-3">Foto Profil</label>
                        <div class="d-flex align-items-center">
                            <div class="image-preview-container me-3">
                                @if ($account->foto_profil)
                                    <img id="imagePreview" src="{{ asset('storage/' . $account->foto_profil) }}"
                                        class="rounded-circle" width="80" height="80" alt="Profile Image">
                                @else
                                    <img id="imagePreview" src="{{ asset('images/profile.jpg') }}" class="rounded-circle"
                                        width="80" height="80" alt="Default Profile">
                                @endif
                            </div>
                            <input type="file" class="form-control custom-border" name="photo" id="photoUpload"
                                accept="image/*">
                        </div>
                        <small class="text-muted">Format: JPG, PNG (max 2MB)</small>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="heading text-center fw-bold mb-3">Email</label>
                        <input type="email" class="form-control custom-border" name="email"
                            value="{{ old('email', $account->email) }}" required>
                    </div>

                    {{-- <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="heading text-center fw-bold mb-3">Username</label>
                        <input type="text" class="form-control custom-border" name="username"
                            value="{{ old('username', $account->username) }}" required>
                    </div> --}}
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="heading text-center fw-bold mb-3">Password</label>
                        <div class="input-group position-relative">
                            <input type="password" class="form-control custom-border pe-5 rounded-3" name="password"
                                id="password" placeholder="Kosongkan jika tidak ingin mengubah">
                            <i class="fas fa-eye toggle-password position-absolute end-0 top-50 translate-middle-y me-3"
                                style="cursor: pointer; z-index: 5; background: transparent; border: none;"></i>
                        </div>
                        <small class="form-text text-muted">Minimal 8 karakter</small>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="heading text-center fw-bold mb-3">Peran</label>
                        <select class="form-select custom-border" name="role" required>
                            <option value="Mentor" {{ old('role', $account->role) == 'Mentor' ? 'selected' : '' }}>Mentor
                            </option>
                            <option value="Perusahaan" {{ old('role', $account->role) == 'Perusahaan' ? 'selected' : '' }}>
                                Perusahaan</option>
                            <option value="Maxians" {{ old('role', $account->role) == 'Maxians' ? 'selected' : '' }}>Maxians
                            </option>
                        </select>
                    </div>

                    <!-- Last Login -->
                    <div class="mb-3">
                        <label for="last_login" class="heading text-center fw-bold mb-3">Terakhir Login</label>
                        <input type="datetime-local" class="form-control custom-border" name="last_login"
                            value="{{ old('last_login', $account->last_login ? $account->last_login->format('Y-m-d\TH:i') : '') }}">
                    </div>

                    <!-- Activation -->
                    <div class="mb-3">
                        <label class="heading text-center fw-bold mb-3">Status Akun</label>

                        <!-- Critical hidden input -->
                        <input type="hidden" name="is_active" value="0">

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                {{ $account->is_active ? 'checked' : '' }}>

                            <label class="form-check-label" for="is_active">
                                {{ $account->is_active ? 'Aktif' : 'Nonaktif' }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" onclick="window.location.href='{{ route('aktivasi_akun') }}'"
                    class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Image Preview Functionality
            document.getElementById('photoUpload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');
                const reader = new FileReader();

                if (file) {
                    const validTypes = ['image/jpeg', 'image/png'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!validTypes.includes(file.type)) {
                        alert('Hanya file JPG/PNG yang diperbolehkan');
                        event.target.value = '';
                        return;
                    }

                    if (file.size > maxSize) {
                        alert('Ukuran file maksimal 2MB');
                        event.target.value = '';
                        return;
                    }

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
