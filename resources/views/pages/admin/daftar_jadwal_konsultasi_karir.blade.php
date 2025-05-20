@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2">Daftar Jadwal</h2>
        <h2 class="heading-2-primary mb-4">Konsultasi Karir</h2>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered custom-border w-100 mt-3">
                <thead>
                    <tr>
                        <th class="heading text-center fw-bold">No.</th>
                        <th class="heading text-center fw-bold">Nama Mentor</th>
                        <th class="heading text-center fw-bold">Tanggal</th>
                        <th class="heading text-center fw-bold">Jam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalKonsultasi as $index => $jadwal)
                        <tr>
                            <td class="sub-heading text-center">{{ $index + 1 }}</td>
                            <td class="sub-heading text-center">{{ $jadwal->mentor }}</td>
                            <td class="sub-heading text-center">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="sub-heading text-center">{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                if (!$.fn.DataTable.isDataTable('#datatable')) {
                    $('#datatable').DataTable({
                        dom: 'Bfrtip',
                        paging: true,
                        searching: true,
                        ordering: true,
                        buttons: [
                            'copy',
                            'excel',
                            'pdf',
                            'colvis'
                        ]
                    });
                }
            });
        </script>
    @endpush
@endsection
