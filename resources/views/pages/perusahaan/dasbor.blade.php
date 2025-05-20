@extends('partials.partials_perusahaan.layout')

@section('content')
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="heading-2 mb-0">Dasbor Perusahaan</h2>
            <div class="company-badge d-flex align-items-center bg-light rounded-pill px-4 py-2">
                {{-- <img src="{{ asset('images/triputra.png') }}" class="img-fluid rounded-circle me-3" style="width: 40px; height: 40px;" alt="Profile"> --}}
                {{-- <div>
                    <h5 class="heading-5 mb-0">PT. Triputra Group</h5>
                    <span class="text-muted small">Perusahaan</span>
                </div> --}}
            </div>
        </div>

        <div class="row">
            <!-- Summary Cards - Top Row -->
            <div class="col-md-12 mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="card border-0 rounded-4 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-users text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="heading-5 mb-0">Total Pelamar</h6>
                                    <h3 class="count mb-0">{{ $totalPelamar }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 rounded-4 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-warning-subtle bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-clock text-warning fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="heading-5 mb-0">Diproses</h6>
                                    <h3 class="count mb-0">{{ $totalPelamarDiproses }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 rounded-4 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-check-circle text-success fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="heading-5 mb-0">Diterima</h6>
                                    <h3 class="count mb-0">{{ $totalPelamarDiterima }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 rounded-4 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                                    <i class="fas fa-times-circle text-danger fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="heading-5 mb-0">Ditolak</h6>
                                    <h3 class="count mb-0">{{ $totalPelamarDitolak }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="col-md-8">
                <div class="card border-0 rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="heading-5 mb-0">Statistik Pelamar</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="pelamarChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="heading-5 mb-0">Status Pelamar</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center mb-4">
                            <div class="position-relative">
                                <canvas id="statusChart" height="200"></canvas>
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <h3 class="mb-0">{{ $totalPelamar }}</h3>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around mt-2">
                            <div class="text-center">
                                <div class="d-inline-block rounded-circle bg-warning p-2 mb-1" style="width: 15px; height: 15px;"></div>
                                <p class="mb-0 small">Diproses</p>
                            </div>
                            <div class="text-center">
                                <div class="d-inline-block rounded-circle bg-success p-2 mb-1" style="width: 15px; height: 15px;"></div>
                                <p class="mb-0 small">Diterima</p>
                            </div>
                            <div class="text-center">
                                <div class="d-inline-block rounded-circle bg-danger p-2 mb-1" style="width: 15px; height: 15px;"></div>
                                <p class="mb-0 small">Ditolak</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Section -->
            <div class="col-md-12">
                <div class="card border-0 rounded-4 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="heading-5 mb-0">Pelamar Per-Kategori</h5>
                    </div>
                    <div class="card-body">
                        @if ($pelamarPerKategori->isNotEmpty())
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-end">Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $totalApplicants = $pelamarPerKategori->sum('total');
                                                    $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#8AC249', '#EA5545'];
                                                @endphp
                                                
                                                @foreach ($pelamarPerKategori as $index => $kategori)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2" style="width: 12px; height: 12px; background-color: {{ $colors[$index % count($colors)] }}; border-radius: 50%;"></div>
                                                                {{ $kategori->kategori }}
                                                            </div>
                                                        </td>
                                                        <td class="text-center">{{ $kategori->total }}</td>
                                                        <td class="text-end">{{ round(($kategori->total / $totalApplicants) * 100, 1) }}%</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <canvas id="kategoriChart" height="300"></canvas>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center py-5">
                                <div class="text-center">
                                    <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada data pelamar per kategori</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Status Pie Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Diproses', 'Diterima', 'Ditolak'],
                    datasets: [{
                        data: [
                            {{ $totalPelamarDiproses }},
                            {{ $totalPelamarDiterima }},
                            {{ $totalPelamarDitolak }}
                        ],
                        backgroundColor: [
                            'rgba(255, 193, 7, 0.8)',  // warning
                            'rgba(40, 167, 69, 0.8)',  // success
                            'rgba(220, 53, 69, 0.8)'   // danger
                        ],
                        borderColor: [
                            'rgba(255, 193, 7, 1)',
                            'rgba(40, 167, 69, 1)',
                            'rgba(220, 53, 69, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            // Pelamar Chart (Bar)
            const pelamarCtx = document.getElementById('pelamarChart').getContext('2d');
            const pelamarChart = new Chart(pelamarCtx, {
                type: 'bar',
                data: {
                    labels: ['Diproses', 'Diterima', 'Ditolak'],
                    datasets: [{
                        label: 'Jumlah Pelamar',
                        data: [
                            {{ $totalPelamarDiproses }},
                            {{ $totalPelamarDiterima }},
                            {{ $totalPelamarDitolak }}
                        ],
                        backgroundColor: [
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 193, 7, 1)',
                            'rgba(40, 167, 69, 1)',
                            'rgba(220, 53, 69, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Kategori Chart
            const kategoriLabels = @json($pelamarPerKategori->pluck('kategori'));
            const kategoriData = @json($pelamarPerKategori->pluck('total'));
            const kategoriColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#8AC249', '#EA5545'];

            const kategoriCtx = document.getElementById('kategoriChart');
            if (kategoriCtx) {
                new Chart(kategoriCtx, {
                    type: 'doughnut',
                    data: {
                        labels: kategoriLabels,
                        datasets: [{
                            data: kategoriData,
                            backgroundColor: kategoriColors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    padding: 15
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush