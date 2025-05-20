{{-- resources/views/pages/admin/edit_tag_lowongan_kerja.blade.php --}}
@extends('partials.partials_perusahaan.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Edit Tes Seleksi Pelamar</h2>

        <!-- Edit Form -->
        <form action="{{ route('update_tes_seleksi_pelamar', $tesSeleksi->id_tes) }}" method="POST">
            @csrf
            <div class="row">
                <!-- Name Input -->
                <div class="col-md-4 mb-5">
                    <label for="nama_tes" class="heading text-center fw-bold mb-3">Nama Tes Seleksi Pelamar</label>
                    <input type="text" class="form-control custom-border" id="nama_tes" name="nama_tes"
                        value="{{ $tesSeleksi->nama_tes }}" required> {{-- $tesSeleksi diambil dari compact(), compact() diambil dari @foreach tes_seleksi_pelamar.blade.php --}}
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <button type="button" onclick="window.location.href='{{ route('tes_seleksi_pelamar') }}'"
                    class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Perbarui</button>
            </div>
        </form>
    </div>
@endsection
