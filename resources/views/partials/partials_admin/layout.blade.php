<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Maxy Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, dashboard, admin, charts, datatable, colorlibhq" />
    <meta name="author" content="ColorlibHQ" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        crossorigin="anonymous" />

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        crossorigin="anonymous" />

    <!-- Maxy Academy CSS -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('partials.partials_admin.navbar')
        @include('partials.partials_admin.sidebar')

        <!-- Main Content -->
        <main class="app-main">
            @yield('content')
        </main>

        @include('partials.partials_admin.footer')
    </div>

    {{-- <!-- SweetAlert Error Message -->
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif --}}

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <!-- Plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- AdminLTE JS -->
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script>
        // resources/views/layouts/app.blade.php
        let inactivityTime = function() {
            let time;
            let warningTime = 5 * 60 * 1000; // 5 menit sebelum logout
            let warningShown = false;

            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;
            document.onclick = resetTimer;
            document.onscroll = resetTimer;
            document.ontouchstart = resetTimer;

            function showWarning() {
                warningShown = true;
                // Tampilkan modal atau notifikasi
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Anda akan logout otomatis dalam 5 menit karena tidak ada aktivitas.',
                    icon: 'warning',
                    timer: 30000, // 30 detik
                    showConfirmButton: true,
                    confirmButtonText: 'Tetap Login'
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetTimer();
                        warningShown = false;
                    }
                });
            }

            function logout() {
                window.location.href = '/logout-inactive';
            }

            function resetTimer() {
                clearTimeout(time);
                if (warningShown) {
                    Swal.close();
                    warningShown = false;
                }

                // Set timeout untuk peringatan
                setTimeout(showWarning, 25 * 60 * 1000); // Tampilkan peringatan setelah 25 menit

                // Set timeout untuk logout
                time = setTimeout(logout, 30 * 60 * 1000); // Logout setelah 30 menit
            }
        };
    </script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    'excel',
                    'pdf',
                    {
                        extend: 'colvis',
                        text: 'Column visibility',
                        className: 'custom-colvis-btn' // Class khusus untuk styling
                    }
                ],
                // Konfigurasi lainnya tetap sama
                paging: true,
                searching: false,
                ordering: true,
                info: true,
                lengthChange: false,
                pageLength: 10,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search"
                }
            });

            // Tambahkan style setelah inisialisasi
            $('.custom-colvis-btn').css({
                'background-color': '#056CF2',
                'border-color': '#056CF2',
                'color': 'white'
            });

            // Hover effect
            $('.custom-colvis-btn').hover(
                function() {
                    $(this).css('background-color', '#0458D8');
                },
                function() {
                    $(this).css('background-color', '#056CF2');
                }
            );
        });
    </script>

    <!-- Pastikan Bootstrap JS dan FontAwesome dimuat di halaman Anda -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Script tambahan jika diperlukan -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bootstrap 5 akan secara otomatis menutup dropdown saat klik di luar
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
            var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            })
        })
    </script>

    <!-- Inline Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Init sidebar scroll
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: 'os-theme-light',
                        autoHide: 'leave',
                        clickScroll: true
                    }
                });
            }

            // Sortable Cards
            document.querySelectorAll('.connectedSortable').forEach(el => {
                new Sortable(el, {
                    group: 'shared',
                    handle: '.card-header'
                });
            });

            // Dark Mode Toggle
            const toggleBtn = document.getElementById('toggle-dark-mode');
            const icon = document.getElementById('dark-mode-icon');

            if (localStorage.getItem('adminlte-theme') === 'dark') {
                document.body.classList.add('dark-mode');
                icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
            }

            toggleBtn?.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.classList.toggle('dark-mode');
                const isDark = document.body.classList.contains('dark-mode');
                icon.classList.toggle('bi-moon-fill', !isDark);
                icon.classList.toggle('bi-sun-fill', isDark);
                localStorage.setItem('adminlte-theme', isDark ? 'dark' : 'light');
            });

            // Gear Spin Animation
            const gearIcon = document.querySelector('.bi-gear');
            gearIcon?.addEventListener('click', function() {
                gearIcon.classList.add('spin');
                setTimeout(() => gearIcon.classList.remove('spin'), 1000);
            });
        });

        // ApexCharts Sample Chart
        const sales_chart = new ApexCharts(document.querySelector('#revenue-chart'), {
            series: [{
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            legend: {
                show: false
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: ['2023-01-01', '2023-02-01', '2023-03-01', '2023-04-01', '2023-05-01', '2023-06-01',
                    '2023-07-01'
                ]
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy'
                }
            }
        });
        sales_chart.render();

        // Vector Map
        new jsVectorMap({
            selector: '#world-map',
            map: 'world'
        });
    </script>

    @stack('scripts')
</body>

</html>
