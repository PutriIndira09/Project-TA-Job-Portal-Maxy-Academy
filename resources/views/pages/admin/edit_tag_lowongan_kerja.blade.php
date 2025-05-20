{{-- resources/views/pages/admin/edit_tag_lowongan_kerja.blade.php --}}
@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Edit Tag Lowongan Kerja</h2>

        <!-- Edit Form -->
        <form action="{{ route('update_tag_lowongan_kerja', $tag->id_tag_pekerjaan) }}" method="POST">
            @csrf
            <div class="row">
                <!-- Name Input -->
                <div class="col-md-4 mb-5">
                    <label for="nama_tag" class="heading text-center fw-bold mb-3">Nama Tag Pekerjaan</label>
                    <input type="text" class="form-control custom-border" id="nama_tag" name="nama_tag"
                        value="{{ $tag->nama_tag }}" required>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <button type="button" onclick="window.location.href='{{ route('tag_lowongan_kerja') }}'"
                    class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Perbarui</button>
            </div>
        </form>
    </div>
@endsection
