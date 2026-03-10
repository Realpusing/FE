<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Arsip</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #fff3e0 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: radial-gradient(circle at 20% 80%, rgba(255, 152, 0, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(230, 81, 0, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        /* Main Content - Menyesuaikan sidebar */
        .main-content {
            margin-left: 260px; /* Default: sidebar terbuka */
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 2rem;
            min-height: 100vh;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px; /* Saat sidebar collapsed */
        }

        /* Header */
        .header-section {
            background: linear-gradient(135deg, #e65100 0%, #ff6f00 50%, #ff9800 100%);
            color: white;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .header-section::after {
            content: '';
            position: absolute;
            top: -50%; right: -10%;
            width: 300px; height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 4px;
            background: linear-gradient(90deg, var(--card-color-1), var(--card-color-2));
        }

        .stats-card.total { --card-color-1: #1976d2; --card-color-2: #42a5f5; }
        .stats-card.biasa { --card-color-1: #2e7d32; --card-color-2: #66bb6a; }
        .stats-card.rahasia { --card-color-1: #f57c00; --card-color-2: #ffb74d; }
        .stats-card.super-rahasia { --card-color-1: #c62828; --card-color-2: #ef5350; }

        .stats-icon {
            width: 70px; height: 70px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .stats-card.total .stats-icon { background: linear-gradient(135deg, #1976d2, #42a5f5); }
        .stats-card.biasa .stats-icon { background: linear-gradient(135deg, #2e7d32, #66bb6a); }
        .stats-card.rahasia .stats-icon { background: linear-gradient(135deg, #f57c00, #ffb74d); }
        .stats-card.super-rahasia .stats-icon { background: linear-gradient(135deg, #c62828, #ef5350); }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }

        .stats-label {
            font-size: 1rem;
            color: #666;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Chart Card */
        .chart-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 2rem;
            height: 420px;
            display: flex;
            flex-direction: column;
        }

        .chart-card h5 {
            color: #333;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e0e0e0;
        }

        .chart-card h5 i {
            color: #ff6f00;
            margin-right: 0.5rem;
        }

        .chart-wrapper {
            flex: 1;
            position: relative;
            width: 100%;
        }

        .chart-wrapper canvas {
            position: absolute;
            top: 0; left: 0;
            width: 100% !important;
            height: 100% !important;
        }

        /* Table */
        .table-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .table-scroll {
            max-height: 500px;
            overflow-y: auto;
        }

        .klasifikasi-table thead th {
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #003366;
            font-weight: 600;
            z-index: 2;
        }

        .kode-badge {
            background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }

        .count-badge {
            background: linear-gradient(135deg, #ff6f00 0%, #ff9800 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 0.5rem;
            height: 20px;
            width: 80%;
            margin: 0 auto;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 70px;
            }
            .chart-card { height: 380px; }
        }

        @media (max-width: 768px) {
            .main-content { padding: 1rem; }
            .stats-number { font-size: 2rem; }
            .stats-icon { width: 50px; height: 50px; font-size: 1.5rem; }
            .header-section { padding: 2rem 1rem; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR --->
    @include('sidebar')


    <!-- MAIN CONTENT -->
    <div class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Header -->
            <div class="header-section text-center">
                <h1 class="mb-2"><i class="bi bi-speedometer2"></i> Dashboard Sistem Arsip</h1>
                <p class="mb-0">Selamat Datang di Sistem Manajemen Arsip BASARNAS</p>
                <small class="d-block mt-2 opacity-75">Terakhir diperbarui: <span id="lastUpdate">-</span></small>
            </div>

            <!-- Error Alert -->
            <div id="errorAlert" class="alert alert-danger d-none">
                <h6><i class="bi bi-exclamation-triangle"></i> Error Memuat Data</h6>
                <p class="mb-0" id="errorMessage"></p>
                <button class="btn btn-sm btn-danger mt-2" onclick="loadDashboardData()">
                    <i class="bi bi-arrow-clockwise"></i> Coba Lagi
                </button>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stats-card total">
                        <div class="stats-icon"><i class="bi bi-archive-fill"></i></div>
                        <div class="stats-number" id="totalArsip"><div class="loading-skeleton"></div></div>
                        <div class="stats-label">Total Arsip</div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stats-card biasa">
                        <div class="stats-icon"><i class="bi bi-file-earmark"></i></div>
                        <div class="stats-number" id="totalBiasa"><div class="loading-skeleton"></div></div>
                        <div class="stats-label">Biasa</div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stats-card rahasia">
                        <div class="stats-icon"><i class="bi bi-file-lock"></i></div>
                        <div class="stats-number" id="totalRahasia"><div class="loading-skeleton"></div></div>
                        <div class="stats-label">Rahasia</div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stats-card super-rahasia">
                        <div class="stats-icon"><i class="bi bi-shield-lock-fill"></i></div>
                        <div class="stats-number" id="totalSuperRahasia"><div class="loading-skeleton"></div></div>
                        <div class="stats-label">Super Rahasia</div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4 mb-4">
                <div class="col-xl-6">
                    <div class="chart-card">
                        <h5><i class="bi bi-pie-chart-fill"></i> Distribusi Klasifikasi Keamanan</h5>
                        <div class="chart-wrapper">
                            <canvas id="keamananChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="chart-card">
                        <h5><i class="bi bi-bar-chart-fill"></i> Top 5 Kode Klasifikasi</h5>
                        <div class="chart-wrapper">
                            <canvas id="klasifikasiChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <div class="table-card">
                        <h5><i class="bi bi-table"></i> Data Arsip per Kode Klasifikasi</h5>
                        <div class="table-responsive">
                            <div class="table-scroll" id="klasifikasiTableScroll">
                                <table class="table klasifikasi-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th style="width: 15%">Kode</th>
                                            <th style="width: 50%">Detail Klasifikasi</th>
                                            <th style="width: 15%" class="text-center">Jumlah Arsip</th>
                                            <th style="width: 15%" class="text-center">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody id="klasifikasiTableBody">
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="loading-skeleton"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button id="toggleKlasifikasiBtn" class="btn btn-sm btn-outline-primary d-none" onclick="toggleKlasifikasiTable()">
                                    Tampilkan Semua
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Dashboard -->
    <script>
        const API_BASE_URL = 'http://192.168.100.178:8000/api';
        let keamananChart = null;
        let klasifikasiChart = null;
        let isLoading = false;
        let klasifikasiFullData = [];
        let klasifikasiExpanded = false;
        const PREVIEW_COUNT = 10;

        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw(chart) {
                if (chart.config.type !== 'doughnut') return;
                const { ctx, width, height } = chart;
                const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                if (!total) return;

                ctx.save();
                ctx.font = `bold ${width / 10}px "Segoe UI"`;
                ctx.fillStyle = '#333';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(total, width / 2, height / 2 - 10);

                ctx.font = `14px "Segoe UI"`;
                ctx.fillStyle = '#666';
                ctx.fillText('Total', width / 2, height / 2 + 15);
                ctx.restore();
            }
        };

        const dataLabelPlugin = {
            id: 'dataLabel',
            afterDatasetsDraw(chart) {
                const { ctx, data } = chart;
                chart.getDatasetMeta(0).data.forEach((bar, index) => {
                    const value = data.datasets[0].data[index];
                    if (value === 0) return;
                    ctx.save();
                    ctx.font = 'bold 12px "Segoe UI"';
                    ctx.fillStyle = '#333';
                    ctx.textAlign = 'center';
                    ctx.fillText(value, bar.x, bar.y - 10);
                    ctx.restore();
                });
            }
        };

        async function loadDashboardData() {
            if (isLoading) return;
            isLoading = true;

            try {
                const [statsResp, klasResp] = await Promise.all([
                    fetch(`${API_BASE_URL}/dashboard/stats`),
                    fetch(`${API_BASE_URL}/dashboard/klasifikasi`)
                ]);

                if (!statsResp.ok || !klasResp.ok) throw new Error('Gagal mengambil data dari server');

                const statsData = await statsResp.json();
                const klasData = await klasResp.json();

                updateStatistics(statsData.data);
                createKeamananChart(statsData.data.keamanan);
                createKlasifikasiChart(klasData.data);
                updateKlasifikasiTable(klasData.data);

                updateLastUpdateTime();
                document.getElementById('errorAlert').classList.add('d-none');
            } catch (err) {
                console.error(err);
                showError(err.message || 'Koneksi ke server gagal');
            } finally {
                isLoading = false;
            }
        }

        function updateStatistics(data) {
            document.getElementById('totalArsip').textContent = data.total || 0;
            document.getElementById('totalBiasa').textContent = data.keamanan?.biasa || 0;
            document.getElementById('totalRahasia').textContent = data.keamanan?.rahasia || 0;
            document.getElementById('totalSuperRahasia').textContent = data.keamanan?.super_rahasia || 0;
        }

        function createKeamananChart(data = {}) {
            const ctx = document.getElementById('keamananChart').getContext('2d');
            const values = [data.biasa || 0, data.rahasia || 0, data.super_rahasia || 0];
            const total = values.reduce((a,b) => a+b, 0);

            if (keamananChart) keamananChart.destroy();

            if (total === 0) {
                ctx.font = '16px "Segoe UI"';
                ctx.fillStyle = '#999';
                ctx.textAlign = 'center';
                ctx.fillText('Tidak ada data', ctx.canvas.width / 2, ctx.canvas.height / 2);
                return;
            }

            keamananChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Biasa', 'Rahasia', 'Super Rahasia'],
                    datasets: [{
                        data: values,
                        backgroundColor: ['#2e7d32', '#f57c00', '#c62828'],
                        hoverOffset: 15,
                        borderWidth: 3,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { padding: 20 } },
                        tooltip: {
                            callbacks: {
                                label: ctx => {
                                    const val = ctx.parsed;
                                    const pct = total ? ((val / total) * 100).toFixed(1) : 0;
                                    return `${ctx.label}: ${val} (${pct}%)`;
                                }
                            }
                        }
                    }
                },
                plugins: [centerTextPlugin]
            });
        }

        function createKlasifikasiChart(data = []) {
            const ctx = document.getElementById('klasifikasiChart').getContext('2d');
            if (klasifikasiChart) klasifikasiChart.destroy();

            if (!data.length) {
                ctx.font = '16px "Segoe UI"';
                ctx.fillStyle = '#999';
                ctx.textAlign = 'center';
                ctx.fillText('Tidak ada data', ctx.canvas.width / 2, ctx.canvas.height / 2);
                return;
            }

            const top5 = [...data].sort((a,b) => b.jumlah - a.jumlah).slice(0, 5);
            const labels = top5.map(i => i.kode);
            const values = top5.map(i => i.jumlah);

            klasifikasiChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: 'Jumlah',
                        data: values,
                        backgroundColor: 'rgba(255, 111, 0, 0.9)',
                        borderRadius: 8,
                        maxBarThickness: 60
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { stepSize: 1 } }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                afterLabel: ctx => top5[ctx.dataIndex].detail || ''
                            }
                        }
                    }
                },
                plugins: [dataLabelPlugin]
            });
        }

        function updateKlasifikasiTable(data) {
            klasifikasiFullData = [...data].sort((a,b) => b.jumlah - a.jumlah);
            renderTable();
        }

        function renderTable() {
            const tbody = document.getElementById('klasifikasiTableBody');
            const total = klasifikasiFullData.reduce((s,i) => s + i.jumlah, 0);
            const limit = klasifikasiExpanded ? klasifikasiFullData.length : Math.min(klasifikasiFullData.length, PREVIEW_COUNT);

            if (!klasifikasiFullData.length) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">Tidak ada data</td></tr>';
                return;
            }

            tbody.innerHTML = klasifikasiFullData.slice(0, limit).map((item, idx) => {
                const pct = total ? ((item.jumlah / total) * 100).toFixed(1) : 0;
                return `
                    <tr>
                        <td>${idx + 1}</td>
                        <td><span class="kode-badge">${item.kode}</span></td>
                        <td>${item.detail}</td>
                        <td class="text-center"><span class="count-badge">${item.jumlah}</span></td>
                        <td class="text-center">
                            <div class="progress" style="height:25px;">
                                <div class="progress-bar" style="width:${pct}%; background:linear-gradient(90deg,#ff6f00,#ff9800);">
                                    ${pct}%
                                </div>
                            </div>
                        </td>
                    </tr>`;
            }).join('');

            const btn = document.getElementById('toggleKlasifikasiBtn');
            if (klasifikasiFullData.length > PREVIEW_COUNT) {
                btn.classList.remove('d-none');
                btn.textContent = klasifikasiExpanded ? 'Tampilkan Lebih Sedikit' : `Tampilkan Semua (${klasifikasiFullData.length})`;
            } else {
                btn.classList.add('d-none');
            }
        }

        function toggleKlasifikasiTable() {
            klasifikasiExpanded = !klasifikasiExpanded;
            renderTable();
        }

        function updateLastUpdateTime() {
            const now = new Date().toLocaleString('id-ID', {
                day: 'numeric', month: 'long', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });
            document.getElementById('lastUpdate').textContent = now;
        }

        function showError(msg) {
            document.getElementById('errorMessage').textContent = msg;
            document.getElementById('errorAlert').classList.remove('d-none');
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadDashboardData();
            setInterval(loadDashboardData, 300000); // Refresh setiap 5 menit
        });

        // Toggle Sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }

        // Highlight menu aktif
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentPath || (currentPath === '/' && item.getAttribute('href') === '/dashboard')) {
                    item.classList.add('active');
                }
            });
        });
    </script>

    <!-- CSS Sidebar (di dalam file yang sama agar lengkap) -->
    <style>
        .sidebar.collapsed ~ .main-content,
        .main-content.sidebar-collapsed {
            margin-left: 70px;
        }
        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 2rem;
        }

        .menu-item.active {
            background: rgba(255, 111, 0, 0.2);
            color: white;
            font-weight: 500;
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #ff6f00, #ff9800);
        }

        .menu-item i {
            font-size: 1.3rem;
            min-width: 36px;
            text-align: center;
        }

        .menu-item span {
            margin-left: 1rem;
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.2s ease 0.1s;
        }



        .menu-separator {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 1.5rem 1.5rem;
            transition: margin 0.35s ease;
        }

        .sidebar.collapsed .menu-separator {
            margin: 1.5rem 1rem;
        }

        .text-danger { color: #ff5252 !important; }
        .text-danger:hover { background: rgba(244, 67, 54, 0.15) !important; }

        @media (max-width: 992px) {
            .sidebar { width: 70px; }
            .sidebar .sidebar-logo,
            .sidebar .sidebar-title,
            .sidebar .menu-item span {
                opacity: 0;
                pointer-events: none;
            }
            .sidebar .sidebar-toggle { opacity: 1; pointer-events: all; }
        }

        @media (max-width: 992px) {
            .sidebar:not(.collapsed) { width: 260px; }
            .sidebar:not(.collapsed) .sidebar-logo,
            .sidebar:not(.collapsed) .sidebar-title,
            .sidebar:not(.collapsed) .menu-item span {
                opacity: 1;
            }
        }
    </style>
</body>
</html>
