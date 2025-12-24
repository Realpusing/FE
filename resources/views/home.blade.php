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

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">

    <!-- SheetJS for Excel Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!-- jsPDF for PDF Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

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

        .grouped-row td {
            border-top: none !important;
        }

        .action-group-cell {
            vertical-align: middle !important;
            background-color: #f8f9fa !important;
            font-weight: 600;
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

        @media (max-width: 768px) {
            .main-content {
                margin-left: 70px;
            }

            .main-content.expanded {
                margin-left: 0;
            }
        }

        /* SweetAlert2 Custom Styling */
        .swal2-popup {
            border-radius: 1rem !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }

        .swal2-title {
            font-weight: 700 !important;
        }

        .swal2-confirm {
            border-radius: 2rem !important;
            padding: 0.75rem 2rem !important;
            font-weight: 600 !important;
        }

        .swal2-cancel {
            border-radius: 2rem !important;
            padding: 0.75rem 2rem !important;
            font-weight: 600 !important;
        }
    </style>
</head>
<body>
@include('sidebar')
    <div class="main-content" id="mainContent">
        <div class="container-fluid">
            <div class="header-section text-center shadow-sm">
                <h1 class="mb-2"><i class="bi bi-folder2-open"></i> Sistem Manajemen Arsip</h1>
                <p class="mb-0">Daftar Berkas dan Item Arsip</p>
            </div>

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

    <!-- Modal Tambah/Edit -->
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
                    <button type="button" class="btn btn-primary" id="btnSimpan" onclick="simpanData()">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Group Action -->
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

    <script>
        let itemCounter = 0;
        let kodeKlasifikasi = [];
        let arsipTable;
        let modalTambah;
        let modalGroupAction;
        let currentGroupIds = [];
        let currentEditId = null;
        let isEditMode = false;

        // Generate No Berkas
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
                }
            } catch (error) {
                console.error('Error generating no berkas:', error);
                noBerkasInput.value = '1';
                noBerkasInput.placeholder = '1';
            }
        }

        // Load Kode Klasifikasi
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

        // Update Klasifikasi Dropdown
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
                        }
                        return [];
                    },
                    error: function(xhr, error, thrown) {
                        console.error('Error loading data:', error, thrown);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Memuat Data',
                            text: 'Tidak dapat memuat data dari server',
                            confirmButtonColor: '#d33'
                        });
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
                        data: 'keterangan',
                        defaultContent: '-'
                    },
                    {
                        data: 'id',
                        orderable: false,
                        render: function(data) {
                            return `<div class="action-cell" data-id="${data}"></div>`;
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
                    var groupMap = {};

                    api.rows({page: 'current'}).every(function(rowIdx) {
                        var data = this.data();
                        var nomor = data.hal && data.hal.nomor ? data.hal.nomor : '';
                        var judul = data.hal && data.hal.judul_berkas ? data.hal.judul_berkas : '';
                        var kode = data.kode && data.kode.Kode ? data.kode.Kode : '';
                        var groupKey = nomor + '|' + judul + '|' + kode;

                        if (!groupMap[groupKey]) {
                            groupMap[groupKey] = {
                                ids: [],
                                firstRowIdx: rowIdx,
                                nomor: nomor,
                                judul: judul,
                                kode: kode
                            };
                        }
                        groupMap[groupKey].ids.push(data.id);
                    });

                    var lastGroup = null;
                    api.rows({page: 'current'}).every(function(rowIdx) {
                        var data = this.data();
                        var nomor = data.hal && data.hal.nomor ? data.hal.nomor : '';
                        var judul = data.hal && data.hal.judul_berkas ? data.hal.judul_berkas : '';
                        var kode = data.kode && data.kode.Kode ? data.kode.Kode : '';
                        var currentGroup = nomor + '|' + judul + '|' + kode;

                        var groupInfo = groupMap[currentGroup];
                        var groupSize = groupInfo.ids.length;

                        if (lastGroup === currentGroup && lastGroup !== '') {
                            $(rows[rowIdx]).addClass('grouped-row');
                            $(rows[rowIdx]).find('td:eq(1)').html('');
                            $(rows[rowIdx]).find('td:eq(2)').html('');
                            $(rows[rowIdx]).find('td:eq(4)').html('');
                            $(rows[rowIdx]).find('td:eq(10)').html('');

                            $(rows[rowIdx]).find('td:eq(1)').css('border-top', 'none');
                            $(rows[rowIdx]).find('td:eq(2)').css('border-top', 'none');
                            $(rows[rowIdx]).find('td:eq(4)').css('border-top', 'none');
                            $(rows[rowIdx]).find('td:eq(10)').css('border-top', 'none');
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

                            var actionCell = $(rows[rowIdx]).find('.action-cell');
                            var actionHtml = '';

                            if (groupSize > 1) {
                                actionHtml = `
                                    <button class="btn btn-outline-primary btn-sm"
                                            onclick='showGroupAction(${JSON.stringify(groupInfo.ids)}, "${groupInfo.nomor}", "${groupInfo.judul}")'
                                            title="Aksi Group (${groupSize} data)">
                                        <i class="bi bi-gear"></i>
                                        <span class="badge bg-primary">${groupSize}</span>
                                    </button>
                                `;
                                $(rows[rowIdx]).find('td:eq(10)').addClass('action-group-cell');
                            } else {
                                actionHtml = `
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button class="btn btn-outline-primary" onclick="editArsip(${data.id})" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" onclick="hapusArsip(${data.id})" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                `;
                            }

                            actionCell.html(actionHtml);
                        }

                        lastGroup = currentGroup;
                    });
                }
            });
        }

        // Show Group Action
        function showGroupAction(ids, nomor, judul) {
            currentGroupIds = ids;
            const infoHtml = `
                <strong>No Berkas:</strong> ${nomor}<br>
                <strong>Judul:</strong> ${judul}<br>
                <strong>Jumlah Data:</strong> ${ids.length} item
            `;
            document.getElementById('groupDataInfo').innerHTML = infoHtml;
            modalGroupAction.show();
        }

        // Edit Arsip
        async function editArsip(id) {
            if (kodeKlasifikasi.length === 0) {
                await loadKodeKlasifikasi();
            }

            try {
                Swal.fire({
                    title: 'Memuat Data...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const url = `http://127.0.0.1:8000/api/arsip/${id}`;
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const result = await response.json();

                if (!result.data) {
                    throw new Error('Data tidak ditemukan');
                }

                const firstData = result.data;
                const idHal = firstData.id_hal;

                const allDataResponse = await fetch('http://127.0.0.1:8000/api/berkas', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (!allDataResponse.ok) {
                    throw new Error('Gagal mengambil data berkas lengkap');
                }

                const allDataResult = await allDataResponse.json();
                const groupData = allDataResult.data.filter(item => item.id_hal === idHal);

                currentGroupIds = groupData.map(item => item.id);
                currentEditId = null;
                isEditMode = true;

                document.getElementById('modalTambahLabel').innerHTML = '<i class="bi bi-pencil-square"></i> Edit Data Arsip';
                document.getElementById('judul_berkas').value = firstData.hal?.judul_berkas || '';
                document.getElementById('no_berkas').value = firstData.hal?.nomor || '';

                const container = document.getElementById('itemArsipContainer');
                container.innerHTML = '';
                itemCounter = 0;

                groupData.forEach((data, index) => {
                    itemCounter = index + 1;
                    const isFirstItem = index === 0;
                    const itemHTML = getItemArsipHTML(itemCounter, !isFirstItem);
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = itemHTML;
                    container.appendChild(tempDiv.firstElementChild);
                });

                setTimeout(() => {
                    const items = document.querySelectorAll('.item-arsip-container');

                    items.forEach((item, index) => {
                        const data = groupData[index];

                        if (index === 0) {
                            const noItemInput = document.getElementById('no_item_master');
                            if (noItemInput) noItemInput.value = data.no_arsip || '';

                            const kodeSelect = document.getElementById('kode_klasifikasi_master');
                            if (kodeSelect && data.kode) {
                                const kodeValue = data.kode.Kode || '';
                                const detailValue = data.kode.Detail_kode || '';
                                const combinedValue = `${kodeValue}|${detailValue}`;
                                kodeSelect.value = combinedValue;

                                if (kodeValue) {
                                    generateNoBerkas(kodeValue);
                                }
                            }
                        }

                        const tanggalInput = item.querySelector('input[name="tanggal[]"]');
                        if (tanggalInput) tanggalInput.value = data.tanggal || '';

                        const jumlahInput = item.querySelector('input[name="jumlah_angka[]"]');
                        if (jumlahInput) jumlahInput.value = data.jumlah || '';

                        const satuanSelect = item.querySelector('select[name="jumlah[]"]');
                        if (satuanSelect) satuanSelect.value = (data.satuan || '').toLowerCase();

                        const keamananSelect = item.querySelector('select[name="klasifikasi_keamanan[]"]');
                        if (keamananSelect) {
                            const keamananValue = (data.keamanan || 'biasa').toLowerCase().replace(/\s+/g, '-');
                            keamananSelect.value = keamananValue;
                        }

                        const uraianTextarea = item.querySelector('textarea[name="uraian[]"]');
                        if (uraianTextarea) uraianTextarea.value = data.uraian_informasi || '';

                        const keteranganInput = item.querySelector('input[name="keterangan[]"]');
                        if (keteranganInput) keteranganInput.value = data.keterangan || '';
                    });

                    updateAllNoItem();
                    updateAllKodeKlasifikasi();
                }, 150);

                const saveButton = document.getElementById('btnSimpan');
                if (saveButton) {
                    saveButton.innerHTML = '<i class="bi bi-save"></i> Update Data';
                    saveButton.onclick = function() { updateArsipFromModal(); };
                }

                Swal.close();
                modalTambah.show();

            } catch (error) {
                console.error('Error in edit arsip:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Data',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
            }
        }

        // Update Arsip From Modal
        async function updateArsipFromModal() {
            const form = document.getElementById('formTambahArsip');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const isGroupEdit = currentGroupIds && currentGroupIds.length > 0;

            if (!isGroupEdit && !currentEditId) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ID data tidak ditemukan',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            const result = await Swal.fire({
                title: 'Konfirmasi Update',
                text: `Anda akan mengupdate ${isGroupEdit ? currentGroupIds.length : 1} data. Lanjutkan?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal'
            });

            if (!result.isConfirmed) return;

            Swal.fire({
                title: 'Mengupdate Data...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData(form);
            const kodeKlasifikasiArray = formData.getAll('kode_klasifikasi[]');
            const tanggal = formData.getAll('tanggal[]');
            const jumlahAngka = formData.getAll('jumlah_angka[]');
            const jumlah = formData.getAll('jumlah[]');
            const klasifikasiKeamanan = formData.getAll('klasifikasi_keamanan[]');
            const uraian = formData.getAll('uraian[]');
            const keterangan = formData.getAll('keterangan[]');

            if (kodeKlasifikasiArray.length === 0 || !kodeKlasifikasiArray[0]) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Kode klasifikasi harus dipilih!',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            const [kode, detail] = kodeKlasifikasiArray[0].split('|');

            try {
                let successCount = 0;
                let failCount = 0;
                const errors = [];

                if (isGroupEdit) {
                    for (let i = 0; i < currentGroupIds.length; i++) {
                        const itemId = currentGroupIds[i];

                        const itemData = {
                            no_arsip: formData.get('no_berkas')?.trim(),
                            kode_klasifikasi: kode.trim(),
                            uraian_informasi: uraian[i]?.trim(),
                            tanggal: tanggal[i],
                            jumlah: parseFloat(jumlahAngka[i]) || 0,
                            satuan: jumlah[i],
                            keamanan: klasifikasiKeamanan[i],
                            keterangan: keterangan[i]?.trim() || ''
                        };

                        try {
                            const response = await fetch(`http://127.0.0.1:8000/api/arsip/${itemId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(itemData)
                            });

                            const result = await response.json();

                            if (response.ok) {
                                successCount++;
                            } else {
                                failCount++;
                                errors.push(`Item ${i + 1}: ${result.message || 'Unknown error'}`);
                            }
                        } catch (error) {
                            failCount++;
                            errors.push(`Item ${i + 1}: ${error.message}`);
                        }
                    }

                    if (failCount === 0) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `${successCount} data berhasil diupdate`,
                            confirmButtonColor: '#28a745'
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Update Selesai dengan Error',
                            html: `<p>Berhasil: ${successCount} item</p><p>Gagal: ${failCount} item</p><p>Detail: ${errors.join('<br>')}</p>`,
                            confirmButtonColor: '#ffc107'
                        });
                    }
                } else {
                    const data = {
                        no_arsip: formData.get('no_berkas')?.trim(),
                        kode_klasifikasi: kode.trim(),
                        uraian_informasi: uraian[0]?.trim(),
                        tanggal: tanggal[0],
                        jumlah: parseFloat(jumlahAngka[0]) || 0,
                        satuan: jumlah[0],
                        keamanan: klasifikasiKeamanan[0],
                        keterangan: keterangan[0]?.trim() || ''
                    };

                    const response = await fetch(`http://127.0.0.1:8000/api/arsip/${currentEditId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        throw new Error(result.message || 'Gagal mengupdate data');
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil diupdate',
                        confirmButtonColor: '#28a745'
                    });
                }

                resetModalTambah();
                modalTambah.hide();
                form.reset();
                currentEditId = null;
                currentGroupIds = [];
                isEditMode = false;
                arsipTable.ajax.reload();

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Update',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
            }
        }

        // Reset Modal Tambah
        function resetModalTambah() {
            document.getElementById('modalTambahLabel').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Data Arsip';

            const saveButton = document.getElementById('btnSimpan');
            if (saveButton) {
                saveButton.innerHTML = '<i class="bi bi-save"></i> Simpan Data';
                saveButton.onclick = function() { simpanData(); };
            }

            currentEditId = null;
            currentGroupIds = [];
            isEditMode = false;

            const form = document.getElementById('formTambahArsip');
            if (form) form.reset();

            const container = document.getElementById('itemArsipContainer');
            if (container) container.innerHTML = '';

            itemCounter = 0;
        }

        // Tambah Data
        function tambahData() {
            resetModalTambah();
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

        // Edit Group
        async function editGroup() {
            if (!currentGroupIds || currentGroupIds.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tidak ada data group yang dipilih',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            modalGroupAction.hide();
            await editArsip(currentGroupIds[0]);
        }

        // Hapus Group
        async function hapusGroup() {
            if (!currentGroupIds || currentGroupIds.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tidak ada data group yang dipilih',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            const result = await Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Anda akan menghapus ${currentGroupIds.length} data. Tindakan ini tidak dapat dibatalkan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            });

            if (!result.isConfirmed) return;

            modalGroupAction.hide();

            Swal.fire({
                title: 'Menghapus Data...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                let successCount = 0;
                let failCount = 0;

                for (const id of currentGroupIds) {
                    try {
                        const response = await fetch(`http://127.0.0.1:8000/api/arsip/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        });

                        if (response.ok) {
                            successCount++;
                        } else {
                            failCount++;
                        }
                    } catch (error) {
                        failCount++;
                    }
                }

                if (failCount === 0) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `${successCount} data berhasil dihapus`,
                        confirmButtonColor: '#28a745'
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Hapus Selesai dengan Error',
                        text: `Berhasil: ${successCount}, Gagal: ${failCount}`,
                        confirmButtonColor: '#ffc107'
                    });
                }

                currentGroupIds = [];
                arsipTable.ajax.reload();

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Hapus',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
            }
        }

        // Hapus Arsip Single
        async function hapusArsip(id) {
            const result = await Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            });

            if (!result.isConfirmed) return;

            Swal.fire({
                title: 'Menghapus Data...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const response = await fetch(`http://127.0.0.1:8000/api/arsip/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menghapus data');
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dihapus',
                    confirmButtonColor: '#28a745'
                });

                arsipTable.ajax.reload();

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Hapus',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
            }
        }

        // Get Item Arsip HTML
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

        // Update All No Item
        function updateAllNoItem() {
            const masterValue = document.getElementById('no_item_master').value;
            const hiddenInputs = document.querySelectorAll('.hidden-no-item');
            const displaySpans = document.querySelectorAll('.inherited-no-item');

            hiddenInputs.forEach(input => input.value = masterValue);
            displaySpans.forEach(span => span.textContent = masterValue || '-');
        }

        // Update All Kode Klasifikasi
        function updateAllKodeKlasifikasi() {
            const masterSelect = document.getElementById('kode_klasifikasi_master');
            const masterValue = masterSelect.value;
            const masterText = masterSelect.options[masterSelect.selectedIndex].text;
            const hiddenInputs = document.querySelectorAll('.hidden-kode');
            const displaySpans = document.querySelectorAll('.inherited-kode');

            hiddenInputs.forEach(input => input.value = masterValue);
            displaySpans.forEach(span => span.textContent = masterText || '-');
        }

        // Handle Kode Change
        function handleKodeChange() {
            const masterSelect = document.getElementById('kode_klasifikasi_master');
            if (masterSelect && masterSelect.value) {
                const [kode, detail] = masterSelect.value.split('|');
                generateNoBerkas(kode);
            }
        }

        // Tambah Item Arsip
        function tambahItemArsip() {
            itemCounter++;
            const container = document.getElementById('itemArsipContainer');
            const newItem = document.createElement('div');
            newItem.innerHTML = getItemArsipHTML(itemCounter, true);
            container.appendChild(newItem.firstElementChild);

            updateAllNoItem();
            updateAllKodeKlasifikasi();
        }

        // Hapus Item Arsip
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

            const result = await Swal.fire({
                title: 'Konfirmasi Simpan',
                text: 'Anda yakin ingin menyimpan data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            });

            if (!result.isConfirmed) return;

            Swal.fire({
                title: 'Menyimpan Data...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

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
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Minimal harus ada 1 item arsip!',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            for (let i = 0; i < kodeKlasifikasiArray.length; i++) {
                const kodeValue = kodeKlasifikasiArray[i];
                if (!kodeValue) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: `Item ${i + 1}: Kode klasifikasi harus dipilih!`,
                        confirmButtonColor: '#d33'
                    });
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

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message || 'Data berhasil disimpan!',
                    confirmButtonColor: '#28a745'
                });

                modalTambah.hide();
                form.reset();

                const container = document.getElementById('itemArsipContainer');
                container.innerHTML = '';
                itemCounter = 0;

                arsipTable.ajax.reload();

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
            }
        }

        // Export Excel
        async function exportExcel() {
            try {
                Swal.fire({
                    title: 'Memproses Export Excel...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Ambil semua data dari tabel
                const allData = arsipTable.rows().data().toArray();

                if (allData.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada Data',
                        text: 'Tidak ada data untuk diekspor',
                        confirmButtonColor: '#ffc107'
                    });
                    return;
                }

                // Prepare data untuk Excel
                const excelData = [];

                // Header
                excelData.push([
                    'No',
                    'No Arsip',
                    'Judul Berkas',
                    'Nomor Berkas',
                    'Kode Klasifikasi',
                    'Detail Klasifikasi',
                    'Uraian Informasi',
                    'Tanggal',
                    'Jumlah',
                    'Satuan',
                    'Keamanan',
                    'Keterangan'
                ]);

                // Data rows
                allData.forEach((data, index) => {
                    excelData.push([
                        index + 1,
                        data.no_arsip || '-',
                        data.hal?.judul_berkas || '-',
                        data.hal?.nomor || '-',
                        data.kode?.Kode || '-',
                        data.kode?.Detail_kode || '-',
                        data.uraian_informasi || '-',
                        data.tanggal ? new Date(data.tanggal).toLocaleDateString('id-ID') : '-',
                        data.jumlah || '-',
                        data.satuan || '-',
                        data.keamanan || '-',
                        data.keterangan || '-'
                    ]);
                });

                // Create workbook
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(excelData);

                // Set column widths
                ws['!cols'] = [
                    { wch: 5 },  // No
                    { wch: 15 }, // No Arsip
                    { wch: 30 }, // Judul Berkas
                    { wch: 15 }, // Nomor Berkas
                    { wch: 15 }, // Kode Klasifikasi
                    { wch: 30 }, // Detail Klasifikasi
                    { wch: 40 }, // Uraian Informasi
                    { wch: 12 }, // Tanggal
                    { wch: 10 }, // Jumlah
                    { wch: 10 }, // Satuan
                    { wch: 15 }, // Keamanan
                    { wch: 20 }  // Keterangan
                ];

                // Add worksheet to workbook
                XLSX.utils.book_append_sheet(wb, ws, 'Data Arsip');

                // Generate filename
                const timestamp = new Date().toISOString().replace(/[:.]/g, '-').slice(0, -5);
                const filename = `Data_Arsip_${timestamp}.xlsx`;

                // Download file
                XLSX.writeFile(wb, filename);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'File Excel berhasil diunduh',
                    timer: 2000,
                    showConfirmButton: false
                });

            } catch (error) {
                console.error('Error export Excel:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Export',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
            }
        }

        // Export PDF
        async function exportPDF() {
            try {
                Swal.fire({
                    title: 'Memproses Export PDF...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Ambil semua data dari tabel
                const allData = arsipTable.rows().data().toArray();

                if (allData.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada Data',
                        text: 'Tidak ada data untuk diekspor',
                        confirmButtonColor: '#ffc107'
                    });
                    return;
                }

                // Initialize jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF('landscape', 'mm', 'a4');

                // Title
                doc.setFontSize(16);
                doc.setFont(undefined, 'bold');
                doc.text('DATA ARSIP', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });

                doc.setFontSize(10);
                doc.setFont(undefined, 'normal');
                doc.text('Sistem Manajemen Arsip', doc.internal.pageSize.getWidth() / 2, 22, { align: 'center' });
                doc.text(`Tanggal Export: ${new Date().toLocaleDateString('id-ID')}`, doc.internal.pageSize.getWidth() / 2, 28, { align: 'center' });

                // Prepare table data
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

                // Add table
                doc.autoTable({
                    startY: 35,
                    head: [[
                        'No',
                        'No Arsip',
                        'Judul Berkas',
                        'No Berkas',
                        'Kode',
                        'Uraian',
                        'Tanggal',
                        'Jumlah',
                        'Keamanan',
                        'Ket'
                    ]],
                    body: tableData,
                    theme: 'grid',
                    headStyles: {
                        fillColor: [41, 128, 185],
                        textColor: 255,
                        fontStyle: 'bold',
                        halign: 'center',
                        fontSize: 8
                    },
                    bodyStyles: {
                        fontSize: 7,
                        cellPadding: 2
                    },
                    columnStyles: {
                        0: { cellWidth: 10, halign: 'center' },  // No
                        1: { cellWidth: 20 },  // No Arsip
                        2: { cellWidth: 40 },  // Judul Berkas
                        3: { cellWidth: 20 },  // No Berkas
                        4: { cellWidth: 20 },  // Kode
                        5: { cellWidth: 50 },  // Uraian
                        6: { cellWidth: 20, halign: 'center' },  // Tanggal
                        7: { cellWidth: 20, halign: 'center' },  // Jumlah
                        8: { cellWidth: 20, halign: 'center' },  // Keamanan
                        9: { cellWidth: 20 }   // Keterangan
                    },
                    margin: { top: 35, left: 10, right: 10 },
                    didDrawPage: function(data) {
                        // Footer
                        const pageCount = doc.internal.getNumberOfPages();
                        const pageSize = doc.internal.pageSize;
                        const pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();

                        doc.setFontSize(8);
                        doc.text(
                            `Halaman ${data.pageNumber} dari ${pageCount}`,
                            pageSize.getWidth() / 2,
                            pageHeight - 10,
                            { align: 'center' }
                        );
                    }
                });

                // Generate filename
                const timestamp = new Date().toISOString().replace(/[:.]/g, '-').slice(0, -5);
                const filename = `Data_Arsip_${timestamp}.pdf`;

                // Download file
                doc.save(filename);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'File PDF berhasil diunduh',
                    timer: 2000,
                    showConfirmButton: false
                });

            } catch (error) {
                console.error('Error export PDF:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Export',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
            }
        }

        // Initialization
        document.addEventListener('DOMContentLoaded', function() {
            console.log('=== PAGE LOADING ===');

            // Initialize modals
            modalTambah = new bootstrap.Modal(document.getElementById('modalTambah'));
            modalGroupAction = new bootstrap.Modal(document.getElementById('modalGroupAction'));
            console.log('Modals initialized');

            // Load klasifikasi first
            loadKodeKlasifikasi().then(() => {
                console.log('Klasifikasi loaded, initializing DataTable...');
                initDataTable();
            });

            // Handle sidebar
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('mainContent');
            if (sidebar && main) {
                main.classList.toggle('sidebar-collapsed', sidebar.classList.contains('collapsed'));
            }

            console.log('=== PAGE LOADED ===');

            // Show welcome message
            Swal.fire({
                icon: 'info',
                title: 'Selamat Datang!',
                text: 'Sistem Manajemen Arsip siap digunakan',
                timer: 2000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
        });
    </script>
</body>
</html>
