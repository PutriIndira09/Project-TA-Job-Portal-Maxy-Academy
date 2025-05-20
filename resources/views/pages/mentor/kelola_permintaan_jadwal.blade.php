@extends('partials.partials_mentor.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2">Daftar Permintaan Jadwal</h2>
        <h2 class="heading-2-primary mb-4">Konsultasi Karir dari Maxians</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <ul class="dropdown-menu" aria-labelledby="columnVisibilityBtn">
                    <li><a class="dropdown-item" href="#" data-column="0">No.</a></li>
                    <li><a class="dropdown-item" href="#" data-column="1">Nama Maxians</a></li>
                    <li><a class="dropdown-item" href="#" data-column="2">Tanggal</a></li>
                    {{-- <li><a class="dropdown-item" href="#" data-column="3">Jam</a></li> --}}
                    <li><a class="dropdown-item" href="#" data-column="3">Pertanyaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="4">Status</a></li>
                    <li><a class="dropdown-item" href="#" data-column="4">Action</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Nama Maxians</th>
                        <th class="heading text-center fw-bold">Tanggal</th>
                        {{-- <th class="heading text-center fw-bold">Jam</th> --}}
                        <th class="heading text-center fw-bold">Pertanyaan</th>
                        <th class="heading text-center fw-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaanJadwal as $index => $jadwal)
                        <tr>
                            <td class="sub-heading text-center">{{ $index + 1 }}</td>
                            <td class="sub-heading text-center">{{ $jadwal->maxians }}</td>
                            <td class="sub-heading text-center">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="sub-heading text-center">{{ $jadwal->pertanyaan }}</td>
                            <td class="sub-heading text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Form untuk status Diproses -->
                                    <form
                                        action="{{ route('update_status_permintaaan_jadwal_konsultasi_karir', $jadwal->id_jadwal_konsultasi) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="status" value="diproses"
                                            class="btn btn-edit rounded-pill px-4 status-btn"
                                            {{ $jadwal->status == 'diproses' ? 'disabled' : '' }}>Diproses</button>
                                    </form>
                                    <!-- Form untuk status Disetujui -->
                                    <form
                                        action="{{ route('update_status_permintaaan_jadwal_konsultasi_karir', $jadwal->id_jadwal_konsultasi) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="status" value="disetujui"
                                            class="btn btn-delete rounded-pill px-4 status-btn"
                                            {{ $jadwal->status == 'disetujui' ? 'disabled' : '' }}>Disetujui</button>
                                    </form>
                                    <!-- Form untuk status Reschedule -->
                                    <form
                                        action="{{ route('update_status_permintaaan_jadwal_konsultasi_karir', $jadwal->id_jadwal_konsultasi) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="status" value="reschedule"
                                            class="btn btn-edit rounded-pill px-4 status-btn"
                                            {{ $jadwal->status == 'reschedule' ? 'disabled' : '' }}>Reschedule</button>
                                    </form>
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
                                placeholder="Search Tanggal"></th>
                        {{-- <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Jam"></th> --}}
                        {{-- <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Pertanyaan"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Status"></th>
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
