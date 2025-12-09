<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Arsip</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 80%, rgba(255, 152, 0, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(230, 81, 0, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #1a237e 0%, #283593 50%, #3f51b5 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-logo i {
            font-size: 1.5rem;
            color: #1a237e;
        }

        .sidebar.collapsed .sidebar-logo {
            width: 40px;
            height: 40px;
        }

        .sidebar-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-title {
            font-size: 0;
            opacity: 0;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 2rem;
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-left: 4px solid #ff9800;
        }

        .menu-item i {
            font-size: 1.3rem;
            margin-right: 1rem;
            min-width: 24px;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .menu-item i {
            margin-right: 0;
        }

        .menu-item span {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .menu-item span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .menu-separator {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 1rem 1.5rem;
        }

        .sidebar-toggle {
            position: absolute;
            top: 1.5rem;
            right: -15px;
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .sidebar-toggle:hover {
            background: #ff9800;
            color: white;
            transform: scale(1.1);
        }

        .sidebar-toggle i {
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            transition: all 0.3s ease;
            padding: 2rem;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .header-section {
            background: linear-gradient(135deg, #e65100 0%, #ff6f00 50%, #ff9800 100%);
            color: white;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            animation: slideInDown 1s ease-out;
        }

        @keyframes slideInDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .header-section::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.05) 10px,
                rgba(255, 255, 255, 0.05) 20px
            );
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .header-section h1 {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1.2s ease-out 0.5s both;
        }

        .header-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            animation: fadeInUp 1.2s ease-out 0.7s both;
        }

        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .table thead {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #003366;
            font-weight: 600;
        }

        .table thead th {
            border: none;
            padding: 1rem;
            position: relative;
        }

        .table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #003366;
            transition: width 0.3s ease, left 0.3s ease;
        }

        .table thead th:hover::after {
            width: 100%;
            left: 0;
        }

        .badge-biasa {
            background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
            color: #2e7d32;
            border-radius: 1rem;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge-rahasia {
            background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%);
            color: #f57c00;
            border-radius: 1rem;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge-super-rahasia {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #c62828;
            border-radius: 1rem;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .kode-klasifikasi .kode {
            font-weight: 700;
            color: #003366;
            transition: color 0.3s ease;
        }

        .kode-klasifikasi:hover .kode {
            color: #0056a0;
        }

        .kode-klasifikasi .detail {
            font-size: 0.875rem;
            color: #666;
            font-style: italic;
        }

        .item-arsip-container {
            border: 1px solid #ddd;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .item-arsip-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            border-color: #007bff;
        }

        .item-arsip-header {
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #003366;
            position: relative;
        }

        .item-arsip-header::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 3px;
            background: #007bff;
            transition: width 0.5s ease;
        }

        .item-arsip-container:hover .item-arsip-header::before {
            width: 100%;
        }

        .inherited-info {
            background: linear-gradient(135deg, #f1f8ff 0%, #e3f2fd 100%);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #007bff;
        }

        .inherited-info .inherited-value {
            color: #003366;
            font-weight: 700;
        }

        #arsipTable tbody tr {
            transition: all 0.3s ease;
        }

        #arsipTable tbody tr:hover {
            background: linear-gradient(135deg, #f1f8ff 0%, #e3f2fd 100%);
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn {
            border-radius: 2rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transition: width 0.6s, height 0.6s;
            transform: translate(-50%, -50%);
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-content {
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalBounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: none;
        }

        @keyframes modalBounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            transform: scale(1.02);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar.collapsed {
                width: 0;
            }

            .main-content {
                margin-left: 70px;
            }

            .main-content.expanded {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="bi bi-chevron-left"></i>
        </div>

        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="bi bi-archive-fill"></i>
            </div>
            <h5 class="sidebar-title">Sistem Arsip</h5>
        </div>

        <div class="sidebar-menu">
            <a href="#" class="menu-item active" onclick="navigateTo('dashboard')">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="menu-item" onclick="navigateTo('arsip')">
                <i class="bi bi-folder2-open"></i>
                <span>Data Arsip</span>
            </a>
            <a href="#" class="menu-item" onclick="navigateTo('klasifikasi')">
                <i class="bi bi-tags"></i>
                <span>Klasifikasi</span>
            </a>
            <a href="#" class="menu-item" onclick="navigateTo('laporan')">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Laporan</span>
            </a>

            <div class="menu-separator"></div>

            <a href="#" class="menu-item" onclick="navigateTo('pengaturan')">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
            <a href="#" class="menu-item" onclick="navigateTo('bantuan')">
                <i class="bi bi-question-circle"></i>
                <span>Bantuan</span>
            </a>
            <a href="#" class="menu-item" onclick="navigateTo('logout')">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Header -->
            <div class="header-section text-center shadow-sm">
                <h1 class="mb-2"><i class="bi bi-folder2-open"></i> Sistem Manajemen Arsip</h1>
                <p class="mb-0">Daftar Berkas dan Item Arsip</p>
            </div>

            <!-- Action Bar -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <button class="btn btn-secondary" onclick="tambahData()">
                                <i class="bi bi-plus-circle"></i> Tambah Data
                            </button>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="btn-group" role="group">
                                <button class="btn btn-success" onclick="exportExcel()">
                                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                                </button>
                                <button class="btn btn-danger" onclick="exportPDF()">
                                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="arsipTable" class="table table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Arsip</th>
                                    <th>Judul Berkas</th>
                                    <th>Nomor</th>
                                    <th>Kode Klasifikasi</th>
                                    <th>Uraian Informasi</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Keamanan</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="modalTambahLabel">
                        <i class="bi bi-plus-circle"></i> Tambah Data Arsip
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahArsip">
                        <!-- Informasi Berkas -->
                        <div class="berkas-info-section mb-4">
                            <h5 class="mb-3 text-secondary">
                                <i class="bi bi-clipboard-data"></i> Informasi Berkas
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">No Berkas (Otomatis)</label>
                                    <input type="text" class="form-control" id="no_berkas" name="no_berkas" readonly style="background-color: #e9ecef;" placeholder="Pilih Kode Klasifikasi dulu">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Judul Berkas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="judul_berkas" name="judul_berkas" required placeholder="Masukkan judul berkas">
                                </div>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Nomor berkas akan dibuat otomatis berdasarkan kode klasifikasi yang dipilih di item arsip
                            </small>
                        </div>

                        <hr class="my-4">

                        <!-- Item Arsip Section -->
                        <div class="item-arsip-section">
                            <h5 class="mb-3 text-secondary">
                                <i class="bi bi-file-earmark-text"></i> Item Arsip
                            </h5>
                            <div id="itemArsipContainer">
                            </div>

                            <button type="button" class="btn btn-success w-100 mb-3" onclick="tambahItemArsip()">
                                <i class="bi bi-plus-circle"></i> Tambah Item Arsip
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanData()">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        let itemCounter = 0;
        let kodeKlasifikasi = [];
        let arsipTable;
        let modalTambah;

        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        // Navigate Menu
        function navigateTo(page) {
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });

            event.currentTarget.classList.add('active');

            switch(page) {
                case 'dashboard':
                    alert('Navigasi ke Dashboard');
                    break;
                case 'arsip':
                    break;
                case 'klasifikasi':
                    alert('Navigasi ke Klasifikasi');
                    break;
                case 'laporan':
                    alert('Navigasi ke Laporan');
                    break;
                case 'pengaturan':
                    alert('Navigasi ke Pengaturan');
                    break;
                case 'bantuan':
                    alert('Navigasi ke Bantuan');
                    break;
                case 'logout':
                    if(confirm('Apakah Anda yakin ingin keluar?')) {
                        alert('Logout');
                    }
                    break;
            }
        }

        // Generate No Berkas otomatis
        async function generateNoBerkas(kodeKlasifikasi) {
            const noBerkasInput = document.getElementById('no_berkas');

            if (!kodeKlasifikasi) {
                noBerkasInput.value = '';
                noBerkasInput.placeholder = 'Pilih Kode Klasifikasi dulu';
                return;
            }

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/berkas/next-number?kode_klasifikasi=${encodeURIComponent(kodeKlasifikasi)}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal mendapatkan nomor berkas');

                const result = await response.json();

                if (result.status) {
                    noBerkasInput.value = result.next_number;
                    noBerkasInput.placeholder = result.next_number;
                } else {
                    throw new Error(result.message || 'Format response tidak sesuai');
                }

            } catch (error) {
                console.error('Error generating no berkas:', error);
                noBerkasInput.value = '1';
                noBerkasInput.placeholder = '1';
            }
        }

        // Load kode klasifikasi dari API
        async function loadKodeKlasifikasi() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/klasifikasi', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal mengambil data klasifikasi');

                const result = await response.json();

                if (result.status && result.data) {
                    kodeKlasifikasi = result.data.map(item => ({
                        id: item.id,
                        kode: item.Kode,
                        detail: item.Detail_kode
                    }));

                    updateKlasifikasiDropdown();
                } else {
                    throw new Error('Format data tidak sesuai');
                }
            } catch (error) {
                console.error('Error loading kode klasifikasi:', error);
            }
        }

        function updateKlasifikasiDropdown() {
            const existingDropdown = document.querySelector('select[name="kode_klasifikasi[]"]');
            if (existingDropdown) {
                existingDropdown.innerHTML = '<option value="">-- Pilih Kode Klasifikasi --</option>';
                kodeKlasifikasi.forEach(item => {
                    existingDropdown.innerHTML += `<option value="${item.kode}|${item.detail}">${item.kode} - ${item.detail}</option>`;
                });
            }

            const masterDropdown = document.getElementById('kode_klasifikasi_master');
            if (masterDropdown) {
                masterDropdown.innerHTML = '<option value="">-- Pilih Kode Klasifikasi --</option>';
                kodeKlasifikasi.forEach(item => {
                    masterDropdown.innerHTML += `<option value="${item.kode}|${item.detail}">${item.kode} - ${item.detail}</option>`;
                });
            }
        }

        // Initialize DataTable
        function initDataTable() {
            arsipTable = $('#arsipTable').DataTable({
                ajax: {
                    url: 'http://127.0.0.1:8000/api/berkas',
                    type: 'GET',
                    dataSrc: function(json) {
                        if (json.data) {
                            return json.data;
                        } else if (Array.isArray(json)) {
                            return json;
                        } else {
                            console.error('Format data tidak dikenali:', json);
                            return [];
                        }
                    },
                    error: function(xhr, error, thrown) {
                        console.error('Error loading data:', error, thrown);
                        alert('Gagal memuat data: ' + error);
                    }
                },
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    {
                        data: null,
                        render: function(data) {
                            return data.hal && data.hal.nomor ? data.hal.nomor : '-';
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return data.hal && data.hal.judul_berkas ? data.hal.judul_berkas : '-';
                        }
                    },
                    {
                        data: 'no_arsip',
                        defaultContent: '-'
                    },
                    {
                        data: null,
                        render: function(data) {
                            if (data.kode) {
                                return `
                                    <div class="kode-klasifikasi">
                                        <div class="kode">${data.kode.Kode || '-'}</div>
                                        <div class="detail">${data.kode.Detail_kode || '-'}</div>
                                    </div>
                                `;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'uraian_informasi',
                        defaultContent: '-'
                    },
                    {
                        data: 'tanggal',
                        defaultContent: '-',
                        render: function(data) {
                            if (!data) return '-';
                            const date = new Date(data);
                            return date.toLocaleDateString('id-ID');
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            const jumlah = data.jumlah || '0';
                            const satuan = data.satuan || '';
                            return `${jumlah} ${satuan}`;
                        }
                    },
                    {
                        data: 'keamanan',
                        defaultContent: 'Biasa',
                        render: function(data) {
                            let badgeClass = '';
                            let badgeText = data || 'Biasa';

                            switch(badgeText.toLowerCase()) {
                                case 'biasa':
                                    badgeClass = 'badge-biasa';
                                    break;
                                case 'rahasia':
                                    badgeClass = 'badge-rahasia';
                                    break;
                                case 'super rahasia':
                                case 'super-rahasia':
                                    badgeClass = 'badge-super-rahasia';
                                    break;
                                default:
                                    badgeClass = 'bg-secondary';
                            }

                            return `<span class="badge ${badgeClass}">${badgeText}</span>`;
                        }
                    },
                    {
                        data: 'Keterangan',
                        defaultContent: '-'
                    },
                    {
                        data: 'id',
                        orderable: false,
                        render: function(data) {
                            return `
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-primary" onclick="editArsip(${data})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="hapusArsip(${data})" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                order: [[1, 'asc']],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                    emptyTable: "Tidak ada data tersedia",
                    zeroRecords: "Data tidak ditemukan",
                    loadingRecords: "Memuat data..."
                },
                processing: true,
                serverSide: false,
                drawCallback: function() {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var lastGroup = null;

                    api.rows({page: 'current'}).every(function(rowIdx) {
                        var data = this.data();
                        var nomor = data.hal && data.hal.nomor ? data.hal.nomor : '';
                        var judul = data.hal && data.hal.judul_berkas ? data.hal.judul_berkas : '';
                        var kode = data.kode && data.kode.Kode ? data.kode.Kode : '';
                        var currentGroup = nomor + '|' + judul + '|' + kode;

                        if (lastGroup === currentGroup && lastGroup !== '') {
                            $(rows[rowIdx]).find('td:eq(1)').html('');
                            $(rows[rowIdx]).find('td:eq(2)').html('');
                            $(rows[rowIdx]).find('td:eq(4)').html('');

                            $(rows[rowIdx]).find('td:eq(1)').css('border-top', 'none');
                            $(rows[rowIdx]).find('td:eq(2)').css('border-top', 'none');
                            $(rows[rowIdx]).find('td:eq(4)').css('border-top', 'none');
                        } else {
                            $(rows[rowIdx]).find('td:eq(1)').css({
                                'font-weight': '600',
                                'vertical-align': 'middle',
                                'background-color': '#f8f9fa'
                            });
                            $(rows[rowIdx]).find('td:eq(2)').css({
                                'font-weight': '600',
                                'vertical-align': 'middle',
                                'background-color': '#f8f9fa'
                            });
                            $(rows[rowIdx]).find('td:eq(4)').css({
                                'font-weight': '600',
                                'vertical-align': 'middle',
                                'background-color': '#f8f9fa'
                            });
                        }

                        lastGroup = currentGroup;
                    });
                }
            });
        }

        // Hapus Arsip
        async function hapusArsip(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/arsip/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal menghapus data');

                const result = await response.json();
                alert(result.message || 'Data berhasil dihapus!');
                arsipTable.ajax.reload();
            } catch (error) {
                console.error('Error deleting arsip:', error);
                alert('Gagal menghapus data: ' + error.message);
            }
        }

        function editArsip(id) {
            alert('Fitur edit sedang dalam pengembangan');
        }

        // Tambah Data
        function tambahData() {
            modalTambah.show();
            if (kodeKlasifikasi.length === 0) {
                loadKodeKlasifikasi();
            } else {
                updateKlasifikasiDropdown();
            }

            const container = document.getElementById('itemArsipContainer');
            container.innerHTML = getItemArsipHTML(1, false);
            itemCounter = 1;
        }

        function getItemArsipHTML(itemNumber, showRemoveBtn = true) {
            const isFirstItem = itemNumber === 1;

            let optionsHTML = '<option value="">-- Pilih Kode Klasifikasi --</option>';
            kodeKlasifikasi.forEach(item => {
                optionsHTML += `<option value="${item.kode}|${item.detail}">${item.kode} - ${item.detail}</option>`;
            });

            return `
                <div class="item-arsip-container" data-item="${itemNumber}">
                    <div class="item-arsip-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="bi bi-clipboard"></i> Uraian Item Arsip ${itemNumber}</h6>
                        ${showRemoveBtn ? `<button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusItemArsip(this)">
                            <i class="bi bi-trash"></i> Hapus
                        </button>` : ''}
                    </div>

                    ${isFirstItem ? `
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">No Item Arsip</label>
                            <input type="text" class="form-control" id="no_item_master" name="no_item[]" required placeholder="Masukkan nomor item" onchange="updateAllNoItem()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kode Klasifikasi <span class="text-danger">*</span></label>
                            <select class="form-select" id="kode_klasifikasi_master" name="kode_klasifikasi[]" required onchange="updateAllKodeKlasifikasi(); handleKodeChange()">
                                ${optionsHTML}
                            </select>
                        </div>
                    </div>
                    ` : `
                    <div class="inherited-info">
                        <small class="text-muted d-block mb-2">
                            <strong><i class="bi bi-link-45deg"></i> Mengikuti Item 1:</strong>
                        </small>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>No Item:</strong> <span class="inherited-value inherited-no-item">-</span>
                            </div>
                            <div class="col-md-6">
                                <strong>Kode:</strong> <span class="inherited-value inherited-kode">-</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="hidden-no-item" name="no_item[]">
                    <input type="hidden" class="hidden-kode" name="kode_klasifikasi[]">
                    `}

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal[]" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jumlah Angka</label>
                            <input type="number" class="form-control" name="jumlah_angka[]" required placeholder="Jumlah" min="1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Satuan</label>
                            <select class="form-select" name="jumlah[]" required>
                                <option value="">-- Pilih --</option>
                                <option value="lembar">Lembar</option>
                                <option value="berkas">Berkas</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Klasifikasi Keamanan</label>
                        <select class="form-select" name="klasifikasi_keamanan[]" required>
                            <option value="">-- Pilih Klasifikasi --</option>
                            <option value="biasa">Biasa</option>
                            <option value="rahasia">Rahasia</option>
                            <option value="super-rahasia">Super Rahasia</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Uraian Informasi Arsip</label>
                        <textarea class="form-control" name="uraian[]" required placeholder="Masukkan uraian informasi arsip" rows="3"></textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan[]" required placeholder="Contoh: Tekstual, Digital, dll">
                    </div>
                </div>
            `;
        }

        function updateAllNoItem() {
            const masterValue = document.getElementById('no_item_master').value;
            const hiddenInputs = document.querySelectorAll('.hidden-no-item');
            const displaySpans = document.querySelectorAll('.inherited-no-item');

            hiddenInputs.forEach(input => input.value = masterValue);
            displaySpans.forEach(span => span.textContent = masterValue || '-');
        }

        function updateAllKodeKlasifikasi() {
            const masterSelect = document.getElementById('kode_klasifikasi_master');
            const masterValue = masterSelect.value;
            const masterText = masterSelect.options[masterSelect.selectedIndex].text;
            const hiddenInputs = document.querySelectorAll('.hidden-kode');
            const displaySpans = document.querySelectorAll('.inherited-kode');

            hiddenInputs.forEach(input => input.value = masterValue);
            displaySpans.forEach(span => span.textContent = masterText || '-');
        }

        function handleKodeChange() {
            const masterSelect = document.getElementById('kode_klasifikasi_master');
            if (masterSelect && masterSelect.value) {
                const [kode, detail] = masterSelect.value.split('|');
                generateNoBerkas(kode);
            }
        }

        function tambahItemArsip() {
            itemCounter++;
            const container = document.getElementById('itemArsipContainer');
            const newItem = document.createElement('div');
            newItem.innerHTML = getItemArsipHTML(itemCounter, true);
            container.appendChild(newItem.firstElementChild);

            updateAllNoItem();
            updateAllKodeKlasifikasi();
        }

        function hapusItemArsip(button) {
            const itemContainer = button.closest('.item-arsip-container');
            itemContainer.remove();

            const items = document.querySelectorAll('.item-arsip-container');
            items.forEach((item, index) => {
                const header = item.querySelector('.item-arsip-header h6');
                header.innerHTML = `<i class="bi bi-clipboard"></i> Uraian Item Arsip ${index + 1}`;
                item.setAttribute('data-item', index + 1);
            });

            itemCounter = items.length;
        }

        // Simpan Data
        async function simpanData() {
            const form = document.getElementById('formTambahArsip');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);

            const data = {
                no_berkas: formData.get('no_berkas'),
                judul_berkas: formData.get('judul_berkas'),
                items: []
            };

            const kodeKlasifikasiArray = formData.getAll('kode_klasifikasi[]');
            const tanggal = formData.getAll('tanggal[]');
            const jumlahAngka = formData.getAll('jumlah_angka[]');
            const jumlah = formData.getAll('jumlah[]');
            const klasifikasiKeamanan = formData.getAll('klasifikasi_keamanan[]');
            const uraian = formData.getAll('uraian[]');
            const keterangan = formData.getAll('keterangan[]');

            if (kodeKlasifikasiArray.length === 0) {
                alert('Minimal harus ada 1 item arsip!');
                return;
            }

            for (let i = 0; i < kodeKlasifikasiArray.length; i++) {
                const kodeValue = kodeKlasifikasiArray[i];
                if (!kodeValue) {
                    alert(`Item ${i + 1}: Kode klasifikasi harus dipilih!`);
                    return;
                }

                const [kode, detail] = kodeValue.split('|');

                data.items.push({
                    no_item: (i + 1).toString(),
                    kode: kode.trim(),
                    detail_klasifikasi: detail.trim(),
                    tanggal: tanggal[i],
                    jumlah_angka: parseInt(jumlahAngka[i]),
                    satuan_jumlah: jumlah[i],
                    jumlah_lengkap: jumlahAngka[i] + ' ' + jumlah[i],
                    klasifikasi_keamanan: klasifikasiKeamanan[i],
                    uraian: uraian[i].trim(),
                    keterangan: keterangan[i].trim()
                });
            }

            try {
                const response = await fetch('http://127.0.0.1:8000/api/arsip/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menyimpan data');
                }

                alert(result.message || 'Data berhasil disimpan!');
                modalTambah.hide();
                form.reset();

                const container = document.getElementById('itemArsipContainer');
                container.innerHTML = '';
                itemCounter = 0;

                arsipTable.ajax.reload();

            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menyimpan data: ' + error.message);
            }
        }

        // ===== EXPORT EXCEL - LANGSUNG DOWNLOAD =====
        async function exportExcel() {
            try {
                const btn = event.target.closest('button');
                const originalHTML = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Downloading...';

                const response = await fetch('http://127.0.0.1:8000/api/arsip/export/excel', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal mengunduh file Excel');
                }

                // Ambil blob dari response
                const blob = await response.blob();

                // Buat URL untuk blob
                const url = window.URL.createObjectURL(blob);

                // Buat element anchor untuk download
                const a = document.createElement('a');
                a.href = url;
                a.download = `Data_Arsip_${new Date().getTime()}.xlsx`;
                document.body.appendChild(a);
                a.click();

                // Cleanup
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

                btn.disabled = false;
                btn.innerHTML = originalHTML;

            } catch (error) {
                console.error('Error export Excel:', error);
                alert('Gagal mengunduh file Excel: ' + error.message);
                const btn = event.target.closest('button');
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-file-earmark-excel"></i> Export Excel';
            }
        }

        // ===== EXPORT PDF - LANGSUNG DOWNLOAD =====
        async function exportPDF() {
            try {
                const btn = event.target.closest('button');
                const originalHTML = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Downloading...';

                const response = await fetch('http://127.0.0.1:8000/api/arsip/export/pdf', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/pdf'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal mengunduh file PDF');
                }

                // Ambil blob dari response
                const blob = await response.blob();

                // Buat URL untuk blob
                const url = window.URL.createObjectURL(blob);

                // Buat element anchor untuk download
                const a = document.createElement('a');
                a.href = url;
                a.download = `Data_Arsip_${new Date().getTime()}.pdf`;
                document.body.appendChild(a);
                a.click();

                // Cleanup
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

                btn.disabled = false;
                btn.innerHTML = originalHTML;

            } catch (error) {
                console.error('Error export PDF:', error);
                alert('Gagal mengunduh file PDF: ' + error.message);
                const btn = event.target.closest('button');
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-file-earmark-pdf"></i> Export PDF';
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            modalTambah = new bootstrap.Modal(document.getElementById('modalTambah'));
            loadKodeKlasifikasi();
            initDataTable();
        });
    </script>
</body>
</html>
