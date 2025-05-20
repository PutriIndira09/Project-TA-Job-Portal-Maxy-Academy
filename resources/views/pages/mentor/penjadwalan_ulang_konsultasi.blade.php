@extends('partials.partials_mentor.layout')

@section('content')
    <div class="container-fluid p-4">

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

        <h2 class="heading-2">Daftar Penjadwalan Ulang</h2>
        <h2 class="heading-2-primary mb-4">Konsultasi Karir</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <ul class="dropdown-menu" aria-labelledby="columnVisibilityBtn">
                    <li><a class="dropdown-item" href="#" data-column="0">No.</a></li>
                    <li><a class="dropdown-item" href="#" data-column="1">Nama Maxians</a></li>
                    <li><a class="dropdown-item" href="#" data-column="2">Tanggal Lama</a></li>
                    <li><a class="dropdown-item" href="#" data-column="3">Jam Lama</a></li>
                    <li><a class="dropdown-item" href="#" data-column="4">Tanggal Baru</a></li>
                    <li><a class="dropdown-item" href="#" data-column="5">Jam Baru</a></li>
                    <li><a class="dropdown-item" href="#" data-column="6">Alasan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="7">Action</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Nama Maxians</th>
                        <th class="heading text-center fw-bold">Tanggal Lama</th>
                        <th class="heading text-center fw-bold">Jam Lama</th>
                        <th class="heading text-center fw-bold">Tanggal Baru</th>
                        <th class="heading text-center fw-bold">Jam Baru</th>
                        <th class="heading text-center fw-bold">Alasan</th>
                        <th class="heading text-center fw-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalKonsultasi as $index => $jadwal)
                        <tr>
                            <td class="sub-heading text-center">{{ $index + 1 }}</td>
                            <td class="sub-heading text-center">{{ $jadwal->maxians ?: '-' }}</td>
                            <td class="sub-heading text-center">
                                {{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') : '-' }}
                            </td>
                            <td class="sub-heading text-center">
                                {{ $jadwal->jam ? \Carbon\Carbon::parse($jadwal->jam)->format('H:i') . ' WIB' : '-' }}
                            </td>
                            <td class="sub-heading text-center">
                                {{ $jadwal->tanggal_baru ? \Carbon\Carbon::parse($jadwal->tanggal_baru)->translatedFormat('d F Y') : '-' }}
                            </td>
                            <td class="sub-heading text-center">
                                {{ $jadwal->jam_baru ? \Carbon\Carbon::parse($jadwal->jam_baru)->format('H:i') . ' WIB' : '-' }}
                            </td>
                            <td class="sub-heading text-center">{{ $jadwal->alasan ?: '-' }}</td>
                            <td class="sub-heading text-center">
                                <div class="d-flex flex-column justify-content-center gap-2">
                                    <a href="{{ route('edit_penjadwalan_ulang_konsultasi', $jadwal->id_jadwal_konsultasi) }}"
                                        class="btn btn-edit rounded-pill btn-sm px-2">Edit</a>
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
                                placeholder="Search Nama Maxians"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Tanggal Lama"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Jam Lama"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Tanggal Baru"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Jam Baru"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Alasan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Action"></th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
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
