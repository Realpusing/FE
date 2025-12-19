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

        /* Styling untuk row yang di-group */
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

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
    {{-- Sertakan sidebar agar elemen dengan id="sidebar" ada untuk skrip --}}
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
                    <button type="button" class="btn btn-primary" onclick="simpanData()">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit/Hapus Group -->
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

    <!-- Modal Edit Data -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalEditLabel">
                        <i class="bi bi-pencil-square"></i> Edit Data Arsip
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_info_berkas" class="alert alert-info mb-3"></div>

                    <form id="formEditArsip">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">No Item Arsip <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_no_arsip" name="no_arsip" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kode Klasifikasi <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_kode_klasifikasi" name="kode_klasifikasi" required>
                                    <option value="">-- Pilih Kode --</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Uraian Informasi <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="edit_uraian" name="uraian_informasi" rows="3" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="edit_tanggal" name="tanggal" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="edit_jumlah" name="jumlah" required min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Satuan <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_satuan" name="satuan" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="lembar">Lembar</option>
                                    <option value="berkas">Berkas</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Klasifikasi Keamanan <span class="text-danger">*</span></label>
                                <select class="form-select" id="edit_keamanan" name="keamanan" required>
                                    <option value="biasa">Biasa</option>
                                    <option value="rahasia">Rahasia</option>
                                    <option value="super-rahasia">Super Rahasia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="edit_keterangan" name="keterangan">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateArsip()">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        let itemCounter = 0;
        let kodeKlasifikasi = [];
        let arsipTable;
        let modalTambah;
        let modalGroupAction;
        let modalEdit;
        let currentGroupIds = [];
        let currentEditId = null;

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

                    console.log('Kode klasifikasi loaded:', kodeKlasifikasi.length, 'items');
                    updateKlasifikasiDropdown();
                } else {
                    throw new Error('Format data tidak sesuai');
                }
            } catch (error) {
                console.error('Error loading kode klasifikasi:', error);
            }
        }

        function updateKlasifikasiDropdown() {
            // Update dropdown di form edit
            const editDropdown = document.getElementById('edit_kode_klasifikasi');
            if (editDropdown && kodeKlasifikasi.length > 0) {
                editDropdown.innerHTML = '<option value="">-- Pilih Kode --</option>';
                kodeKlasifikasi.forEach(item => {
                    editDropdown.innerHTML += `<option value="${item.kode}">${item.kode} - ${item.detail}</option>`;
                });
                console.log('Edit dropdown populated with', kodeKlasifikasi.length, 'options');
            }

            // Update dropdown di form tambah
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

        function initDataTable() {
            arsipTable = $('#arsipTable').DataTable({
                ajax: {
                    url: 'http://127.0.0.1:8000/api/berkas',
                    type: 'GET',
                    dataSrc: function(json) {
                        console.log('DataTable loaded:', json);
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

        async function editGroup() {
            alert(`Fitur edit untuk ${currentGroupIds.length} data sedang dalam pengembangan.\nID: ${currentGroupIds.join(', ')}`);
            modalGroupAction.hide();
        }

        async function hapusGroup() {
            if (!confirm(`Apakah Anda yakin ingin menghapus ${currentGroupIds.length} data sekaligus?`)) return;

            try {
                let successCount = 0;
                let failCount = 0;

                for (const id of currentGroupIds) {
                    try {
                        const response = await fetch(`http://127.0.0.1:8000/api/arsip/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        });

                        if (response.ok) {
                            successCount++;
                        } else {
                            failCount++;
                        }
                    } catch (error) {
                        failCount++;
                        console.error(`Error deleting ID ${id}:`, error);
                    }
                }

                modalGroupAction.hide();
                alert(`Berhasil menghapus ${successCount} data.\n${failCount > 0 ? `Gagal: ${failCount} data.` : ''}`);
                arsipTable.ajax.reload();

            } catch (error) {
                console.error('Error deleting group:', error);
                alert('Terjadi kesalahan saat menghapus data');
            }
        }

        async function editArsip(id) {
            console.log('=== EDIT ARSIP CALLED ===');
            console.log('ID:', id);
            console.log('Kode Klasifikasi available:', kodeKlasifikasi.length);

            // Pastikan klasifikasi sudah di-load
            if (kodeKlasifikasi.length === 0) {
                console.log('Loading klasifikasi first...');
                await loadKodeKlasifikasi();
            }

            try {
                currentEditId = id;
                const url = `http://127.0.0.1:8000/api/arsip/${id}`;
                console.log('Fetching from:', url);

                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                console.log('Response status:', response.status);
                console.log('Response ok:', response.ok);

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Response error text:', errorText);
                    throw new Error(`HTTP ${response.status}: ${errorText}`);
                }

                const result = await response.json();
                console.log('API Response:', JSON.stringify(result, null, 2));

                if (!result.data) {
                    throw new Error('Property "data" tidak ada dalam response');
                }

                const data = result.data;

                // Populate semua field dengan console log
                console.log('Populating form...');

                const fields = {
                    'edit_no_arsip': data.no_arsip || '',
                    'edit_uraian': data.uraian_informasi || '',
                    'edit_tanggal': data.tanggal || '',
                    'edit_jumlah': data.jumlah || '',
                    'edit_satuan': data.satuan || '',
                    'edit_keterangan': data.Keterangan || ''
                };

                // Set semua field
                for (const [fieldId, value] of Object.entries(fields)) {
                    const element = document.getElementById(fieldId);
                    if (element) {
                        element.value = value;
                        console.log(`✓ ${fieldId} = "${value}"`);
                    } else {
                        console.error(`✗ Element ${fieldId} tidak ditemukan!`);
                    }
                }

                // Handle kode klasifikasi
                let kodeValue = '';
                if (data.kode && data.kode.Kode) {
                    kodeValue = data.kode.Kode;
                } else if (data.kode_klasifikasi) {
                    kodeValue = data.kode_klasifikasi;
                }

                const kodeDropdown = document.getElementById('edit_kode_klasifikasi');
                if (kodeDropdown) {
                    console.log('Kode value:', kodeValue);
                    console.log('Dropdown has', kodeDropdown.options.length, 'options');

                    // Cek apakah value ada di dropdown
                    let found = false;
                    for (let i = 0; i < kodeDropdown.options.length; i++) {
                        if (kodeDropdown.options[i].value === kodeValue) {
                            found = true;
                            console.log(`Found kode at index ${i}`);
                            break;
                        }
                    }

                    if (found) {
                        kodeDropdown.value = kodeValue;
                        console.log('✓ Kode klasifikasi set to:', kodeDropdown.value);
                    } else {
                        console.error('✗ Kode', kodeValue, 'tidak ada di dropdown!');
                    }
                } else {
                    console.error('✗ Dropdown edit_kode_klasifikasi tidak ditemukan!');
                }

                // Handle keamanan
                let keamananValue = (data.keamanan || 'biasa').toLowerCase().replace(' ', '-');
                const keamananDropdown = document.getElementById('edit_keamanan');
                if (keamananDropdown) {
                    keamananDropdown.value = keamananValue;
                    console.log('✓ Keamanan set to:', keamananDropdown.value);
                }

                // Show berkas info
                const berkasInfoDiv = document.getElementById('edit_info_berkas');
                if (berkasInfoDiv) {
                    const berkasInfo = `
                        <strong>No Berkas:</strong> ${data.hal?.nomor || '-'}<br>
                        <strong>Judul:</strong> ${data.hal?.judul_berkas || '-'}
                    `;
                    berkasInfoDiv.innerHTML = berkasInfo;
                    console.log('✓ Berkas info updated');
                }

                console.log('All fields populated, showing modal...');

                // Pastikan modal element ada
                const modalElement = document.getElementById('modalEdit');
                if (!modalElement) {
                    throw new Error('Modal element "modalEdit" tidak ditemukan!');
                }

                // Show modal
                if (modalEdit) {
                    modalEdit.show();
                    console.log('✓ Modal shown');
                } else {
                    console.error('Modal instance tidak ada, creating new one...');
                    modalEdit = new bootstrap.Modal(modalElement);
                    modalEdit.show();
                }

                console.log('=== EDIT ARSIP COMPLETE ===');

            } catch (error) {
                console.error('=== ERROR IN EDIT ARSIP ===');
                console.error('Error name:', error.name);
                console.error('Error message:', error.message);
                console.error('Error stack:', error.stack);
                alert('Gagal memuat data:\n\n' + error.message + '\n\nCek console (F12) untuk detail lengkap.');
            }
        }

        async function updateArsip() {
            const form = document.getElementById('formEditArsip');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            if (!currentEditId) {
                alert('ID data tidak ditemukan');
                return;
            }

            const formData = new FormData(form);

            const data = {
                no_arsip: formData.get('no_arsip')?.trim(),
                kode_klasifikasi: formData.get('kode_klasifikasi')?.trim(),
                uraian_informasi: formData.get('uraian_informasi')?.trim(),
                tanggal: formData.get('tanggal'),
                jumlah: parseFloat(formData.get('jumlah')) || 0,
                satuan: formData.get('satuan'),
                keamanan: formData.get('keamanan'),
                Keterangan: formData.get('keterangan')?.trim() || ''
            };

            console.log('Updating arsip:', currentEditId, data);

            try {
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
                    let errorMsg = result.message || 'Gagal mengupdate data';
                    if (result.errors) {
                        errorMsg += '\n\nDetail:\n' + Object.entries(result.errors)
                            .map(([key, val]) => `${key}: ${val.join(', ')}`)
                            .join('\n');
                    }
                    throw new Error(errorMsg);
                }

                alert(result.message || 'Data berhasil diupdate!');
                modalEdit.hide();
                form.reset();
                currentEditId = null;
                arsipTable.ajax.reload();

            } catch (error) {
                console.error('Error:', error);
                alert('Gagal mengupdate data:\n' + error.message);
            }
        }

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

            if (!response.ok) throw new Error('Gagal mengunduh file Excel');

            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `Data_Arsip_${new Date().getTime()}.xlsx`;
            document.body.appendChild(a);
            a.click();

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

            if (!response.ok) throw new Error('Gagal mengunduh file PDF');

            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `Data_Arsip_${new Date().getTime()}.pdf`;
            document.body.appendChild(a);
            a.click();

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

    // Initialization
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== PAGE LOADING ===');

        // Initialize modals
        modalTambah = new bootstrap.Modal(document.getElementById('modalTambah'));
        modalGroupAction = new bootstrap.Modal(document.getElementById('modalGroupAction'));
        modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
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
    });
    </script>
</body>
</html>
