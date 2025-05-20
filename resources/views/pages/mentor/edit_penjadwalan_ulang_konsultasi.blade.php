@extends('partials.partials_mentor.layout')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="heading-2 mb-4">Edit Penjadwalan Ulang Konsultasi</h2>

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

        <form action="{{ route('update_penjadwalan_ulang_konsultasi', $jadwal->id_jadwal_konsultasi) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <!-- Nama Maxians -->
                    <div class="mb-3">
                        <label for="maxians" class="heading text-center fw-bold mb-3">Nama Maxians</label>
                        <input type="text" class="form-control custom-border" id="maxians" name="maxians"
                            value="{{ old('maxians', $jadwal->maxians) }}" placeholder="Masukkan nama Maxians">
                    </div>

                    <!-- Tanggal Lama (Display only) -->
                    <div class="mb-3">
                        <label class="heading text-center fw-bold mb-3">Tanggal Lama</label>
                        <div class="form-control custom-border bg-light">
                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}
                        </div>
                        <input type="hidden" name="tanggal" value="{{ $jadwal->tanggal }}">
                    </div>

                    <!-- Jam Lama (Display only) -->
                    <div class="mb-3">
                        <label class="heading text-center fw-bold mb-3">Jam Lama</label>
                        <div class="form-control custom-border bg-light">
                            {{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}
                        </div>
                        <input type="hidden" name="jam" value="{{ $jadwal->jam }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Tanggal Baru -->
                    <div class="mb-3">
                        <label for="tanggal_baru" class="heading text-center fw-bold mb-3">Tanggal Baru</label>
                        <input type="date" class="form-control custom-border" id="tanggal_baru" name="tanggal_baru"
                            value="{{ old('tanggal_baru', $jadwal->tanggal_baru) }}" required>
                    </div>

                    <!-- Jam Baru -->
                    <div class="mb-3">
                        <label for="jam_baru" class="heading text-center fw-bold mb-3">Jam Baru</label>
                        <input type="time" class="form-control custom-border" id="jam_baru" name="jam_baru"
                            value="{{ old('jam_baru', $jadwal->jam_baru) }}" required>
                    </div>
                </div>
            </div>

            <!-- Alasan -->
            <div class="mb-3">
                <label for="alasan" class="heading text-center fw-bold mb-3">Alasan Penjadwalan Ulang</label>
                <textarea class="form-control custom-border" id="alasan" name="alasan"
                    placeholder="Masukkan alasan penjadwalan ulang" rows="3" required>{{ old('alasan', $jadwal->alasan) }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" onclick="window.location.href='{{ route('penjadwalan_ulang_konsultasi') }}'" 
                        class="btn btn-back rounded-pill px-4">Kembali</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Perbarui</button>
            </div>
        </form>
    </div>
@endsection
