@extends('partials.partials_mentor.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2">Daftar Laporan Hasil</h2>
        <h2 class="heading-2-primary mb-4">Konsultasi Karir</h2>

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

        {{-- <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <ul class="dropdown-menu" aria-labelledby="columnVisibilityBtn">
                    <li><a class="dropdown-item" href="#" data-column="0">No.</a></li>
                    <li><a class="dropdown-item" href="#" data-column="1">Tanggal</a></li>
                    <li><a class="dropdown-item" href="#" data-column="2">Jam</a></li>
                    <li><a class="dropdown-item" href="#" data-column="3">Nama Maxians</a></li>
                    <li><a class="dropdown-item" href="#" data-column="4">Komentar</a></li>
                    <li><a class="dropdown-item" href="#" data-column="5">Bukti Konsultasi</a></li>
                    <li><a class="dropdown-item" href="#" data-column="6">Status</a></li>
                </ul>
            </div>
        </div> --}}

        <!-- Table -->
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Tanggal</th>
                        <th class="heading text-center fw-bold">Jam</th>
                        <th class="heading text-center fw-bold">Nama Maxians</th>
                        <th class="heading text-center fw-bold">Komentar</th>
                        <th class="heading text-center fw-bold">Bukti Konsultasi</th>
                        <th class="heading text-center fw-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporanKonsultasiMentor as $index => $laporan)
                        <tr>
                            <td class="sub-heading text-center">{{ $index + 1 }}</td>
                            <td class="sub-heading text-center">
                                {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</td>
                            <td class="sub-heading text-center">{{ \Carbon\Carbon::parse($laporan->jam)->format('H:i') }}
                            </td>
                            <td class="sub-heading text-center">{{ $laporan->nama_maxians }}</td>
                            <td class="sub-heading text-center">{{ $laporan->komentar }}</td>
                            <td class="text-center">
                                @if ($laporan->bukti_konsultasi)
                                    <img src="{{ asset($laporan->bukti_konsultasi) }}" class="rounded-circle" width="50"
                                        height="50" alt="Bukti Konsultasi" style="cursor: pointer;"
                                        onclick="previewImage('{{ $laporan->bukti_konsultasi }}')">
                                @else
                                    <span>Tidak ada bukti</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('add_laporan_hasil_konsultasi_mentor') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-create rounded-pill px-4">Create</button>
                                    </form>
                                    <form
                                        action="{{ route('edit_laporan_hasil_konsultasi_mentor', $laporan->id_laporan_mentor) }}"
                                        method="GET">
                                        <button type="submit" class="btn btn-edit rounded-pill px-4">Edit</button>
                                    </form>
                                    <form
                                        action="{{ route('delete_laporan_hasil_konsultasi_mentor', $laporan->id_laporan_mentor) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete rounded-pill px-4">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td class="sub-heading text-center ">1</td>
                        <td class="sub-heading text-center">1 Maret 2025</td>
                        <td class="sub-heading text-center ">12:00 WIB</td>
                        <td class="sub-heading text-center">Putri Indira</td>
                        <td class="sub-heading text-center">Perlu uplskilling lagi</td>
                        <td class="text-center"><img src="{{ asset('images/bukti-konsultasi.png') }}" alt="Profile"></td>
                        <td class="sub-heading text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button href="{{ route('add_tag_lowongan_kerja') }}"
                                    class="btn btn-create rounded-pill px-4">Create</button>
                                <button href="#" class="btn btn-edit rounded-pill px-4">Edit</button>
                                <button class="btn btn-delete rounded-pill px-4">Delete</button>
                            </div>
                        </td>
                    </tr> --}}
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search No."></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Tanggal"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Jam"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Nama Maxians"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Komentar"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Bukti Konsultasi"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Status"></th>
                    </tr>
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
