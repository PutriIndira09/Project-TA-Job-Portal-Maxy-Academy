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

        <h2 class="heading-2 mb-4">Kategori Lowongan Kerja</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <ul class="dropdown-menu" aria-labelledby="columnVisibilityBtn">
                    <li><a class="dropdown-item" href="#" data-column="0">No.</a></li>
                    <li><a class="dropdown-item" href="#" data-column="1">Nama Kategori Pekerjaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="2">Nama Tag Pekerjaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="3">Deskripsi Kategori Pekerjaan</a></li>
                    <li><a class="dropdown-item" href="#" data-column="4">Action</a></li>
                </ul>
            </div>
            {{-- <a href="{{ route('add_kategori_lowongan_kerja') }}" class="btn btn-create rounded-pill px-4">Tambah
                Kategori</a> --}}
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Nama Kategori Pekerjaan</th>
                        <th class="heading text-center fw-bold">Nama Tag Pekerjaan</th>
                        <th class="heading text-center fw-bold">Deskripsi Kategori Pekerjaan</th>
                        <th class="heading text-center fw-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($kategoris as $index => $kategori) --}}
                    @foreach ($kategoris as $kategori)
                        <tr>
                            {{-- <td class="sub-heading text-center">{{ $index + 1 }}</td> --}}
                            <td class="sub-heading text-center">{{ $loop->iteration }}</td>
                            <td class="sub-heading text-center">{{ $kategori->nama_kategori }}</td>
                            <td class="sub-heading text-center">
                                @if ($kategori->tags->count() > 0)
                                    @foreach ($kategori->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->nama_tag }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Tidak ada tag</span>
                                @endif
                            </td>
                            {{-- @if ($kategori->tags)
                                {{ $kategori->tags->nama_tag }}
                            @else
                            @endif --}}
                            <td class="sub-heading text-center description-column">
                                <div style="max-height: 150px; overflow-y: auto; padding: 5px;">
                                    {{ $kategori->deskripsi }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('add_kategori_lowongan_kerja') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-create rounded-pill px-4">Create</button>
                                    </form>
                                    <form action="{{ route('edit_kategori_lowongan_kerja', $kategori->id_kategori) }}"
                                        method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-edit rounded-pill px-4">Edit</button>
                                    </form>
                                    <form action="{{ route('delete_kategori_lowongan_kerja', $kategori->id_kategori) }}"
                                        method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn btn-delete rounded-pill px-4 delete-btn">Delete</button>
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
                                placeholder="Search Nama Kategori"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Nama Tag"></th>
                        <th><input type="text" class="form-control rounded-5 custom-border text-center"
                                placeholder="Search Deskripsi"></th>
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

                                // Skip column Action (column 3)
                                if (header.index() === 3) {
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

                // SweetAlert for delete confirmation
                $('.delete-btn').click(function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
