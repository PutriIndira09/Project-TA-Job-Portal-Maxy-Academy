@extends('partials.partials_perusahaan.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2">Daftar Dokumen Lamaran Kerja Maxians</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <ul class="dropdown-menu" aria-labelledby="columnVisibilityBtn">
                    <li><a class="dropdown-item" href="#" data-column="0">No.</a></li>
                    <li><a class="dropdown-item" href="#" data-column="1">Curriculum Vitae</a></li>
                    <li><a class="dropdown-item" href="#" data-column="2">Portofolio</a></li>
                    <li><a class="dropdown-item" href="#" data-column="3">Instagram</a></li>
                    <li><a class="dropdown-item" href="#" data-column="4">LinkedIn</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Curriculum Vitae</th>
                        <th class="heading text-center fw-bold">Portofolio</th>
                        <th class="heading text-center fw-bold">Instagram</th>
                        <th class="heading text-center fw-bold">LinkedIn</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($dokumenLamaran) && $dokumenLamaran->count())
                        @foreach ($dokumenLamaran as $key => $dokumen)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">
                                    @if ($dokumen->cv)
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ $dokumen->cv }}" class="btn btn-sm btn-info" title="Preview CV"
                                                target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    @else
                                        <span class="badge bg-warning">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($dokumen->portofolio)
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ $dokumen->portofolio }}" class="btn btn-sm btn-info"
                                                title="Preview Portofolio" target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    @else
                                        <span class="badge bg-warning">Tidak Ada</span>
                                    @endif
                                </td>
                                {{-- <td class="text-center">
                                    @if ($dokumen->cv)
                                        <a href="{{ route('dokumen.download.cv', $dokumen->id_dokumen) }}"
                                           class="floating-download-btn" title="Download CV">
                                            <i class="fas fa-file-pdf"></i>
                                            <span class="tooltip">Download CV</span>
                                        </a>
                                    @else
                                        <span class="badge bg-warning">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($dokumen->portofolio)
                                        <a href="{{ route('dokumen.download.portofolio', $dokumen->id_dokumen) }}"
                                           class="portofolio-download-btn" title="Download Portfolio">
                                            <i class="fas fa-file-archive"></i>
                                            <span class="tooltip">Download Portfolio</span>
                                        </a>
                                    @else
                                        <span class="badge bg-warning">Tidak Ada</span>
                                    @endif
                                </td> --}}
                                <td class="text-center">
                                    @if ($dokumen->link_instagram)
                                        <a href="{{ $dokumen->link_instagram }}" target="_blank"
                                            class="social-link instagram-link">
                                            <i class="fab fa-instagram"></i>
                                            <span>@<?php echo parse_url($dokumen->link_instagram, PHP_URL_PATH) ? str_replace('/', '', parse_url($dokumen->link_instagram, PHP_URL_PATH)) : 'instagram'; ?></span>
                                        </a>
                                    @else
                                        <span class="badge bg-warning">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($dokumen->link_linkedin)
                                        <a href="{{ $dokumen->link_linkedin }}" target="_blank"
                                            class="social-link linkedin-link">
                                            <i class="fab fa-linkedin"></i>
                                            <span>in/<?php echo parse_url($dokumen->link_linkedin, PHP_URL_PATH) ? str_replace('/', '', parse_url($dokumen->link_linkedin, PHP_URL_PATH)) : 'profile'; ?></span>
                                        </a>
                                    @else
                                        <span class="badge bg-warning">Tidak Ada</span>
                                    @endif
                                </td>
                                {{-- <td class="text-center">
                                    <span
                                        class="badge bg-{{ $dokumen->status == 'Diterima' ? 'success' : ($dokumen->status == 'Ditolak' ? 'danger' : ($dokumen->status == 'Tes' ? 'info' : 'warning')) }}">
                                        {{ $dokumen->status }}
                                    </span>
                                </td> --}}
                            </tr>

                            {{-- <!-- Modal untuk Update Status -->
                            <div class="modal fade" id="statusModal{{ $dokumen->id_dokumen }}" tabindex="-1"
                                aria-labelledby="statusModalLabel{{ $dokumen->id_dokumen }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="statusModalLabel{{ $dokumen->id_dokumen }}">
                                                Update Status Upload Dokumen Lamaran Maxians #{{ $dokumen->id_dokumen }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('dokumen.update.status', $dokumen->id_dokumen) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-select custom-border" name="status" id="status" required>
                                                        <option value="Diproses"
                                                            {{ $dokumen->status == 'Diproses' ? 'selected' : '' }}>Diproses
                                                        </option>
                                                        <option value="Diterima"
                                                            {{ $dokumen->status == 'Diterima' ? 'selected' : '' }}>Diterima
                                                        </option>
                                                        <option value="Ditolak"
                                                            {{ $dokumen->status == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                                        </option>
                                                        <option value="Tes"
                                                            {{ $dokumen->status == 'Tes' ? 'selected' : '' }}>Tes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-info">Tidak ada dokumen lamaran</div>
                            </td>
                        </tr>
                    @endif
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search No."></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Curriculum Vitae"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Portofolio"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Instagram"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search LinkedIn"></th>
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
                        searching: true,
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
                            // Apply column-wise search
                            this.api().columns().every(function() {
                                var column = this;
                                var header = $(column.header());
                                var footer = $(column.footer());

                                // Skip the action column for search filtering
                                if (header.index() === 6) { // Action column
                                    $(footer).find('input').attr('disabled', 'disabled');
                                    return;
                                }

                                $('input', footer).on('keyup change', function() {
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
                }
            });
        </script>
    @endpush
@endsection
