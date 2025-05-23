@extends('partials.partials_perusahaan.layout')

@section('content')
    <div class="container-fluid p-4">

        <!-- Menampilkan alert sukses ketika data berhasil di create -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Alert Error -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h2 class="heading-2 mb-4">Daftar Lowongan Kerja</h2>

        <!-- Column Visibility Dropdown -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <ul class="dropdown-menu" aria-labelledby="columnVisibilityBtn">
                    <li><a class="dropdown-item" href="#" data-column="0">No.</a></li>
                    <li><a class="dropdown-item" href="#" data-column="1">Logo Perusahaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="2">Nama Kategori Pekerjaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="3">Nama Perusahaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="4">Alamat Perusahaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="5">Email Perusahaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="6">Nomor Telepon</a></li>
                    <li><a class="dropdown-item" href="#" data-column="7">Deskripsi Pekerjaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="8">Jenis Kontrak</a></li>
                    <li><a class="dropdown-item" href="#" data-column="9">Lokasi</a></li>
                    <li><a class="dropdown-item" href="#" data-column="10">Gaji</a></li>
                    <li><a class="dropdown-item" href="#" data-column="11">Status</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Logo Perusahaan</th>
                        <th class="heading text-center fw-bold">Nama Kategori Pekerjaan</th>
                        <th class="heading text-center fw-bold">Nama Perusahaan</th>
                        <th class="heading text-center fw-bold">Alamat Perusahaan</th>
                        <th class="heading text-center fw-bold">Email Perusahaan</th>
                        <th class="heading text-center fw-bold">Nomor Telepon</th>
                        <th class="heading text-center fw-bold">Deskripsi Pekerjaan</th>
                        <th class="heading text-center fw-bold">Jenis Kontrak</th>
                        <th class="heading text-center fw-bold">Lokasi</th>
                        <th class="heading text-center fw-bold">Gaji</th>
                        <th class="heading text-center fw-bold">Status</th>
                        <th class="heading text-center fw-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowongans as $index => $lowongan)
                        <tr>
                            {{-- <td class="sub-heading text-center">{{ $index + 1 }}</td> --}}
                            <td class="sub-heading text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($lowongan->logo_perusahaan)
                                    <img src="{{ asset($lowongan->logo_perusahaan) }}" class="rounded-circle" width="50"
                                        height="50" alt="Logo" style="cursor: pointer;"
                                        onclick="previewImage('{{ $lowongan->logo_perusahaan }}')">
                                @else
                                    <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" width="50"
                                        height="50" alt="Logo">
                                @endif
                            </td>
                            {{-- <td class="text-center"><img src="{{ asset('images/' . $lowongan->logo_perusahaan) }}"
                                    class="rounded-circle" alt="Logo"></td> --}}
                            {{-- <td class="sub-heading text-center">{{ $lowongan->nama_kategori }}</td> --}}
                            <td class="sub-heading text-center">
                                @if ($lowongan->kategoriPekerjaan)
                                    {{ $lowongan->kategoriPekerjaan->nama_kategori }}
                                @else
                                    <span class="text-muted">Tidak ada kategori</span>
                                @endif
                            </td>
                            <td class="sub-heading text-center">{{ $lowongan->nama_perusahaan }}</td>
                            <td class="sub-heading text-center description-column">{{ $lowongan->alamat }}</td>
                            <td class="sub-heading text-center">{{ $lowongan->email }}</td>
                            <td class="sub-heading text-center">{{ $lowongan->nomor_telepon }}</td>
                            {{-- <td class="sub-heading text-center">{{ $lowongan->deskripsi_pekerjaan }}</td> --}}
                            {{-- <td class="sub-heading text-center">
                                @if ($lowongan->kategoriPekerjaan)
                                    {{ $lowongan->kategoriPekerjaan->deskripsi }}
                                @else
                                    <span class="text-muted">Tidak ada deskripsi</span>
                                @endif
                            </td> --}}
                            <td class="sub-heading text-center description-column">
                                <div style="max-height: 150px; overflow-y: auto; padding: 5px;">
                                    @if ($lowongan->deskripsi_pekerjaan)
                                        <span>{{ $lowongan->deskripsi_pekerjaan }}</span>
                                    @else
                                        <span class="text-muted">Tidak ada deskripsi</span>
                                    @endif
                                </div>
                            </td>
                            <td class="sub-heading text-center">{{ $lowongan->jenis_kontrak }}</td>
                            <td class="sub-heading text-center">{{ $lowongan->lokasi }}</td>
                            <td class="sub-heading text-center">{{ $lowongan->gaji }}</td>
                            <td class="sub-heading text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="form-check form-switch" style="margin-right: -8px">
                                        <input class="form-check-input custom-switch" type="checkbox" role="switch"
                                            {{ $lowongan->is_active ? 'checked' : '' }} disabled>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Tombol Create -->
                                    <form action="{{ route('add_daftar_lowongan_kerja_perusahaan') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-create rounded-pill px-4">Create</button>
                                    </form>
                                    <!-- Tombol Edit -->
                                    <form
                                        action="{{ route('edit_daftar_lowongan_kerja_perusahaan', $lowongan->id_lowongan) }}"
                                        method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-edit rounded-pill px-4">Edit</button>
                                    </form>
                                    {{-- <!-- Tombol Delete -->
                                    <form action="{{ route('delete_daftar_lowongan_kerja', $lowongan->id_lowongan) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-delete rounded-pill px-4 delete-btn">Delete</button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search No."></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Logo Perusahaan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Nama Kategori Pekerjaan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Nama Perusahaan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Alamat Perusahaan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Email Perusahaan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Nomor Telepon"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Deskripsi Pekerjaan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Jenis Kontrak"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Lokasi"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Gaji"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Status"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Action"></th>
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
                // Cek apakah DataTable sudah diinisialisasi
                if ($.fn.DataTable.isDataTable('#datatable')) {
                    // Jika sudah ada, hancurkan instance sebelumnya
                    $('#datatable').DataTable().destroy();
                }

                // Inisialisasi DataTable baru
                var table = $('#datatable').DataTable({
                    dom: 'Bfrtip',
                    paging: true,
                    searching: false,
                    ordering: true,
                    info: true,
                    lengthChange: false,
                    pageLength: 10,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search"
                    },
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                        {
                            extend: 'colvis',
                            text: 'Column visibility',
                            className: 'custom-colvis-btn'
                        }
                    ],
                    initComplete: function() {
                        this.api().columns().every(function() {
                            var column = this;
                            $('input', this.footer()).on('keyup change', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                        });
                    }
                });

                // Column visibility toggle
                $('.dropdown-item').on('click', function(e) {
                    e.preventDefault();
                    var columnIndex = $(this).data('column');
                    var column = table.column(columnIndex);
                    column.visible(!column.visible());
                });

                // Custom button styling
                $('.custom-colvis-btn').css({
                    'background-color': '#056CF2',
                    'border-color': '#056CF2',
                    'color': 'white'
                });

                // Hover effect
                $('.custom-colvis-btn').hover(
                    function() {
                        $(this).css('background-color', '#0458D8');
                    },
                    function() {
                        $(this).css('background-color', '#056CF2');
                    }
                );
            });
        </script>
    @endpush
@endsection
