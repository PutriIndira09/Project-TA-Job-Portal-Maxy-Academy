@extends('partials.partials_mentor.layout')

@section('content')
    <div class="container-fluid py-4 px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="heading-2 mb-0">Dasbor Mentor</h2>
            <div class="d-flex">
                <span class="badge bg-light text-dark me-2">
                    <i class="fas fa-calendar-alt me-1"></i> {{ now()->format('d F Y') }}
                </span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column - Profile and Stats -->
            <div class="col-lg-3">
                <!-- Request Summary Card -->
                <div class="card mb-4 rounded-4 border-0 shadow-sm h-100">
                    <div class="card-header bg-warning text-dark py-3 px-4 rounded-top-4">
                        <h5 class="heading-5 mb-0 d-flex align-items-center">
                            <i class="fas fa-chart-pie me-2"></i> Ringkasan Permintaan
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr class="border-bottom">
                                        <td class="text-start py-3 ps-4">Total Permintaan</td>
                                        <td class="text-end fw-bold py-3 pe-4">{{ $totalPermintaanJadwal }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="text-start py-3 ps-4">Diproses</td>
                                        <td class="text-end fw-bold py-3 pe-4">{{ $totalDiproses }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="text-start py-3 ps-4">Disetujui</td>
                                        <td class="text-end fw-bold py-3 pe-4">{{ $totalDisetujui }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3 ps-4">Reschedule</td>
                                        <td class="text-end fw-bold py-3 pe-4">{{ $totalReschedule }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light rounded-bottom-4 py-2">
                        <small class="text-muted">Terakhir diperbarui: {{ now()->format('H:i') }}</small>
                    </div>
                </div>
            </div>

            <!-- Right Column - Schedule and Charts -->
            <div class="col-lg-9">
                <!-- Upcoming Schedule Card -->
                <div class="card rounded-4 border-0 shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark p-3 rounded-top-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="heading-4 mb-0">
                                <i class="fas fa-calendar-check me-2"></i> Jadwal Konsultasi Terdekat
                            </h4>
                            <span class="badge bg-white text-dark">{{ count($jadwalKonsultasiTerdekat) }} Jadwal</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if (count($jadwalKonsultasiTerdekat) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Topik</th>
                                            <th class="pe-4">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalKonsultasiTerdekat as $jadwal)
                                            <tr>
                                                <td class="ps-4">
                                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB</td>
                                                <td>{{ Str::limit($jadwal->topik ?? 'Tidak disebutkan', 20) }}</td>
                                                <td class="pe-4">
                                                    <span
                                                        class="badge bg-{{ $jadwal->status == 'Disetujui' ? 'success' : ($jadwal->status == 'Diproses' ? 'warning' : 'danger') }}">
                                                        {{ $jadwal->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <img src="{{ asset('images/empty-state.svg') }}" alt="Empty state" class="img-fluid mb-3"
                                    style="max-width: 200px;">
                                <p class="text-muted mb-0">Tidak ada jadwal konsultasi yang akan datang</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Activity Statistics Card -->
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-header bg-warning text-dark p-3 rounded-top-4">
                        <h4 class="heading-4 mb-0">
                            <i class="fas fa-chart-line me-2"></i> Statistik Aktivitas Konsultasi
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div style="height: 300px;">
                            <canvas id="aktivitasChart"></canvas>
                        </div>
                    </div>
                    <div class="card-footer bg-light rounded-bottom-4 py-2 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Data diperbarui setiap hari</small>
                            <a href="#" class="btn btn-sm btn-outline-dark">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Activity Chart
            var ctx = document.getElementById('aktivitasChart').getContext('2d');
            var aktivitasChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($bulanLabels) !!},
                    datasets: [{
                        label: 'Jumlah Aktivitas Konsultasi',
                        data: {!! json_encode($aktivitasData) !!},
                        fill: true,
                        backgroundColor: 'rgba(255, 193, 7, 0.2)',
                        borderColor: 'rgba(255, 193, 7, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 193, 7, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(255, 193, 7, 1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + ' aktivitas';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah Aktivitas',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
