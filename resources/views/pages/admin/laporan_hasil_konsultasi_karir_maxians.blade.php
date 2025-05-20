@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2">Daftar Laporan Hasil</h2>
        <h2 class="heading-2-primary mb-4">Konsultasi Karir Maxians</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Tanggal</th>
                        <th class="heading text-center fw-bold">Jam</th>
                        <th class="heading text-center fw-bold">Nama Mentor</th>
                        <th class="heading text-center fw-bold">Komentar</th>
                        <th class="heading text-center fw-bold">Bukti Konsultasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporanKonsultasi as $index => $laporan)
                        <tr>
                            <td class="sub-heading text-center">{{ $index + 1 }}</td>
                            <td class="sub-heading text-center">
                                {{ \Carbon\Carbon::parse($laporan->tanggal_konsultasi)->format('d M Y') }}
                            </td>
                            <td class="sub-heading text-center">
                                {{ \Carbon\Carbon::parse($laporan->jam_konsultasi)->format('H:i') }}
                            </td>
                            <td class="sub-heading text-center">{{ $laporan->nama_mentor }}</td>
                            <td class="sub-heading text-center">{{ $laporan->komentar }}</td>
                            <td class="text-center">
                                @if ($laporan->file_bukti_url)
                                    <img src="{{ $laporan->file_bukti_url }}" class="rounded-circle" width="50"
                                        height="50" alt="Bukti Konsultasi" style="cursor: pointer;"
                                        onclick="previewImage('{{ $laporan->file_bukti_url }}')">
                                @else
                                    <span>Tidak ada bukti</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
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
                                placeholder="Search Nama Mentor"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Komentar"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Bukti Konsultasi"></th>
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
                        order: [
                            [1, 'desc'],
                            [2, 'desc']
                        ], // Urutkan kolom Tanggal (1) dan Jam (2) descending
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
                }
            });
        </script>
    @endpush
@endsection
