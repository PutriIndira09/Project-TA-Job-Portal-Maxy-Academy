@extends('partials.partials_mentor.layout')

@section('content')
    <div class="container-fluid p-4">
        <div class="py-3 py-md-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card rounded-4 custom-border">
                            <div class="card-header bg-gradient-primary text-white p-4"
                                style="border-top-left-radius: 0.94rem; border-top-right-radius: 0.94rem;">
                                <h4 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Konsultasi Karir</h4>
                                <p class="text-white-50 mb-0 mt-2">Masukkan tanggal dan jam untuk jadwal konsultasi karir
                                    Anda</p>
                            </div>
                            <div class="card-body p-4">
                                <!-- Alert SweetAlert -->
                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: '{{ session('success') }}',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>
                                @elseif (session('error'))
                                    <script>
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: '{{ session('error') }}',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>
                                @endif

                                <div class="appointment-form p-3 rounded-4 bg-light custom-border">
                                    <h5 class="mb-4 text-primary"><i class="fas fa-clock me-2"></i>Detail Jadwal</h5>

                                    <form id="jadwalForm" action="{{ route('store_atur_jadwal_konsultasi') }}"
                                        method="POST">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger mb-3">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (session('error_details'))
                                            <div class="alert alert-danger mb-3">
                                                <p class="mb-1"><strong>Detail Error:</strong></p>
                                                <pre class="mb-0">{{ session('error_details') }}</pre>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="tanggal" class="form-label fw-bold">Tanggal Konsultasi:</label>
                                                <input type="date" name="tanggal" id="tanggal"
                                                    class="form-control form-control-lg rounded-3 custom-border"
                                                    min="{{ date('Y-m-d') }}" required>
                                                <div class="form-text text-muted">
                                                    <i class="fas fa-info-circle me-1"></i> Pilih tanggal mulai hari ini
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="jam" class="form-label fw-bold">Jam Konsultasi:</label>
                                                <input type="time" name="jam" id="jam"
                                                    class="form-control form-control-lg rounded-3 custom-border"
                                                    value="08:00" min="08:00" max="17:00" required>
                                                <div class="form-text text-muted">
                                                    <i class="fas fa-info-circle me-1"></i> Tersedia dari pukul 08:00 hingga
                                                    17:00
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 mt-4">
                                            <button type="submit" class="btn btn-edit btn-lg">
                                                <i class="fas fa-save me-2"></i>Simpan Jadwal
                                            </button>
                                            <button type="button" id="resetBtn" class="btn btn-back">
                                                <i class="fas fa-redo me-2"></i>Reset
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('jadwalForm');
            const tanggalInput = document.getElementById('tanggal');
            const jamInput = document.getElementById('jam');
            const resetBtn = document.getElementById('resetBtn');

            // Set minimum date to today
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            tanggalInput.min = `${yyyy}-${mm}-${dd}`;

            // Set today's date as default value
            tanggalInput.value = `${yyyy}-${mm}-${dd}`;

            // Reset form
            resetBtn.addEventListener('click', function() {
                tanggalInput.value = `${yyyy}-${mm}-${dd}`;
                jamInput.value = '08:00';
            });

            // Form validation
            function validateForm() {
                // Reset all error
                document.querySelectorAll('.error-feedback').forEach(el => el.remove());
                document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                // Validate date
                if (!tanggalInput.value) {
                    displayInputError(tanggalInput, 'Silakan masukkan tanggal terlebih dahulu');
                    return false;
                }

                // Validate selected date is not in the past
                const selectedDate = new Date(tanggalInput.value);
                const currentDate = new Date();
                currentDate.setHours(0, 0, 0, 0);

                if (selectedDate < currentDate) {
                    displayInputError(tanggalInput, 'Tanggal tidak boleh di masa lalu');
                    return false;
                }

                // Validate time
                const jamInputValue = jamInput.value;
                if (jamInputValue === '') {
                    displayInputError(jamInput, 'Silakan masukkan jam konsultasi');
                    return false;
                }

                // Validate working hours (08:00 - 17:00)
                const jam = parseInt(jamInputValue.split(':')[0]);
                if (jam < 8 || jam > 17) {
                    displayInputError(jamInput, 'Jam konsultasi harus antara 08:00 - 17:00');
                    return false;
                }

                return true;
            }

            // Function to display input errors
            function displayInputError(input, message) {
                input.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback error-feedback';
                errorDiv.textContent = message;
                input.parentNode.appendChild(errorDiv);
            }

            // Handle form submission with AJAX
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate form first
                if (!validateForm()) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Mohon perbaiki data yang tidak valid',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Show loading indicator
                Swal.fire({
                    title: 'Menyimpan...',
                    html: 'Sedang menyimpan jadwal konsultasi',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form via AJAX
                fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw new Error(err.message || 'Terjadi kesalahan')
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                willClose: () => {
                                    // Redirect setelah SweetAlert ditutup
                                    window.location.href =
                                        "{{ route('cek_ketersediaan_jadwal') }}";
                                }
                            }).then(() => {
                                // Reset form setelah redirect (jika diperlukan)
                                form.reset();
                                tanggalInput.value = `${yyyy}-${mm}-${dd}`;
                                jamInput.value = '08:00';
                            });
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan saat menyimpan');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Gagal!',
                            text: error.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        });
    </script>
@endsection
