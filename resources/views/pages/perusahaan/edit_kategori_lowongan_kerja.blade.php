@extends('partials.partials_perusahaan.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Edit Kategori Lowongan Kerja</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ isset($kategori) ? route('update_kategori_lowongan_kerja', $kategori->id_kategori) : route('store_kategori_lowongan_kerja') }}"
            method="POST">
            @csrf

            @if (isset($kategori))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori Pekerjaan <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control custom-border" id="nama_kategori" name="nama_kategori"
                    value="{{ old('nama_kategori', isset($kategori) ? $kategori->nama_kategori : '') }}" required>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tag Pekerjaan <small class="text-muted">(Maksimal 3
                        tag)</small></label>
                <div class="row">
                    @foreach ($availableTags as $tag)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]"
                                    id="tag{{ $tag->id_tag_pekerjaan }}" value="{{ $tag->id_tag_pekerjaan }}"
                                    {{ in_array($tag->id_tag_pekerjaan, old('tags', isset($kategori) ? $kategori->tags->pluck('id_tag_pekerjaan')->toArray() : [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tag{{ $tag->id_tag_pekerjaan }}">
                                    {{ $tag->nama_tag }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control custom-border" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', isset($kategori) ? $kategori->deskripsi : '') }}</textarea>
            </div>

            {{-- <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_kategori" class="heading text-center fw-bold mb-3">Nama Kategori</label>
                    @if (isset($kategori))
                        <input type="text" class="form-control custom-border" id="nama_kategori" name="nama_kategori"
                            value="{{ $kategori->nama_kategori }}" required>
                    @else
                </div>
                <div class="col-md-6 mb-3">
                    <label for="deskripsi" class="heading text-center fw-bold mb-3">Deskripsi</label>
                    <input type="text" class="form-control custom-border" id="deskripsi" name="deskripsi"
                        value="{{ $kategori->deskripsi }}" required>
                </div>
            </div> --}}

            {{-- <!-- Tag lowongan kerja -->
            <select class="form-control custom-border" id="tags" name="tags[]" multiple="multiple">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', $kategori->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                        #{{ $tag->nama_tag }}
                    </option>
                @endforeach
            </select> --}}

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-5">
                <button type="button" onclick="window.location.href='{{ route('kategori_lowongan_kerja') }}'"
                    class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Perbarui</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Maksimal 3 tag
                $('input[name="tags[]"]').on('change', function() {
                    var checkedCount = $('input[name="tags[]"]:checked').length;
                    if (checkedCount > 3) {
                        this.checked = false;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan!',
                            text: 'Maksimal 3 tag yang dapat dipilih!',
                        });
                    }
                });

                // Check jika semua tag sudah dipakai
                var allTagsUsed = false; // Gantilah sesuai logika Anda untuk mengecek apakah semua tag sudah digunakan
                if (allTagsUsed) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tag Sudah Terpakai',
                        text: 'Semua tag lowongan kerja sudah terpakai. Silahkan buat tag baru.',
                    });
                }
            });
        </script>
    @endpush
@endsection
