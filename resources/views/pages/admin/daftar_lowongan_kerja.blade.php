@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Daftar Lowongan Kerja</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Column Visibility Dropdown -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <ul class="dropdown-menu" aria-labelledby="columnVisibilityBtn">
                    <li><a class="dropdown-item" href="#" data-column="0">No.</a></li>
                    <li><a class="dropdown-item" href="#" data-column="1">Logo Perusahaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="2">Kategori Pekerjaan</a></li>
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

        <!-- Table -->
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Logo Perusahaan</th>
                        <th class="heading text-center fw-bold">Kategori Pekerjaan</th>
                        <th class="heading text-center fw-bold">Nama Perusahaan</th>
                        <th class="heading text-center fw-bold">Alamat Perusahaan</th>
                        <th class="heading text-center fw-bold">Email Perusahaan</th>
                        <th class="heading text-center fw-bold">Nomor Telepon</th>
                        <th class="heading text-center fw-bold">Deskripsi Pekerjaan</th>
                        <th class="heading text-center fw-bold">Jenis Kontrak</th>
                        <th class="heading text-center fw-bold">Lokasi</th>
                        <th class="heading text-center fw-bold">Gaji</th>
                        <th class="heading text-center fw-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowongans as $lowongan)
                        <tr>
                            <td class="sub-heading text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($lowongan->logo_perusahaan)
                                    <img src="{{ asset($lowongan->logo_perusahaan) }}" class="rounded-circle" width="50"
                                        height="50" alt="Logo" style="cursor: pointer;"
                                        onclick="previewImage('{{ asset($lowongan->logo_perusahaan) }}')">
                                @else
                                    <span>Tidak ada bukti</span>
                                @endif
                            </td>
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
                            <td class="sub-heading text-center">Rp {{ number_format($lowongan->gaji, 0, ',', '.') }}</td>
                            <td class="sub-heading text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="form-check form-switch" style="margin-right: -8px">
                                        <input class="form-check-input custom-switch" type="checkbox" role="switch"
                                            {{ $lowongan->is_active ? 'checked' : '' }} disabled>
                                    </div>
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
                                placeholder="Search Kategori Pekerjaan"></th>
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
                                placeholder="Search Trakhir Jenis Kontrak"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Lokasi"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Gaji"></th>
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
                document.getElementById('previewImage').src = src;
                new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
            }

            $(document).ready(function() {
                // Check if DataTable is already initialized
                if (!$.fn.DataTable.isDataTable('#datatable')) {
                    // Initialize DataTable
                    var table = $('#datatable').DataTable({
                        dom: 'Bfrtip',
                        paging: true,
                        searching: false, // Disable the global search bar
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
                                className: 'custom-colvis-btn' // Custom class for styling
                            }
                        ],
                        initComplete: function() {
                            // Apply column-wise search
                            this.api().columns().every(function() {
                                var column = this;
                                var header = $(column.header());

                                // Skip column Action (column 2)
                                if (header.index() === 2) {
                                    return;
                                }

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

                    // Hover effect for the custom column visibility button
                    $('.custom-colvis-btn').hover(
                        function() {
                            $(this).css('background-color', '#0458D8');
                        },
                        function() {
                            $(this).css('background-color', '#056CF2');
                        }
                    );
                }
            });
        </script>
    @endpush
@endsection
