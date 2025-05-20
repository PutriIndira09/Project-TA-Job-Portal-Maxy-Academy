@extends('partials.partials_admin.layout')

@section('content')
    <div class="container-fluid py-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="heading-2 mb-0 fw-bold">Dasbor Company Relationship</h2>
            <div class="dropdown">
                <button class="btn btn-light rounded-pill px-4 py-2 d-flex align-items-center shadow-sm" type="button"
                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2" id="selectedFilter">{{ $timeFilter ?? 'Hari Ini' }}</span>
                    <i class="fas fa-chevron-down small"></i>
                </button>
                <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="{{ route('dasbor_admin', ['timeFilter' => 'daily']) }}">Hari Ini</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('dasbor_admin', ['timeFilter' => 'weekly']) }}">Minggu
                            Ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('dasbor_admin', ['timeFilter' => 'monthly']) }}">Bulan
                            Ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('dasbor_admin', ['timeFilter' => 'yearly']) }}">Tahun
                            Ini</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#customDateModal">Kustom Tanggal</a></li>
                </ul>
            </div>
        </div>

        <!-- Custom Date Modal -->
        <div class="modal fade" id="customDateModal" tabindex="-1" aria-labelledby="customDateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="customDateModalLabel">Pilih Rentang Tanggal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dasbor_admin') }}" method="GET" id="customDateForm">
                            <div class="mb-3">
                                <label for="startDate" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control rounded-3" id="startDate" name="startDate"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="endDate" class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control rounded-3" id="endDate" name="endDate" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary rounded-3">Terapkan Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert untuk menampilkan info filter yang sedang aktif -->
        @if (isset($timeFilter) || (isset($startDate) && isset($endDate)))
            <div class="alert alert-info alert-dismissible fade show rounded-3 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        Data yang ditampilkan untuk periode:
                        <strong>
                            @if (isset($startDate) && isset($endDate))
                                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                            @elseif($timeFilter == 'daily')
                                Hari Ini ({{ \Carbon\Carbon::now()->format('d M Y') }})
                            @elseif($timeFilter == 'weekly')
                                Minggu Ini ({{ \Carbon\Carbon::now()->startOfWeek()->format('d M') }} -
                                {{ \Carbon\Carbon::now()->endOfWeek()->format('d M Y') }})
                            @elseif($timeFilter == 'monthly')
                                Bulan Ini ({{ \Carbon\Carbon::now()->format('M Y') }})
                            @elseif($timeFilter == 'yearly')
                                Tahun Ini ({{ \Carbon\Carbon::now()->format('Y') }})
                            @else
                                Semua Waktu
                            @endif
                        </strong>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Summary Cards Section -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-users text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="heading-5 mb-0">Maxians</h6>
                            <h3 class="count mb-0">{{ $totalActiveMaxians }}</h3>
                            <small
                                class="text-{{ $maxiansTrend > 0 ? 'success' : ($maxiansTrend < 0 ? 'danger' : 'muted') }}">
                                <i
                                    class="fas fa-{{ $maxiansTrend > 0 ? 'arrow-up' : ($maxiansTrend < 0 ? 'arrow-down' : 'minus') }}"></i>
                                {{ abs($maxiansTrend) }}% dari periode sebelumnya
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-chalkboard-teacher text-success fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="heading-5 mb-0">Mentor</h6>
                            <h3 class="count mb-0">{{ $totalMentors }}</h3>
                            <small
                                class="text-{{ $mentorsTrend > 0 ? 'success' : ($mentorsTrend < 0 ? 'danger' : 'muted') }}">
                                <i
                                    class="fas fa-{{ $mentorsTrend > 0 ? 'arrow-up' : ($mentorsTrend < 0 ? 'arrow-down' : 'minus') }}"></i>
                                {{ abs($mentorsTrend) }}% dari periode sebelumnya
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-building text-info fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="heading-5 mb-0">Perusahaan</h6>
                            <h3 class="count mb-0">{{ $totalPerusahaan }}</h3>
                            <small
                                class="text-{{ $perusahaanTrend > 0 ? 'success' : ($perusahaanTrend < 0 ? 'danger' : 'muted') }}">
                                <i
                                    class="fas fa-{{ $perusahaanTrend > 0 ? 'arrow-up' : ($perusahaanTrend < 0 ? 'arrow-down' : 'minus') }}"></i>
                                {{ abs($perusahaanTrend) }}% dari periode sebelumnya
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 rounded-4 shadow-sm h-100 transition-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-75 p-3 me-3">
                            <i class="fas fa-file-alt text-light fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="heading-5 mb-0">Lamaran</h6>
                            <h3 class="count mb-0">{{ $totalLamaran }}</h3>
                            <small
                                class="text-{{ $lamaranTrend > 0 ? 'success' : ($lamaranTrend < 0 ? 'danger' : 'muted') }}">
                                <i
                                    class="fas fa-{{ $lamaranTrend > 0 ? 'arrow-up' : ($lamaranTrend < 0 ? 'arrow-down' : 'minus') }}"></i>
                                {{ abs($lamaranTrend) }}% dari periode sebelumnya
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4">
            <!-- User Status Chart -->
            <div class="col-md-8">
                <div class="card border-0 rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="heading-5 mb-0 fw-bold">Statistik Status Pengguna</h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    onclick="toggleChartType('userStatusChart', 'bar')">Bar</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    onclick="toggleChartType('userStatusChart', 'line')">Line</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <canvas id="userStatusChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Job Status Chart -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                        <h5 class="heading-5 mb-0 fw-bold">Lowongan Kerja</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-column align-items-center mb-4">
                            <div class="position-relative">
                                <canvas id="jobStatusChart" height="220"></canvas>
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <h3 class="mb-0 fw-bold">{{ $totalLowonganAktif + $totalLowonganNonAktif }}</h3>
                                    <small class="text-muted">Total Lowongan</small>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around mt-3">
                            <div class="text-center">
                                <div class="d-inline-block rounded-circle bg-success p-2 mb-1"
                                    style="width: 15px; height: 15px;"></div>
                                <p class="mb-0 small">Aktif ({{ $totalLowonganAktif }})</p>
                            </div>
                            <div class="text-center">
                                <div class="d-inline-block rounded-circle bg-secondary p-2 mb-1"
                                    style="width: 15px; height: 15px;"></div>
                                <p class="mb-0 small">Tidak Aktif ({{ $totalLowonganNonAktif }})</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Consultation Chart -->
            <div class="col-md-8">
                <div class="card border-0 rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                        <h5 class="heading-5 mb-0 fw-bold">Konsultasi Karir</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-7">
                                <canvas id="consultationChart" height="250"></canvas>
                            </div>
                            <div class="col-md-5 d-flex align-items-center justify-content-center">
                                <div class="text-center p-3 w-100">
                                    <h6 class="mb-4 fw-bold">Status Jadwal Konsultasi</h6>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Mendatang</span>
                                            <span class="fw-bold">{{ $jadwalMendatang }}</span>
                                        </div>
                                        <div class="progress rounded-pill mb-3" style="height: 10px;">
                                            <div class="progress-bar bg-info rounded-pill"
                                                style="width: {{ ($jadwalMendatang / max($totalJadwalKonsultasi, 1)) * 100 }}%">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Berlalu</span>
                                            <span class="fw-bold">{{ $jadwalBerlalu }}</span>
                                        </div>
                                        <div class="progress rounded-pill" style="height: 10px;">
                                            <div class="progress-bar bg-secondary rounded-pill"
                                                style="width: {{ ($jadwalBerlalu / max($totalJadwalKonsultasi, 1)) * 100 }}%">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2">
                                        <h2 class="mb-0 fw-bold">{{ $totalJadwalKonsultasi }}</h2>
                                        <small class="text-muted">Total Konsultasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Feed -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                        <h5 class="heading-5 mb-0 fw-bold text-center">Konsultasi Karir</h5>
                    </div>
                    <div class="card-header bg-white border-0 pt-2 pb-2 mt-3 px-3 d-flex flex-column align-items-center"
                        style="height: 65px; padding-bottom: 0;">
                        <h3 class="count mb-0 mt-1" style="font-size: 60px; font-weight: bold;">
                            {{ $totalAkun }}</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="list-group list-group-flush">
                            @foreach ($latestActivities as $activity)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="rounded-circle 
                                        @if ($activity['type'] == 'company') bg-primary bg-opacity-10
                                        @elseif($activity['type'] == 'job')
                                            bg-success bg-opacity-10
                                        @elseif($activity['type'] == 'consultation')
                                            bg-info bg-opacity-10 @endif
                                        p-2 me-3">
                                            <i
                                                class="fas 
                                            @if ($activity['type'] == 'company') fa-building text-primary
                                            @elseif($activity['type'] == 'job')
                                                fa-briefcase text-success
                                            @elseif($activity['type'] == 'consultation')
                                                fa-calendar-check text-info @endif"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 small">{{ $activity['message'] }}</p>
                                            <small class="text-muted">{{ $activity['time'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if (count($latestActivities) == 0)
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted mb-2 fa-2x"></i>
                                    <p class="mb-0 text-muted small">Tidak ada aktivitas terbaru</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .transition-hover {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .count {
            font-weight: 700;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Store chart instances globally to be able to update them
            let charts = {};

            // Job Status Doughnut Chart
            const jobStatusCtx = document.getElementById('jobStatusChart').getContext('2d');
            charts.jobStatus = new Chart(jobStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Aktif', 'Tidak Aktif'],
                    datasets: [{
                        data: [
                            {{ $totalLowonganAktif }},
                            {{ $totalLowonganNonAktif }}
                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)', // success for active
                            'rgba(108, 117, 125, 0.8)' // secondary for inactive
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(108, 117, 125, 1)'
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

            // User Status Chart
            const userStatusCtx = document.getElementById('userStatusChart').getContext('2d');
            charts.userStatus = new Chart(userStatusCtx, {
                type: 'bar',
                data: {
                    labels: ['Maxians', 'Mentor', 'Perusahaan', 'Lamaran'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [
                            {{ $totalActiveMaxians }},
                            {{ $totalMentors }},
                            {{ $totalPerusahaan }},
                            {{ $totalLamaran }}
                        ],
                        backgroundColor: [
                            'rgba(13, 110, 253, 0.8)', // primary
                            'rgba(40, 167, 69, 0.8)', // success
                            'rgba(23, 162, 184, 0.8)', // info
                            'rgba(255, 193, 7, 0.8)' // warning
                        ],
                        borderColor: [
                            'rgba(13, 110, 253, 1)',
                            'rgba(40, 167, 69, 1)',
                            'rgba(23, 162, 184, 1)',
                            'rgba(255, 193, 7, 1)'
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
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
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

            // Consultation Chart
            const consultationCtx = document.getElementById('consultationChart').getContext('2d');
            charts.consultation = new Chart(consultationCtx, {
                type: 'pie',
                data: {
                    labels: ['Mendatang', 'Berlalu'],
                    datasets: [{
                        data: [
                            {{ $jadwalMendatang }},
                            {{ $jadwalBerlalu }}
                        ],
                        backgroundColor: [
                            'rgba(23, 162, 184, 0.8)', // info
                            'rgba(108, 117, 125, 0.8)' // secondary
                        ],
                        borderColor: [
                            'rgba(23, 162, 184, 1)',
                            'rgba(108, 117, 125, 1)'
                        ],
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

            // Animasi counter untuk angka pada cards
            const counters = document.querySelectorAll('.count');
            counters.forEach(counter => {
                const target = parseInt(counter.innerText);
                let count = 0;
                const speed = Math.ceil(target / 30); // Sesuaikan kecepatan

                const updateCount = () => {
                    if (count < target) {
                        count += speed;
                        if (count > target) count = target;
                        counter.innerText = count;
                        setTimeout(updateCount, 30);
                    }
                };

                updateCount();
            });

            // Validasi form tanggal kustom
            const customDateForm = document.getElementById('customDateForm');
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');

            customDateForm.addEventListener('submit', function(event) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                if (endDate < startDate) {
                    event.preventDefault();
                    alert('Tanggal akhir tidak boleh lebih awal dari tanggal mulai!');
                }
            });

            // Set default tanggal kustom ke hari ini
            const today = new Date().toISOString().slice(0, 10);
            startDateInput.value = today;
            endDateInput.value = today;

            // Function to toggle chart type
            window.toggleChartType = function(chartId, newType) {
                const chart = charts[chartId.replace('Chart', '')];
                if (chart && chart.config.type !== newType) {
                    chart.config.type = newType;

                    // For line chart, we need to add tension
                    if (newType === 'line') {
                        chart.data.datasets.forEach(dataset => {
                            dataset.tension = 0.4;
                            dataset.fill = true;
                        });
                    } else {
                        // For bar chart, remove line specific properties
                        chart.data.datasets.forEach(dataset => {
                            delete dataset.tension;
                            delete dataset.fill;
                        });
                    }

                    chart.update();
                }
            };
        });
    </script>
@endpush
