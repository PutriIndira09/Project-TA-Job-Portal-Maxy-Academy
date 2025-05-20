@extends('partials.partials_maxians.app')

@section('content')
    <div class="container-fluid mb-3">
        <div class="container-fluid">
            <h1 class="heading">
                <span class="text-dark">Apakah Kamu Sudah<br></span>
                <span class="text-primary">Melengkapi Dokumen?</span>
            </h1>

            <p class="sub-heading mt-3">
                Jika Sudah, Yuk Cek Berkas Anda<br>
            </p>

            @if ($dokumenLamaran->isEmpty())
                <div class="alert alert-info">Belum ada dokumen lamaran yang diunggah.</div>
            @else
                <!-- Wrapper untuk scroll horizontal -->
                <div style="overflow-x: auto;">
                    <table class="table table-striped-columns custom-border" style="min-width: 800px;">
                        <thead class="heading-5">
                            <tr>
                                <th>No</th>
                                <th>Akun Instagram</th>
                                <th>Akun LinkedIn</th>
                                <th>Preview CV</th>
                                <th>Preview Portofolio</th>
                                <th>Tanggal Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumenLamaran as $index => $dokumen)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dokumen->link_instagram }}</td>
                                    <td>{{ $dokumen->link_linkedin }}</td>
                                    <td>
                                        <embed src="{{ asset($dokumen->cv) }}" type="application/pdf" width="200"
                                            height="250" />
                                        <br>
                                        <a href="{{ asset($dokumen->cv) }}" target="_blank">Buka CV</a>
                                    </td>
                                    <td>
                                        <embed src="{{ asset($dokumen->portofolio) }}" type="application/pdf" width="200"
                                            height="250" />
                                        <br>
                                        <a href="{{ asset($dokumen->portofolio) }}" target="_blank">Buka Portofolio</a>
                                    </td>
                                    <td>{{ $dokumen->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
