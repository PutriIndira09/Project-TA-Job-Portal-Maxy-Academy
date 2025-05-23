@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Aktivasi Akun Pengguna</h2>

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

        <!-- Table -->
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Foto Profil</th>
                        <th class="heading text-center fw-bold">Email</th>
                        <th class="heading text-center fw-bold">Name</th>
                        {{-- <th class="heading text-center fw-bold">Password</th> --}}
                        <th class="heading text-center fw-bold">Peran</th>
                        <th class="heading text-center fw-bold">Terakhir Login</th>
                        <th class="heading text-center fw-bold">Status</th>
                        {{-- <th class="heading text-center fw-bold">Terakhir Login</th>
                        <th class="heading text-center fw-bold">Aktivasi</th>
                        <th class="heading text-center fw-bold">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $index => $account)
                        <tr>
                            <td class="sub-heading text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                @if ($account->foto_profil)
                                    @php
                                        $imagePath = 'photo_profil_users/' . basename($account->foto_profil); // Mendapatkan nama file saja
                                        $fileExists = file_exists(public_path($imagePath)); // Cek file existence di folder public
                                    @endphp

                                    @if ($fileExists)
                                        <img src="{{ asset($imagePath) }}" class="rounded-circle" width="50"
                                            height="50" alt="Profile" style="cursor: pointer;"
                                            onclick="previewImage('{{ asset($imagePath) }}')">
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center text-muted"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-user-circle mb-1" style="font-size: 1.2rem;"></i>
                                            <small style="font-size: 0.5rem;">File Not Found</small>
                                        </div>
                                    @endif
                                @else
                                    <div class="d-flex flex-column align-items-center justify-content-center text-muted"
                                        style="width: 50px; height: 50px;">
                                        <i class="fas fa-user-circle mb-1"></i>
                                        <small>Tidak ada foto</small>
                                    </div>
                                @endif
                            </td>
                            <td class="sub-heading text-center">{{ $account->email }}</td>
                            <td class="sub-heading text-center">{{ $account->user_name ?? $account->name }}</td>
                            {{-- <td class="sub-heading text-center">
                                <div class="password-field">
                                    <span class="password-asterisks">********</span>
                                    <button class="btn btn-sm btn-show-password" type="button"
                                        data-password="{{ $account->password }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td> --}}
                            <td class="text-center">
                                @switch($account->role)
                                    @case('Perusahaan')
                                        <span class="btn btn-edit rounded-pill px-4">{{ $account->role }}</span>
                                    @break

                                    @case('Mentor')
                                        <span class="btn btn-mentor rounded-pill px-4">{{ $account->role }}</span>
                                    @break

                                    @case('Maxians')
                                        <span class="btn btn-create rounded-pill px-4">{{ $account->role }}</span>
                                    @break

                                    @default
                                        <span class="btn btn-mentor rounded-pill px-4">{{ $account->role }}</span>
                                @endswitch
                            </td>
                            <td class="sub-heading text-center">
                                <!-- Menampilkan created_at atau updated_at sebagai "Terakhir Login" -->
                                @if ($account->updated_at)
                                    {{ \Carbon\Carbon::parse($account->updated_at)->format('d M Y H:i') }}
                                @else
                                    <span class="text-muted">Belum ada login</span>
                                @endif
                            </td>

                            <!-- Toggle Switch for Status -->
                            <td class="sub-heading text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="{{ route('update_status', $account->id_pengguna) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-check form-switch" style="margin-right: -8px">
                                            <input class="form-check-input custom-switch" type="checkbox" role="switch"
                                                name="is_active" {{ $account->status == 'aktif' ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            {{-- <label class="form-check-label">
                                            {{ $account->status == 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                        </label> --}}
                                        </div>
                                    </form>
                                </div>
                            </td>

                            {{-- <td class="sub-heading text-center">
                                {{ $account->last_login ? $account->last_login->format('d M Y H:i') : 'Belum login' }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input custom-switch" type="checkbox" role="switch"
                                            {{ $account->is_active ? 'checked' : '' }} disabled>
                                    </div>
                                </div>
                            </td> --}}
                            {{-- <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if (isset($account->id_pengguna))
                                        <form action="{{ route('edit_aktivasi_akun', $account->id_pengguna) }}"
                                            method="GET">
                                            <button type="submit" class="btn btn-edit rounded-pill px-4">Edit</button>
                                        </form>

                                        <form action="{{ route('delete_aktivasi_akun', $account->id_pengguna) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete rounded-pill px-4">Delete</button>
                                        </form>
                                    @else
                                        <button disabled class="btn btn-edit rounded-pill px-4">Edit</button>
                                        <button disabled class="btn btn-delete rounded-pill px-4">Delete</button>
                                    @endif
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search No."></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Foto Profil"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Email"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Username"></th> --}}
                {{-- <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Password"></th> --}}
                {{-- <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Peran"></th> --}}
                {{-- <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Terakhir Login"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Aktivasi"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Action"></th> --}}
                {{-- </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>

    @push('scripts')
        <!-- Image Preview Modal -->
        <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img id="previewImage" src="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.form-check-input').forEach((checkbox) => {
                checkbox.addEventListener('change', function() {
                    let status = this.checked ? 'aktif' : 'tidak aktif';
                    let accountId = this.closest('form').querySelector('input[name="account_id"]').value;

                    if (!this.checked) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Akun Anda telah dinonaktifkan oleh admin',
                            text: 'Silahkan hubungi admin untuk informasi lebih lanjut.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Redirect user to login page or other actions as needed
                            window.location.href = "{{ url('/login') }}";
                        });
                    }
                });
            });

            // Preview image in modal
            function previewImage(src) {
                // Ensure that the source path is correct. If it's a relative path, prefix it with the base URL.
                let basePath = "http://127.0.0.1:8080/"; // Use your actual base URL here
                if (!src.startsWith("http")) {
                    src = basePath + src; // If the source doesn't start with 'http', prepend the base URL
                }

                document.getElementById('previewImage').src = src;
                new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
            }

            $(document).ready(function() {
                if (!$.fn.DataTable.isDataTable('#datatable')) {
                    $('#datatable').DataTable({
                        dom: 'Bfrtip',
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        lengthChange: false,
                        pageLength: 10,
                        buttons: [
                            'copy',
                            'excel',
                            'pdf',
                            'colvis'
                        ]
                    });
                }

                // Password show/hide functionality
                $('.btn-show-password').click(function() {
                    const button = $(this);
                    const passwordField = button.siblings('.password-asterisks');
                    const password = button.data('password');

                    if (passwordField.text() === '********') {
                        passwordField.text(password);
                        button.html('<i class="fas fa-eye-slash"></i>');
                    } else {
                        passwordField.text('********');
                        button.html('<i class="fas fa-eye"></i>');
                    }
                });

                // SweetAlert for delete confirmation
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const form = this.closest('form');

                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
