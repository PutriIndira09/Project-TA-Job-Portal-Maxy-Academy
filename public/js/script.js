document.addEventListener('DOMContentLoaded', function () {
    const calendarContainer = document.getElementById('calendar');
    const calendarTitle = document.getElementById('calendar-title');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const consultationTime = document.getElementById('consultation-time');

    let currentDate = new Date();

    // Daftar bulan untuk dropdown
    const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    // Fungsi untuk merender kalender
    function renderCalendar() {
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();

        // Mengambil tanggal pertama dan terakhir bulan ini
        const firstDayOfMonth = new Date(year, month, 1);
        const lastDayOfMonth = new Date(year, month + 1, 0);

        // Set bulan dan tahun dengan styling yang diminta
        calendarTitle.textContent = `${months[month]} ${year}`;
        calendarTitle.classList.add('calendar-title');
        calendarTitle.style.fontFamily = "'Poppins', sans-serif";
        calendarTitle.style.fontWeight = "600"; // SemiBold
        calendarTitle.style.fontSize = "24px";
        calendarTitle.style.color = "#04198C";

        // Menyiapkan grid kalender
        calendarContainer.innerHTML = '';

        // Menambahkan hari sebelum tanggal pertama (untuk menyesuaikan posisi hari pertama)
        for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('calendar-day');
            calendarContainer.appendChild(emptyCell);
        }

        // Menambahkan hari-hari dalam bulan
        for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('calendar-day');
            dayCell.textContent = i;

            // Set disabled untuk tanggal yang sudah lewat
            const day = new Date(year, month, i);
            const today = new Date();
            if (day < today.setHours(0, 0, 0, 0)) {
                dayCell.classList.add('disabled');
            }

            // Menandai hari ini dengan kelas 'today'
            if (day.toDateString() === today.toDateString()) {
                dayCell.classList.add('today');
            }

            // Menambahkan event listener untuk memilih tanggal
            dayCell.addEventListener('click', function () {
                if (!dayCell.classList.contains('disabled')) {
                    dayCell.classList.toggle('selected');
                }
            });

            calendarContainer.appendChild(dayCell);
        }
    }

    // Fungsi untuk mengganti bulan
    prevMonthBtn.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    // Fungsi untuk menampilkan dropdown bulan dan tahun
    calendarTitle.addEventListener('click', function (event) {
        // Menghapus dropdown sebelumnya jika ada
        const existingDropdown = document.querySelector('.calendar-dropdown');
        if (existingDropdown) {
            existingDropdown.remove();
            return; // Tutup dropdown jika sudah ada
        }

        let dropdown = document.createElement('div');
        dropdown.classList.add('calendar-dropdown', 'show');
        dropdown.innerHTML = `
            <div class="dropdown-content">
                <div>
                    <label for="month-select">Pilih Bulan:</label>
                    <select id="month-select">
                        ${months.map((month, index) => `<option value="${index}">${month}</option>`).join('')}
                    </select>
                </div>
                <div>
                    <label for="year-select">Pilih Tahun:</label>
                    <select id="year-select">
                        ${Array.from({ length: 51 }, (_, i) => `<option value="${2000 + i}">${2000 + i}</option>`).join('')}
                    </select>
                </div>
                <div class="dropdown-actions">
                    <button id="apply-btn" class="btn btn-primary">Terapkan</button>
                    <button id="cancel-btn" class="btn btn-secondary">Batal</button>
                </div>
            </div>
        `;
        
        // Tambahkan dropdown ke judul kalender
        calendarTitle.appendChild(dropdown);

        // Pilih bulan dan tahun sesuai dengan tanggal saat ini
        const monthSelect = document.getElementById('month-select');
        const yearSelect = document.getElementById('year-select');
        monthSelect.value = currentDate.getMonth();
        yearSelect.value = currentDate.getFullYear();

        // Tombol Terapkan
        document.getElementById('apply-btn').addEventListener('click', function() {
            currentDate.setMonth(parseInt(monthSelect.value));
            currentDate.setFullYear(parseInt(yearSelect.value));
            renderCalendar();
            dropdown.remove();
        });

        // Tombol Batal
        document.getElementById('cancel-btn').addEventListener('click', function() {
            dropdown.remove();
        });

        // Cegah event click menyebar
        dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Tutup dropdown jika diklik di luar
        document.addEventListener('click', function closeDropdown(e) {
            if (!dropdown.contains(e.target) && e.target !== calendarTitle) {
                dropdown.remove();
                document.removeEventListener('click', closeDropdown);
            }
        });
    });

    // Inisialisasi kalender pertama kali
    renderCalendar();
});