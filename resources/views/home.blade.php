<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Arsip</title>

    <!-- ===================== CSS Libraries ===================== -->

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">

    <!-- ===================== Custom CSS ===================== -->
    <style>
        /* ── Base Layout ── */
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
            background:
                radial-gradient(circle at 20% 80%, rgba(255, 152, 0, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(230, 81, 0, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .main-content {
            margin-left: 260px;
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 2rem;
            min-height: 100vh;
        }

        .sidebar.collapsed ~ .main-content,
        .main-content.sidebar-collapsed {
            margin-left: 70px;
        }

        /* ── Header Section ── */
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

        /* ── Animations ── */
        @keyframes slideInDown {
            from { transform: translateY(-50px); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }

        @keyframes shimmer {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(100%);  }
        }

        @keyframes modalBounceIn {
            0%   { transform: scale(0.3);  opacity: 0; }
            50%  { transform: scale(1.05); }
            70%  { transform: scale(0.9);  }
            100% { transform: scale(1);    opacity: 1; }
        }

        /* ── Table Styles ── */
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

        #arsipTable tbody tr {
            transition: all 0.3s ease;
        }

        #arsipTable tbody tr:hover {
            background: linear-gradient(135deg, #f1f8ff 0%, #e3f2fd 100%);
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .grouped-row td {
            border-top: none !important;
        }

        .action-group-cell {
            vertical-align: middle !important;
            background-color: #f8f9fa !important;
            font-weight: 600;
        }

        /* ── Badges ── */
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

        /* ── Kode Klasifikasi ── */
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

        /* ── Item Arsip Container ── */
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

        /* ── Buttons ── */
        .btn {
            border-radius: 2rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .btn-primary {
            background: linear-gradient(135deg, #e65100 0%, #ff9800 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #bf4300 0%, #e68900 100%);
            transform: translateY(-1px);
        }

        /* ── Form Controls ── */
        .form-control,
        .form-select {
            border-radius: 0.5rem;
            border: 2px solid #e9ecef;
            height: 45px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            transform: scale(1.02);
        }

        .input-group-text {
            height: 45px;
            border-radius: 8px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group .input-group-text {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .input-group .form-select {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        /* ── Cards ── */
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

        /* ── Modal ── */
        .modal-content {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalBounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* ── SweetAlert2 Overrides ── */
        .swal2-popup {
            border-radius: 1rem !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }

        .swal2-title {
            font-weight: 700 !important;
        }

        .swal2-confirm,
        .swal2-cancel {
            border-radius: 2rem !important;
            padding: 0.75rem 2rem !important;
            font-weight: 600 !important;
        }
        /* ── Filter Tahun (Warm Theme) ── */
        .filter-tahun-wrapper {
            background: linear-gradient(135deg, #fff8e1 0%, #ffe0b2 100%);
            border: 2px solid #ff9800;
            border-radius: 2rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(255, 152, 0, 0.15);
        }

        .filter-tahun-wrapper:hover {
            box-shadow: 0 4px 16px rgba(255, 152, 0, 0.3);
            transform: translateY(-1px);
        }

        .filter-tahun-wrapper:focus-within {
            border-color: #e65100;
            box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.2);
        }

        .filter-tahun-wrapper .input-group-text {
            background: linear-gradient(135deg, #e65100, #ff9800);
            color: white;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 0 !important;
        }

        .filter-tahun-wrapper .form-select {
            border: none;
            background-color: transparent;
            font-weight: 600;
            color: #e65100;
            cursor: pointer;
            height: 45px;
            border-radius: 0 !important;
        }

        .filter-tahun-wrapper .form-select:focus {
            box-shadow: none;
            transform: none;
            background-color: rgba(255, 255, 255, 0.5);
        }

        .filter-tahun-wrapper .form-select option {
            color: #333;
            font-weight: 500;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
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

    @include('sidebar')

    <!-- ===================== Main Content ===================== -->
    <div class="main-content" id="mainContent">
        <div class="container-fluid">

            <!-- Header -->
            <div class="header-section text-center shadow-sm">
                <h1 class="mb-2"><i class="bi bi-folder2-open"></i> Sistem Manajemen Arsip</h1>
                <p class="mb-0">Daftar Berkas dan Item Arsip</p>
            </div>

            <!-- Toolbar -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3 align-items-center">

                        <!-- Tombol Tambah -->
                        <div class="col-md-4">
                            <button class="btn btn-secondary" onclick="tambahData()">
                                <i class="bi bi-plus-circle"></i> Tambah Data
                            </button>
                        </div>

                        <!-- Filter Tahun -->
                        <div class="col-md-4">
                            <div class="input-group filter-tahun-wrapper">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar-check"></i>&nbsp; Tahun
                                </span>
                                <select id="filterTahun" class="form-select text-center">
                                    <option value="">📅 Semua Tahun</option>
                                </select>
                            </div>
                        </div>

                        <!-- Export Buttons -->
                        <div class="col-md-4 text-md-end">
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

            <!-- Data Table -->
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
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ===================== Modal: Tambah/Edit ===================== -->
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
                                    <input type="text" class="form-control" id="no_berkas" name="no_berkas"
                                           readonly style="background-color: #e9ecef;"
                                           placeholder="Pilih Kode Klasifikasi dulu">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Judul Berkas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="judul_berkas" name="judul_berkas"
                                           required placeholder="Masukkan judul berkas">
                                </div>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i>
                                Nomor berkas akan dibuat otomatis berdasarkan kode klasifikasi yang dipilih di item arsip
                            </small>
                        </div>

                        <hr class="my-4">

                        <!-- Item Arsip -->
                        <div class="item-arsip-section">
                            <h5 class="mb-3 text-secondary">
                                <i class="bi bi-file-earmark-text"></i> Item Arsip
                            </h5>
                            <div id="itemArsipContainer"></div>
                            <button type="button" class="btn btn-success w-100 mb-3" onclick="tambahItemArsip()">
                                <i class="bi bi-plus-circle"></i> Tambah Item Arsip
                            </button>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnSimpan" onclick="simpanData()">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ===================== Modal: Group Action ===================== -->
    <div class="modal fade" id="modalGroupAction" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Pilih Aksi untuk Group</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">Data yang akan diproses:</p>
                    <div id="groupDataInfo" class="alert alert-info"></div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-lg" onclick="editGroup()">
                            <i class="bi bi-pencil"></i> Edit Semua Data dalam Group
                        </button>
                        <button class="btn btn-outline-danger btn-lg" onclick="hapusGroup()">
                            <i class="bi bi-trash"></i> Hapus Semua Data dalam Group
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ===================== JS Libraries ===================== -->

    <!-- jQuery (harus pertama) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <!-- Select2 (setelah jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

    <!-- SheetJS (Excel) -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx-js-style@1.2.0/dist/xlsx.bundle.js"></script>

    <!-- jsPDF (PDF) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

    <!-- ===================== Application Script ===================== -->
    <script>
    // ════════════════════════════════════════════════════════════
    //  GLOBAL STATE
    // ════════════════════════════════════════════════════════════

    let itemCounter      = 0;
    let kodeKlasifikasi  = [];
    let arsipTable       = null;
    let modalTambah      = null;
    let modalGroupAction = null;
    let currentGroupIds  = [];
    let currentEditId    = null;
    let isEditMode       = false;

    const API_BASE = 'http://192.168.100.178:8000/api';

    // ════════════════════════════════════════════════════════════
    //  INITIALIZATION
    // ════════════════════════════════════════════════════════════

    document.addEventListener('DOMContentLoaded', function () {
        console.log('=== PAGE LOADING ===');

        initYearFilter();
        initModals();
        initSidebar();

        loadKodeKlasifikasi().then(() => {
            console.log('Klasifikasi loaded, initializing DataTable...');
            initDataTable();
        });

        showWelcomeToast();
        console.log('=== PAGE LOADED ===');
    });

    /** Populate tahun filter dropdown */
    function initYearFilter() {
        const filterTahun = document.getElementById('filterTahun');
        if (!filterTahun) return;

        const currentYear = new Date().getFullYear();
        const startYear = 2015;

        for (let y = currentYear + 1; y >= startYear; y--) {
            const option = document.createElement('option');
            option.value = y;
            option.text = `Tahun ${y}`;
            filterTahun.appendChild(option);
        }
    }

    /** Initialize Bootstrap modals */
    function initModals() {
        modalTambah = new bootstrap.Modal(document.getElementById('modalTambah'));
        modalGroupAction = new bootstrap.Modal(document.getElementById('modalGroupAction'));
    }

    /** Sync sidebar state */
    function initSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');
        if (sidebar && main) {
            main.classList.toggle('sidebar-collapsed', sidebar.classList.contains('collapsed'));
        }
    }

    /** Welcome toast */
    function showWelcomeToast() {
        Swal.fire({
            icon: 'info',
            title: 'Selamat Datang!',
            text: 'Sistem Manajemen Arsip siap digunakan',
            timer: 2000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    }

    // ════════════════════════════════════════════════════════════
    //  API HELPERS
    // ════════════════════════════════════════════════════════════

    /** Generate No Berkas otomatis dari API */
    async function generateNoBerkas(kode) {
        const input = document.getElementById('no_berkas');

        if (!kode) {
            input.value = '';
            input.placeholder = 'Pilih Kode Klasifikasi dulu';
            return;
        }

        try {
            const response = await fetch(
                `${API_BASE}/berkas/next-number?kode_klasifikasi=${encodeURIComponent(kode)}`
            );
            if (!response.ok) throw new Error('Gagal mendapatkan nomor berkas');

            const result = await response.json();
            if (result.status) {
                input.value = result.next_number;
                input.placeholder = result.next_number;
            }
        } catch (error) {
            console.error('Error generating no berkas:', error);
            input.value = '1';
            input.placeholder = '1';
        }
    }

    /** Load daftar Kode Klasifikasi dari API */
    async function loadKodeKlasifikasi() {
        try {
            const response = await fetch(`${API_BASE}/klasifikasi/active`);
            if (!response.ok) throw new Error('Gagal mengambil data klasifikasi');

            const result = await response.json();

            if (result.status && result.data) {
                kodeKlasifikasi = result.data.map(item => ({
                    id: item.id,
                    kode: item.Kode,
                    detail: item.Detail_kode
                }));
                updateKlasifikasiDropdown();
            }
        } catch (error) {
            console.error('Error loading kode klasifikasi:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Data',
                text: 'Tidak dapat memuat data klasifikasi',
                confirmButtonColor: '#d33'
            });
        }
    }

    // ════════════════════════════════════════════════════════════
    //  SELECT2 / DROPDOWN
    // ════════════════════════════════════════════════════════════

    /** Build Select2 dropdown untuk kode klasifikasi */
    function updateKlasifikasiDropdown() {
        const masterSelect = $('#kode_klasifikasi_master');
        if (!masterSelect.length) return;

        let options = '<option value="">Cari Kode atau Nama Klasifikasi...</option>';
        kodeKlasifikasi.forEach(item => {
            options += `<option value="${item.kode}|${item.detail}">${item.kode} - ${item.detail}</option>`;
        });
        masterSelect.html(options);

        masterSelect.select2({
            theme: 'bootstrap-5',
            placeholder: 'Ketik Kode (Misal: SP.01 atau DS...)',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalTambah'),
            language: {
                noResults: () => 'Data tidak ditemukan...'
            }
        });
    }

    // Auto-focus Select2 search field on open
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field')?.focus();
    });

    // Re-init Select2 when modal shown
    $('#modalTambah').on('shown.bs.modal', () => {
        updateKlasifikasiDropdown();
    });

    /** Handle perubahan kode klasifikasi master */
    function handleKodeChange() {
        const value = $('#kode_klasifikasi_master').val();
        if (value) {
            generateNoBerkas(value.split('|')[0]);
        } else {
            document.getElementById('no_berkas').value = '';
        }
    }

    // ════════════════════════════════════════════════════════════
    //  DATATABLE
    // ════════════════════════════════════════════════════════════

    function initDataTable() {
        arsipTable = $('#arsipTable').DataTable({
            ajax: {
                url: `${API_BASE}/berkas`,
                type: 'GET',
                data: (d) => { d.tahun = $('#filterTahun').val(); },
                dataSrc: (json) => json.data || (Array.isArray(json) ? json : []),
                error: (xhr, error, thrown) => {
                    console.error('Error loading data:', error, thrown);
                    Swal.fire({ icon: 'error', title: 'Gagal Memuat Data', text: 'Tidak dapat memuat data dari server' });
                }
            },
            order: [[10, 'desc']],
            columns: buildColumns(),
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Semua']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                emptyTable: 'Tidak ada data tersedia',
                zeroRecords: 'Data tidak ditemukan',
                loadingRecords: 'Memuat data...'
            },
            processing: true,
            serverSide: false,
            drawCallback: drawGrouping
        });

        // Reload table on year filter change
        $('#filterTahun').on('change', () => arsipTable.ajax.reload());
    }

    /** Column definitions */
    function buildColumns() {
        return [
            {
                data: null, orderable: false,
                render: (data, type, row, meta) => meta.row + 1
            },
            {
                data: 'hal.nomor',
                render: (data, type, row) => row.hal?.nomor || '-'
            },
            {
                data: null,
                render: (data) => data.hal?.judul_berkas || '-'
            },
            { data: 'no_arsip', defaultContent: '-' },
            {
                data: null,
                render: (data) => {
                    if (!data.kode) return '-';
                    return `
                        <div class="kode-klasifikasi">
                            <div class="kode">${data.kode.Kode || '-'}</div>
                            <div class="detail">${data.kode.Detail_kode || '-'}</div>
                        </div>`;
                }
            },
            { data: 'uraian_informasi', defaultContent: '-' },
            {
                data: 'tanggal', defaultContent: '-',
                render: (data) => data ? new Date(data).toLocaleDateString('id-ID') : '-'
            },
            {
                data: null,
                render: (data) => `${data.jumlah || '0'} ${data.satuan || ''}`
            },
            {
                data: 'keamanan', defaultContent: 'Biasa',
                render: (data) => {
                    const text = data || 'Biasa';
                    const classMap = {
                        'biasa': 'badge-biasa',
                        'rahasia': 'badge-rahasia',
                        'super rahasia': 'badge-super-rahasia',
                        'super-rahasia': 'badge-super-rahasia'
                    };
                    const cls = classMap[text.toLowerCase()] || 'bg-secondary';
                    return `<span class="badge ${cls}">${text}</span>`;
                }
            },
            { data: 'keterangan', defaultContent: '-' },
            {
                data: 'id', orderable: true,
                render: (data) => `<div class="action-cell" data-id="${data}"></div>`
            }
        ];
    }

    /** Grouping rows with same nomor/judul/kode */
    function drawGrouping(settings) {
        const api = this.api();
        const groupMap = {};

        // Pass 1: Build group map
        api.rows({ page: 'current' }).every(function () {
            const data = this.data();
            const key = [
                data.hal?.nomor || '',
                data.hal?.judul_berkas || '',
                data.kode?.Kode || ''
            ].join('|');

            if (!groupMap[key]) {
                groupMap[key] = { ids: [], nomor: data.hal?.nomor || '', judul: data.hal?.judul_berkas || '', kode: data.kode?.Kode || '' };
            }
            groupMap[key].ids.push(data.id);
        });

        // Pass 2: Render grouping
        let lastGroup = null;

        api.rows({ page: 'current' }).every(function () {
            const data = this.data();
            const $tr = $(this.node());
            const currentGroup = [data.hal?.nomor || '', data.hal?.judul_berkas || '', data.kode?.Kode || ''].join('|');
            const groupInfo = groupMap[currentGroup];
            const groupSize = groupInfo.ids.length;

            $tr.removeClass('grouped-row').find('td').css('border-top', '');

            if (lastGroup === currentGroup && lastGroup !== '') {
                // Subsequent row in group — hide merged columns
                $tr.addClass('grouped-row');
                [1, 2, 4, 10].forEach(i => $tr.find(`td:eq(${i})`).html('').css('border-top', 'none'));
            } else {
                // First row in group — render action buttons
                const headerStyle = { 'font-weight': '600', 'vertical-align': 'middle', 'background-color': '#f8f9fa' };
                [1, 2, 4].forEach(i => $tr.find(`td:eq(${i})`).css(headerStyle));

                const actionCell = $tr.find('.action-cell');
                if (groupSize > 1) {
                    actionCell.html(`
                        <button class="btn btn-outline-primary btn-sm"
                                onclick='showGroupAction(${JSON.stringify(groupInfo.ids)}, "${groupInfo.nomor}", "${groupInfo.judul}")'
                                title="Aksi Group (${groupSize} data)">
                            <i class="bi bi-gear"></i>
                            <span class="badge bg-primary">${groupSize}</span>
                        </button>`);
                    $tr.find('td:eq(10)').addClass('action-group-cell');
                } else {
                    actionCell.html(`
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-outline-primary" onclick="editArsip(${data.id})" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-outline-danger" onclick="hapusArsip(${data.id})" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>`);
                }
            }
            lastGroup = currentGroup;
        });
    }

    // ════════════════════════════════════════════════════════════
    //  ITEM ARSIP — DYNAMIC FORM
    // ════════════════════════════════════════════════════════════

    /** HTML template for each item arsip */
    function getItemArsipHTML(itemNumber, showRemoveBtn = true) {
        const isFirst = itemNumber === 1;

        let optionsHTML = '<option value="">-- Pilih Kode Klasifikasi --</option>';
        kodeKlasifikasi.forEach(item => {
            optionsHTML += `<option value="${item.kode}|${item.detail}">${item.kode} - ${item.detail}</option>`;
        });

        const masterFields = `
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">No Item Arsip</label>
                    <input type="text" class="form-control" id="no_item_master" name="no_item[]"
                           required placeholder="Masukkan nomor item" onchange="updateAllNoItem()">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kode Klasifikasi <span class="text-danger">*</span></label>
                    <select class="form-select" id="kode_klasifikasi_master" name="kode_klasifikasi[]"
                            required onchange="updateAllKodeKlasifikasi(); handleKodeChange()">
                        ${optionsHTML}
                    </select>
                </div>
            </div>`;

        const inheritedFields = `
            <div class="inherited-info">
                <small class="text-muted d-block mb-2">
                    <strong><i class="bi bi-link-45deg"></i> Mengikuti Item 1:</strong>
                </small>
                <div class="row">
                    <div class="col-md-6"><strong>No Item:</strong> <span class="inherited-value inherited-no-item">-</span></div>
                    <div class="col-md-6"><strong>Kode:</strong> <span class="inherited-value inherited-kode">-</span></div>
                </div>
            </div>
            <input type="hidden" class="hidden-no-item" name="no_item[]">
            <input type="hidden" class="hidden-kode" name="kode_klasifikasi[]">`;

        return `
            <div class="item-arsip-container" data-item="${itemNumber}">
                <div class="item-arsip-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="bi bi-clipboard"></i> Uraian Item Arsip ${itemNumber}</h6>
                    ${showRemoveBtn
                        ? `<button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusItemArsip(this)">
                               <i class="bi bi-trash"></i> Hapus
                           </button>`
                        : ''}
                </div>

                ${isFirst ? masterFields : inheritedFields}

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
            </div>`;
    }

    /** Sync No Item across all items */
    function updateAllNoItem() {
        const masterValue = document.getElementById('no_item_master')?.value || '';
        document.querySelectorAll('.hidden-no-item').forEach(el => el.value = masterValue);
        document.querySelectorAll('.inherited-no-item').forEach(el => el.textContent = masterValue || '-');
    }

    /** Sync Kode Klasifikasi across all items */
    function updateAllKodeKlasifikasi() {
        const master = document.getElementById('kode_klasifikasi_master');
        if (!master) return;

        const masterValue = master.value;
        const masterText = master.options[master.selectedIndex]?.text || '-';

        document.querySelectorAll('.hidden-kode').forEach(el => el.value = masterValue);
        document.querySelectorAll('.inherited-kode').forEach(el => el.textContent = masterText);
    }

    /** Add new item arsip row */
    /** Add new item arsip row */
    function tambahItemArsip() {
        itemCounter++;
        const container = document.getElementById('itemArsipContainer');
        const wrapper = document.createElement('div');
        wrapper.innerHTML = getItemArsipHTML(itemCounter, true);
        container.appendChild(wrapper.firstElementChild);

        updateAllNoItem();
        updateAllKodeKlasifikasi();

        // ✅ Set default tanggal untuk item baru
        applyDefaultTanggal();
    }

    /** Remove item arsip row & re-number */
    function hapusItemArsip(button) {
        button.closest('.item-arsip-container').remove();

        const items = document.querySelectorAll('.item-arsip-container');
        items.forEach((item, index) => {
            item.querySelector('.item-arsip-header h6').innerHTML =
                `<i class="bi bi-clipboard"></i> Uraian Item Arsip ${index + 1}`;
            item.setAttribute('data-item', index + 1);
        });
        itemCounter = items.length;
    }

    // ════════════════════════════════════════════════════════════
    //  CRUD OPERATIONS
    // ════════════════════════════════════════════════════════════

    /** Reset modal to "Tambah" mode */
    function resetModalTambah() {
        document.getElementById('modalTambahLabel').innerHTML =
            '<i class="bi bi-plus-circle"></i> Tambah Data Arsip';

        const saveBtn = document.getElementById('btnSimpan');
        if (saveBtn) {
            saveBtn.innerHTML = '<i class="bi bi-save"></i> Simpan Data';
            saveBtn.onclick = simpanData;
        }

        currentEditId = null;
        currentGroupIds = [];
        isEditMode = false;

        document.getElementById('formTambahArsip')?.reset();
        document.getElementById('itemArsipContainer').innerHTML = '';
        itemCounter = 0;
    }

    /** Open "Tambah" modal */
    /** Open "Tambah" modal */
    function tambahData() {
        resetModalTambah();
        modalTambah.show();

        if (kodeKlasifikasi.length === 0) {
            loadKodeKlasifikasi();
        } else {
            updateKlasifikasiDropdown();
        }

        document.getElementById('itemArsipContainer').innerHTML = getItemArsipHTML(1, false);
        itemCounter = 1;

        // ✅ Set default tanggal sesuai filter tahun
        setTimeout(() => applyDefaultTanggal(), 100);
    }
    // ════════════════════════════════════════════════════════════
//  HELPER: Auto-set tahun filter dari tanggal input
// ════════════════════════════════════════════════════════════

/**
 * Ambil tahun dari tanggal pertama yang diisi di form,
 * lalu set filter tahun otomatis & reload tabel
 */
function autoSetTahunFilter() {
    const tanggalInputs = document.querySelectorAll('input[name="tanggal[]"]');
    let tahun = null;

    // Cari tanggal pertama yang terisi
    for (const input of tanggalInputs) {
        if (input.value) {
            tahun = new Date(input.value).getFullYear();
            break;
        }
    }

    if (tahun) {
        const filterTahun = document.getElementById('filterTahun');

        // Pastikan opsi tahun tersebut ada di dropdown
        let optionExists = false;
        for (const option of filterTahun.options) {
            if (option.value == tahun) {
                optionExists = true;
                break;
            }
        }

        // Kalau belum ada, tambahkan
        if (!optionExists) {
            const newOption = document.createElement('option');
            newOption.value = tahun;
            newOption.text = `Tahun ${tahun}`;
            filterTahun.appendChild(newOption);
        }

        // Set nilai & reload
        filterTahun.value = tahun;

        Swal.fire({
            icon: 'info',
            title: `Filter: Tahun ${tahun}`,
            text: 'Tabel otomatis menampilkan data tahun yang baru diinput',
            timer: 1500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
}


        // ════════════════════════════════════════════════════════════
        //  SIMPAN DATA (dengan auto-set tahun)
        // ════════════════════════════════════════════════════════════

        async function simpanData() {
            const form = document.getElementById('formTambahArsip');
            if (!form.checkValidity()) { form.reportValidity(); return; }

            const confirmed = await Swal.fire({
                title: 'Konfirmasi Simpan',
                text: 'Anda yakin ingin menyimpan data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            });
            if (!confirmed.isConfirmed) return;

            showLoading('Menyimpan Data...');

            const formData = new FormData(form);
            const kodeArr = formData.getAll('kode_klasifikasi[]');

            if (kodeArr.length === 0) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Minimal harus ada 1 item arsip!' });
                return;
            }

            const data = {
                no_berkas: formData.get('no_berkas'),
                judul_berkas: formData.get('judul_berkas'),
                items: []
            };

            const tanggal    = formData.getAll('tanggal[]');
            const jumlahAngka = formData.getAll('jumlah_angka[]');
            const jumlah     = formData.getAll('jumlah[]');
            const keamanan   = formData.getAll('klasifikasi_keamanan[]');
            const uraian     = formData.getAll('uraian[]');
            const keterangan = formData.getAll('keterangan[]');

            for (let i = 0; i < kodeArr.length; i++) {
                if (!kodeArr[i]) {
                    Swal.fire({ icon: 'error', title: 'Error', text: `Item ${i + 1}: Kode klasifikasi harus dipilih!` });
                    return;
                }
                const [kode, detail] = kodeArr[i].split('|');
                data.items.push({
                    no_item: String(i + 1),
                    kode: kode.trim(),
                    detail_klasifikasi: detail.trim(),
                    tanggal: tanggal[i],
                    jumlah_angka: parseInt(jumlahAngka[i]),
                    satuan_jumlah: jumlah[i],
                    jumlah_lengkap: `${jumlahAngka[i]} ${jumlah[i]}`,
                    klasifikasi_keamanan: keamanan[i],
                    uraian: uraian[i].trim(),
                    keterangan: keterangan[i].trim()
                });
            }

            try {
                const response = await fetch(`${API_BASE}/arsip/store`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Gagal menyimpan data');

                // ✅ AUTO-SET TAHUN SEBELUM MODAL DITUTUP
                autoSetTahunFilter();

                Swal.fire({ icon: 'success', title: 'Berhasil!', text: result.message || 'Data berhasil disimpan!' });
                modalTambah.hide();
                form.reset();
                document.getElementById('itemArsipContainer').innerHTML = '';
                itemCounter = 0;

                // Reload tabel (sudah filter tahun yang benar)
                arsipTable.ajax.reload();
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: error.message });
            }
        }


        // ════════════════════════════════════════════════════════════
        //  UPDATE DATA (dengan auto-set tahun)
        // ════════════════════════════════════════════════════════════

        async function updateArsipFromModal() {
            const form = document.getElementById('formTambahArsip');
            if (!form.checkValidity()) { form.reportValidity(); return; }

            const isGroup = currentGroupIds?.length > 0;
            if (!isGroup && !currentEditId) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'ID data tidak ditemukan' });
                return;
            }

            const confirmed = await Swal.fire({
                title: 'Konfirmasi Update',
                text: `Anda akan mengupdate ${isGroup ? currentGroupIds.length : 1} data. Lanjutkan?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal'
            });
            if (!confirmed.isConfirmed) return;

            showLoading('Mengupdate Data...');

            const formData = new FormData(form);
            const kodeArr = formData.getAll('kode_klasifikasi[]');

            if (!kodeArr.length || !kodeArr[0]) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Kode klasifikasi harus dipilih!' });
                return;
            }

            const [kode]     = kodeArr[0].split('|');
            const tanggal    = formData.getAll('tanggal[]');
            const jumlahAngka = formData.getAll('jumlah_angka[]');
            const jumlah     = formData.getAll('jumlah[]');
            const keamanan   = formData.getAll('klasifikasi_keamanan[]');
            const uraian     = formData.getAll('uraian[]');
            const keterangan = formData.getAll('keterangan[]');

            try {
                let successCount = 0, failCount = 0;
                const errors = [];
                const ids = isGroup ? currentGroupIds : [currentEditId];

                for (let i = 0; i < ids.length; i++) {
                    const itemData = {
                        no_arsip: formData.get('no_berkas')?.trim(),
                        kode_klasifikasi: kode.trim(),
                        uraian_informasi: uraian[i]?.trim(),
                        tanggal: tanggal[i],
                        jumlah: parseFloat(jumlahAngka[i]) || 0,
                        satuan: jumlah[i],
                        keamanan: keamanan[i],
                        keterangan: keterangan[i]?.trim() || ''
                    };

                    try {
                        const response = await fetch(`${API_BASE}/arsip/${ids[i]}`, {
                            method: 'PUT',
                            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                            body: JSON.stringify(itemData)
                        });
                        const result = await response.json();
                        if (response.ok) { successCount++; }
                        else { failCount++; errors.push(`Item ${i + 1}: ${result.message || 'Unknown error'}`); }
                    } catch (err) {
                        failCount++;
                        errors.push(`Item ${i + 1}: ${err.message}`);
                    }
                }

                // ✅ AUTO-SET TAHUN SEBELUM MODAL DITUTUP
                autoSetTahunFilter();

                if (failCount === 0) {
                    Swal.fire({ icon: 'success', title: 'Berhasil!', text: `${successCount} data berhasil diupdate` });
                } else {
                    Swal.fire({
                        icon: 'warning', title: 'Update Selesai dengan Error',
                        html: `<p>Berhasil: ${successCount}</p><p>Gagal: ${failCount}</p><p>${errors.join('<br>')}</p>`
                    });
                }

                resetModalTambah();
                modalTambah.hide();
                arsipTable.ajax.reload();
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({ icon: 'error', title: 'Gagal Update', text: error.message });
            }
        }

    /** Edit arsip (single or group via first ID) */
    async function editArsip(id) {
        if (kodeKlasifikasi.length === 0) await loadKodeKlasifikasi();

        try {
            showLoading('Memuat Data...');

            const [itemRes, allRes] = await Promise.all([
                fetch(`${API_BASE}/arsip/${id}`, { headers: { 'Accept': 'application/json' } }),
                fetch(`${API_BASE}/berkas`, { headers: { 'Accept': 'application/json' } })
            ]);

            if (!itemRes.ok) throw new Error(`HTTP ${itemRes.status}`);
            if (!allRes.ok) throw new Error('Gagal mengambil data berkas lengkap');

            const itemResult = await itemRes.json();
            const allResult = await allRes.json();

            if (!itemResult.data) throw new Error('Data tidak ditemukan');

            const firstData = itemResult.data;
            const groupData = allResult.data.filter(item => item.id_hal === firstData.id_hal);

            // Set state
            currentGroupIds = groupData.map(item => item.id);
            currentEditId = null;
            isEditMode = true;

            // Update modal UI
            document.getElementById('modalTambahLabel').innerHTML =
                '<i class="bi bi-pencil-square"></i> Edit Data Arsip';
            document.getElementById('judul_berkas').value = firstData.hal?.judul_berkas || '';
            document.getElementById('no_berkas').value = firstData.hal?.nomor || '';

            // Build item forms
            const container = document.getElementById('itemArsipContainer');
            container.innerHTML = '';
            itemCounter = 0;

            groupData.forEach((data, index) => {
                itemCounter = index + 1;
                const wrapper = document.createElement('div');
                wrapper.innerHTML = getItemArsipHTML(itemCounter, index > 0);
                container.appendChild(wrapper.firstElementChild);
            });

            // Fill values after DOM renders
            setTimeout(() => populateEditValues(groupData), 150);

            // Update save button
            const saveBtn = document.getElementById('btnSimpan');
            saveBtn.innerHTML = '<i class="bi bi-save"></i> Update Data';
            saveBtn.onclick = updateArsipFromModal;

            Swal.close();
            modalTambah.show();
        } catch (error) {
            console.error('Error in edit arsip:', error);
            Swal.fire({ icon: 'error', title: 'Gagal Memuat Data', text: error.message });
        }
    }

    /** Populate form fields with edit data */
    function populateEditValues(groupData) {
        const items = document.querySelectorAll('.item-arsip-container');

        items.forEach((item, index) => {
            const data = groupData[index];

            if (index === 0) {
                const noInput = document.getElementById('no_item_master');
                if (noInput) noInput.value = data.no_arsip || '';

                const kodeSelect = document.getElementById('kode_klasifikasi_master');
                if (kodeSelect && data.kode) {
                    kodeSelect.value = `${data.kode.Kode || ''}|${data.kode.Detail_kode || ''}`;
                    if (data.kode.Kode) generateNoBerkas(data.kode.Kode);
                }
            }

            const setValue = (selector, value) => {
                const el = item.querySelector(selector);
                if (el) el.value = value;
            };

            setValue('input[name="tanggal[]"]', data.tanggal || '');
            setValue('input[name="jumlah_angka[]"]', data.jumlah || '');
            setValue('select[name="jumlah[]"]', (data.satuan || '').toLowerCase());
            setValue('select[name="klasifikasi_keamanan[]"]', (data.keamanan || 'biasa').toLowerCase().replace(/\s+/g, '-'));
            setValue('textarea[name="uraian[]"]', data.uraian_informasi || '');
            setValue('input[name="keterangan[]"]', data.keterangan || '');
        });

        updateAllNoItem();
        updateAllKodeKlasifikasi();
    }


    /** Hapus single arsip */
    async function hapusArsip(id) {
        const confirmed = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });
        if (!confirmed.isConfirmed) return;

        showLoading('Menghapus Data...');

        try {
            const response = await fetch(`${API_BASE}/arsip/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (!response.ok) throw new Error(result.message || 'Gagal menghapus data');

            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data berhasil dihapus' });
            arsipTable.ajax.reload();
        } catch (error) {
            Swal.fire({ icon: 'error', title: 'Gagal Hapus', text: error.message });
        }
    }

    // ════════════════════════════════════════════════════════════
    //  GROUP ACTIONS
    // ════════════════════════════════════════════════════════════

    /** Show group action modal */
    function showGroupAction(ids, nomor, judul) {
        currentGroupIds = ids;
        document.getElementById('groupDataInfo').innerHTML = `
            <strong>No Berkas:</strong> ${nomor}<br>
            <strong>Judul:</strong> ${judul}<br>
            <strong>Jumlah Data:</strong> ${ids.length} item`;
        modalGroupAction.show();
    }

    /** Edit entire group */
    async function editGroup() {
        if (!currentGroupIds?.length) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Tidak ada data group yang dipilih' });
            return;
        }
        modalGroupAction.hide();
        await editArsip(currentGroupIds[0]);
    }

    /** Delete entire group */
    async function hapusGroup() {
        if (!currentGroupIds?.length) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Tidak ada data group yang dipilih' });
            return;
        }

        const confirmed = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Anda akan menghapus ${currentGroupIds.length} data. Tindakan ini tidak dapat dibatalkan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });
        if (!confirmed.isConfirmed) return;

        modalGroupAction.hide();
        showLoading('Menghapus Data...');

        try {
            let successCount = 0, failCount = 0;

            for (const id of currentGroupIds) {
                try {
                    const res = await fetch(`${API_BASE}/arsip/${id}`, {
                        method: 'DELETE',
                        headers: { 'Accept': 'application/json' }
                    });
                    res.ok ? successCount++ : failCount++;
                } catch { failCount++; }
            }

            if (failCount === 0) {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: `${successCount} data berhasil dihapus` });
            } else {
                Swal.fire({ icon: 'warning', title: 'Hapus Selesai dengan Error', text: `Berhasil: ${successCount}, Gagal: ${failCount}` });
            }

            currentGroupIds = [];
            arsipTable.ajax.reload();
        } catch (error) {
            Swal.fire({ icon: 'error', title: 'Gagal Hapus', text: error.message });
        }
    }

    // ════════════════════════════════════════════════════════════
    //  UTILITY HELPERS
    // ════════════════════════════════════════════════════════════

    /** Show loading spinner */
    function showLoading(title = 'Memproses...') {
        Swal.fire({
            title,
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
    }

    /** Format date to Indonesian locale */
    function formatTanggalIndo(dateStr) {
        if (!dateStr) return '-';
        const d = new Date(dateStr);
        if (isNaN(d.getTime())) return dateStr;
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return `${d.getDate()} ${bulan[d.getMonth()]} ${d.getFullYear()}`;
    }

    /** Category name mapping */
    function getCategoryName(prefix) {
        const map = {
            'BNP': 'BINA POTENSI',           'BNG': 'BINA TENAGA',
            'SP':  'SARANA DAN PRASARANA',     'KOM': 'SISTEM KOMUNIKASI',
            'KSG': 'KESIAPSIAGAAN',           'OPS': 'OPERASI',
            'DI':  'DATA DAN INFORMASI',      'PS':  'PENGAWASAN',
            'DL':  'PENDIDIKAN DAN PELATIHAN', 'OT':  'ORGANISASI DAN TATALAKSANA',
            'KP':  'KEPEGAWAIAN',             'HK':  'HUKUM',
            'ADM': 'ADMINISTRASI',            'KU':  'KEUANGAN',
            'PL':  'PERLENGKAPAN',            'HM':  'HUMAS',
            'PR':  'PERENCANAAN',             'KS':  'KERJA SAMA'
        };
        return map[prefix] || prefix;
    }

    // ════════════════════════════════════════════════════════════
    //  EXPORT — EXCEL
    // ════════════════════════════════════════════════════════════

    async function exportExcel() {
        try {
            Swal.fire({
                title: 'Memproses Export...',
                html: 'Menyusun data Excel...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const allData = arsipTable.rows().data().toArray();
            if (allData.length === 0) {
                Swal.fire('Info', 'Tidak ada data untuk di-export', 'info');
                return;
            }

            const wb = XLSX.utils.book_new();

            // ── Style Definitions ──
            const borderAll = {
                top: { style: 'thin' }, bottom: { style: 'thin' },
                left: { style: 'thin' }, right: { style: 'thin' }
            };

            const styles = {
                base: {
                    font: { name: 'Arial', sz: 10 },
                    alignment: { wrapText: true, vertical: 'top', horizontal: 'left' },
                    border: borderAll
                },
                center: {
                    font: { name: 'Arial', sz: 10 },
                    alignment: { wrapText: true, vertical: 'top', horizontal: 'center' },
                    border: borderAll
                },
                noTop: {
                    font: { name: 'Arial', sz: 10 },
                    alignment: { wrapText: true, vertical: 'top', horizontal: 'left' },
                    border: { ...borderAll, top: { style: 'none' } }
                },
                centerNoTop: {
                    font: { name: 'Arial', sz: 10 },
                    alignment: { wrapText: true, vertical: 'top', horizontal: 'center' },
                    border: { ...borderAll, top: { style: 'none' } }
                },
                header: {
                    font: { name: 'Arial', sz: 10, bold: true },
                    alignment: { wrapText: true, vertical: 'center', horizontal: 'center' },
                    fill: { fgColor: { rgb: 'DDEBF7' } },
                    border: borderAll
                },
                title: {
                    font: { name: 'Arial', sz: 14, bold: true },
                    alignment: { horizontal: 'center' }
                },
                divider: {
                    font: { name: 'Arial', sz: 11, bold: true },
                    fill: { fgColor: { rgb: 'E9ECEF' } },
                    border: borderAll,
                    alignment: { vertical: 'center', horizontal: 'left' }
                }
            };

            // ── Group data by prefix ──
            const groupedByPrefix = {};
            allData.forEach(item => {
                const prefix = String(item.kode?.Kode || 'LAIN').split('.')[0];
                if (!groupedByPrefix[prefix]) groupedByPrefix[prefix] = [];
                groupedByPrefix[prefix].push(item);
            });

            const sortedPrefixes = Object.keys(groupedByPrefix).sort();

            // ── Per-prefix sheets ──
            sortedPrefixes.forEach(prefix => {
                const rows = [];

                // Title rows
                rows.push([{ v: 'DAFTAR ISI BERKAS', s: styles.title }]);
                rows.push(['']);
                rows.push([{ v: 'KANTOR PENCARIAN DAN PERTOLONGAN TARAKAN', s: styles.title }]);

                // Header
                const headers = ['NO', 'NO BERKAS', 'JUDUL BERKAS', 'NO ITEM ARSIP', 'KODE KLASIFIKASI', '', 'URAIAN INFORMASI ARSIP', 'TANGGAL', 'JUMLAH', 'KEAMANAN', 'KETERANGAN'];
                rows.push(headers.map(h => ({ v: h, s: styles.header })));

                const subHeaders = ['(1)', '(2)', '(3)', '(4)', '(5)', '(6)', '(7)', '(8)', '(9)', '(10)', '(11)'];
                rows.push(subHeaders.map(h => ({ v: h, s: styles.header })));

                // Prefix divider
                rows.push([
                    { v: '', s: styles.divider },
                    { v: prefix, s: styles.divider },
                    { v: getCategoryName(prefix), s: styles.divider },
                    ...Array(8).fill({ v: '', s: styles.divider })
                ]);

                // Sort data
                const dataSorted = groupedByPrefix[prefix].sort((a, b) => {
                    const cmpKode = String(a.kode?.Kode || '').localeCompare(String(b.kode?.Kode || ''), undefined, { numeric: true, sensitivity: 'base' });
                    if (cmpKode !== 0) return cmpKode;
                    const cmpNo = String(a.hal?.nomor || '').localeCompare(String(b.hal?.nomor || ''), undefined, { numeric: true });
                    if (cmpNo !== 0) return cmpNo;
                    return String(a.hal?.judul_berkas || '').localeCompare(String(b.hal?.judul_berkas || ''));
                });

                let lastNoB = null, lastJudul = null, counter = 1;

                dataSorted.forEach(item => {
                    const curNoB = String(item.hal?.nomor || '');
                    const curJudul = String(item.hal?.judul_berkas || '');
                    const isNew = (curNoB !== lastNoB) || (curJudul !== lastJudul);

                    rows.push([
                        { v: isNew ? counter++ : '', s: isNew ? styles.center : styles.centerNoTop },
                        { v: isNew ? curNoB : '', s: isNew ? styles.base : styles.noTop },
                        { v: isNew ? curJudul : '', s: isNew ? styles.base : styles.noTop },
                        { v: item.no_arsip || '-', s: styles.center },
                        { v: item.kode?.Kode || '', s: styles.base },
                        { v: item.kode?.Detail_kode || '', s: styles.base },
                        { v: item.uraian_informasi || '', s: styles.base },
                        { v: formatTanggalIndo(item.tanggal), s: styles.center },
                        { v: `${item.jumlah || '0'} ${item.satuan || ''}`, s: styles.center },
                        { v: item.keamanan || 'Biasa', s: styles.center },
                        { v: item.keterangan || 'Tekstual', s: styles.base }
                    ]);

                    lastNoB = curNoB;
                    lastJudul = curJudul;
                });

                const ws = XLSX.utils.aoa_to_sheet(rows);
                ws['!cols'] = [{ wch: 5 }, { wch: 15 }, { wch: 35 }, { wch: 10 }, { wch: 12 }, { wch: 25 }, { wch: 40 }, { wch: 15 }, { wch: 10 }, { wch: 15 }, { wch: 15 }];
                ws['!merges'] = [
                    { s: { r: 0, c: 0 }, e: { r: 0, c: 10 } },
                    { s: { r: 2, c: 0 }, e: { r: 2, c: 10 } },
                    { s: { r: 3, c: 4 }, e: { r: 3, c: 5 } },
                    { s: { r: 5, c: 2 }, e: { r: 5, c: 10 } }
                ];
                XLSX.utils.book_append_sheet(wb, ws, prefix);
            });

            // ── Summary Sheet ──
            const sRows = [];
            sRows.push([{ v: 'DAFTAR BERKAS', s: styles.title }]);
            sRows.push([{ v: 'KANTOR PENCARIAN DAN PERTOLONGAN TARAKAN', s: styles.title }]);
            sRows.push(['']);

            const sumHeaders = ['NO', 'NO BERKAS', 'KODE KLASIFIKASI', '', 'URAIAN INFORMASI BERKAS', 'KURUN WAKTU', 'JUMLAH', 'KETERANGAN', 'KEAMANAN'];
            sRows.push(sumHeaders.map(h => ({ v: h, s: styles.header })));
            sRows.push(['(1)', '(2)', '(3)', '(4)', '(5)', '(6)', '(7)', '(8)', '(9)'].map(h => ({ v: h, s: styles.header })));

            let currentRow = 5;
            const summaryMerges = [
                { s: { r: 0, c: 0 }, e: { r: 0, c: 8 } },
                { s: { r: 1, c: 0 }, e: { r: 1, c: 8 } },
                { s: { r: 3, c: 2 }, e: { r: 3, c: 3 } }
            ];

            sortedPrefixes.forEach(prefix => {
                sRows.push([
                    { v: '', s: styles.divider },
                    { v: prefix, s: styles.divider },
                    { v: getCategoryName(prefix), s: styles.divider },
                    ...Array(6).fill({ v: '', s: styles.divider })
                ]);
                summaryMerges.push({ s: { r: currentRow, c: 2 }, e: { r: currentRow, c: 8 } });
                currentRow++;

                // Group by nomor + judul
                const berkasMap = {};
                groupedByPrefix[prefix].forEach(item => {
                    const key = `${item.hal?.nomor || ''}|${item.hal?.judul_berkas || ''}`;
                    if (!berkasMap[key]) {
                        berkasMap[key] = { data: item, count: 0, years: [] };
                    }
                    berkasMap[key].count++;
                    if (item.tanggal) berkasMap[key].years.push(new Date(item.tanggal).getFullYear());
                });

                Object.values(berkasMap)
                    .sort((a, b) => {
                        const cmpKode = String(a.data.kode?.Kode || '').localeCompare(String(b.data.kode?.Kode || ''), undefined, { numeric: true, sensitivity: 'base' });
                        if (cmpKode !== 0) return cmpKode;
                        const cmpNo = String(a.data.hal?.nomor || '').localeCompare(String(b.data.hal?.nomor || ''), undefined, { numeric: true });
                        if (cmpNo !== 0) return cmpNo;
                        return String(a.data.hal?.judul_berkas || '').localeCompare(String(b.data.hal?.judul_berkas || ''));
                    })
                    .forEach((b, idx) => {
                        const item = b.data;
                        let kurun = '-';
                        if (b.years.length > 0) {
                            const min = Math.min(...b.years), max = Math.max(...b.years);
                            kurun = min === max ? `${min}` : `${min} - ${max}`;
                        }

                        sRows.push([
                            { v: idx + 1, s: styles.center },
                            { v: item.hal?.nomor || '', s: styles.base },
                            { v: item.kode?.Kode || '', s: styles.base },
                            { v: item.kode?.Detail_kode || '', s: styles.base },
                            { v: item.hal?.judul_berkas || '', s: styles.base },
                            { v: kurun, s: styles.center },
                            { v: `${b.count} Item`, s: styles.center },
                            { v: item.keterangan || 'Tekstual', s: styles.base },
                            { v: item.keamanan || 'Biasa', s: styles.center }
                        ]);
                        currentRow++;
                    });
            });

            const wsSum = XLSX.utils.aoa_to_sheet(sRows);
            wsSum['!merges'] = summaryMerges;
            wsSum['!cols'] = [{ wch: 5 }, { wch: 15 }, { wch: 12 }, { wch: 25 }, { wch: 40 }, { wch: 15 }, { wch: 10 }, { wch: 15 }, { wch: 15 }];
            XLSX.utils.book_append_sheet(wb, wsSum, 'DAFTAR BERKAS');

            // Save
            XLSX.writeFile(wb, `DATA_ARSIP_${new Date().toISOString().slice(0, 10)}.xlsx`);
            Swal.close();
        } catch (error) {
            console.error(error);
            Swal.fire({ icon: 'error', title: 'Export Gagal', text: error.message });
        }
    }

    // ════════════════════════════════════════════════════════════
    //  EXPORT — PDF
    // ════════════════════════════════════════════════════════════

    async function exportPDF() {
        try {
            showLoading('Memproses Export PDF...');

            const allData = arsipTable.rows().data().toArray();
            if (allData.length === 0) {
                Swal.fire({ icon: 'warning', title: 'Tidak Ada Data', text: 'Tidak ada data untuk diekspor' });
                return;
            }

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('landscape', 'mm', 'a4');
            const pageWidth = doc.internal.pageSize.getWidth();

            // Title
            doc.setFontSize(16);
            doc.setFont(undefined, 'bold');
            doc.text('DATA ARSIP', pageWidth / 2, 15, { align: 'center' });

            doc.setFontSize(10);
            doc.setFont(undefined, 'normal');
            doc.text('Sistem Manajemen Arsip', pageWidth / 2, 22, { align: 'center' });
            doc.text(`Tanggal Export: ${new Date().toLocaleDateString('id-ID')}`, pageWidth / 2, 28, { align: 'center' });

            // Table data
            const tableData = allData.map((data, index) => [
                index + 1,
                data.no_arsip || '-',
                data.hal?.judul_berkas || '-',
                data.hal?.nomor || '-',
                data.kode?.Kode || '-',
                data.uraian_informasi || '-',
                data.tanggal ? new Date(data.tanggal).toLocaleDateString('id-ID') : '-',
                `${data.jumlah || '-'} ${data.satuan || ''}`.trim(),
                data.keamanan || '-',
                data.keterangan || '-'
            ]);

            doc.autoTable({
                startY: 35,
                head: [['No', 'No Arsip', 'Judul Berkas', 'No Berkas', 'Kode', 'Uraian', 'Tanggal', 'Jumlah', 'Keamanan', 'Ket']],
                body: tableData,
                theme: 'grid',
                headStyles: { fillColor: [41, 128, 185], textColor: 255, fontStyle: 'bold', halign: 'center', fontSize: 8 },
                bodyStyles: { fontSize: 7, cellPadding: 2 },
                columnStyles: {
                    0: { cellWidth: 10, halign: 'center' },
                    1: { cellWidth: 20 },
                    2: { cellWidth: 40 },
                    3: { cellWidth: 20 },
                    4: { cellWidth: 20 },
                    5: { cellWidth: 50 },
                    6: { cellWidth: 20, halign: 'center' },
                    7: { cellWidth: 20, halign: 'center' },
                    8: { cellWidth: 20, halign: 'center' },
                    9: { cellWidth: 20 }
                },
                margin: { top: 35, left: 10, right: 10 },
                didDrawPage: (data) => {
                    const pageCount = doc.internal.getNumberOfPages();
                    const pageHeight = doc.internal.pageSize.getHeight();
                    doc.setFontSize(8);
                    doc.text(`Halaman ${data.pageNumber} dari ${pageCount}`, pageWidth / 2, pageHeight - 10, { align: 'center' });
                }
            });

            const timestamp = new Date().toISOString().replace(/[:.]/g, '-').slice(0, -5);
            doc.save(`Data_Arsip_${timestamp}.pdf`);

            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'File PDF berhasil diunduh', timer: 2000, showConfirmButton: false });
        } catch (error) {
            console.error('Error export PDF:', error);
            Swal.fire({ icon: 'error', title: 'Gagal Export', text: error.message });
        }
    }
    // ════════════════════════════════════════════════════════════
//  HELPER: Default tanggal berdasarkan filter tahun
// ════════════════════════════════════════════════════════════

/**
 * Ambil tahun yang dipilih di filter
 */
function getSelectedYear() {
    const val = document.getElementById('filterTahun')?.value;
    return val ? parseInt(val) : null;
}

/**
 * Set DEFAULT value pada input tanggal yang masih kosong
 * Tidak ada min/max — user bebas ganti ke tahun manapun
 */
function applyDefaultTanggal() {
    const tahun = getSelectedYear();
    if (!tahun) return;

    const inputs = document.querySelectorAll('input[name="tanggal[]"]');
    const today = new Date();

    inputs.forEach(input => {
        // Hanya isi kalau masih kosong
        if (!input.value) {
            if (today.getFullYear() === tahun) {
                // Tahun sama dengan sekarang → pakai hari ini
                input.value = today.toISOString().slice(0, 10);
            } else {
                // Tahun berbeda → default 1 Januari tahun itu
                input.value = `${tahun}-01-01`;
            }
        }
    });
}
    </script>
</body>
</html>
