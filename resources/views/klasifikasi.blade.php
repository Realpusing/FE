<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Klasifikasi - Sistem Arsip BASARNAS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .swal2-popup {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
            border-radius: 1rem !important;
        }
    </style>

    <style>
        /* Base Styling */
        body {
            background-color: #f8fafc;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #334155;
            overflow-x: hidden;
        }

        /* Layout Main Content */
        .main-content {
            margin-left: 260px;
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1.5rem 2rem;
            min-height: 100vh;
        }

        .sidebar.collapsed ~ .main-content,
        .main-content.sidebar-collapsed {
            margin-left: 70px;
        }

        /* Header Orange Card */
        .header-banner {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            color: white;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(234, 88, 12, 0.4);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .header-banner h2 {
            font-weight: 800;
            margin-bottom: 0.5rem;
            font-size: 2.2rem;
            letter-spacing: -0.5px;
        }

        .header-banner p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 500;
        }

        /* Action Buttons Row */
        .action-bar {
            background: white;
            border-radius: 1rem;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
        }

        /* MODERN BUTTONS */
        .btn-modern {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-modern i {
            font-size: 1.1rem;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
        }

        .btn-modern:active {
            transform: translateY(0);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .btn-primary-custom:hover {
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .btn-excel {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        .btn-excel:hover {
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-pdf {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
            margin-left: 0.5rem;
        }
        .btn-pdf:hover {
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
            color: white;
        }

        /* Table Card & Controls */
        .table-wrapper {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        /* Modern Inputs */
        .form-control-modern, .form-select-modern {
            border-radius: 0.5rem;
            border: 1px solid #cbd5e1;
            padding: 0.5rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background-color: #f8fafc;
        }

        .form-control-modern:focus, .form-select-modern:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
        }

        /* Table Styling */
        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .custom-table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .custom-table td {
            vertical-align: middle;
            padding: 1rem;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Badge Status */
        .badge-status-aktif {
            background-color: #dcfce7;
            color: #166534;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
            border: 1px solid #bbf7d0;
        }
        .badge-status-nonaktif {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
            border: 1px solid #fecaca;
        }

        /* Modern Table Action Buttons */
        .btn-action-table {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.4rem;
            border: none;
            transition: all 0.2s ease;
            background-color: #f1f5f9;
            color: #64748b;
            margin: 0 0.15rem;
        }

        .btn-action-table:hover {
            transform: scale(1.05);
        }

        .btn-action-edit:hover { background-color: #dbeafe; color: #2563eb; }
        .btn-action-toggle-on:hover { background-color: #dcfce7; color: #16a34a; }
        .btn-action-toggle-off:hover { background-color: #fee2e2; color: #dc2626; }

        /* Animation */
        @keyframes fadeInRow {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-row {
            animation: fadeInRow 0.4s ease forwards;
            opacity: 0;
        }

        /* Pagination */
        .pagination { margin-top: 1.5rem; margin-bottom: 0; justify-content: flex-end; }
        .page-link {
            color: #475569;
            border: none;
            background: #f8fafc;
            margin: 0 0.2rem;
            border-radius: 0.4rem;
            font-weight: 500;
        }
        .page-item.active .page-link {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(234, 88, 12, 0.3);
        }
        .page-link:hover:not(.active) { background-color: #e2e8f0; color: #0f172a; }

        @media (max-width: 992px) {
            .main-content { margin-left: 70px; }
            .action-bar { flex-direction: column; gap: 1rem; align-items: stretch; }
            .action-bar > div { display: flex; flex-direction: column; gap: 0.5rem; }
            .btn-pdf { margin-left: 0; }
            .table-controls { flex-direction: column; gap: 1rem; align-items: stretch; }
        }
    </style>
</head>
<body>

    @include('sidebar')

    <div class="main-content" id="mainContent">

        <div class="header-banner">
            <h2><i class="bi bi-folder2-open me-2"></i>Sistem Manajemen Arsip</h2>
            <p>Daftar Kode dan Detail Klasifikasi BASARNAS</p>
        </div>

        <div class="action-bar">
            <div>
                <button class="btn-modern btn-primary-custom" onclick="showModal('add')">
                    <i class="bi bi-plus-lg"></i> Tambah Data Klasifikasi
                </button>
            </div>
            <div>
                <button class="btn-modern btn-excel"><i class="bi bi-file-earmark-excel-fill"></i> Export Excel</button>
                <button class="btn-modern btn-pdf"><i class="bi bi-file-earmark-pdf-fill"></i> Export PDF</button>
            </div>
        </div>

        <div class="table-wrapper">

            <div class="table-controls">
                <div>
                    <label class="d-flex align-items-center gap-2 fw-medium text-secondary">
                        Tampilkan
                        <select id="limitSelect" class="form-select-modern w-auto" onchange="changeLimit()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entri
                    </label>
                </div>
                <div>
                    <label class="d-flex align-items-center gap-2 fw-medium text-secondary">
                        Cari:
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-radius: 0.5rem 0 0 0.5rem;"><i class="bi bi-search"></i></span>
                            <input type="text" id="searchInput" class="form-control-modern border-start-0" placeholder="Kata kunci..." onkeyup="handleSearch()" style="border-radius: 0 0.5rem 0.5rem 0;">
                        </div>
                    </label>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover custom-table">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="15%">Kode Klasifikasi</th>
                            <th>Uraian Informasi / Detail</th>
                            <th width="12%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        <tr><td colspan="5" class="text-center py-5 text-muted"><i class="bi bi-arrow-repeat fs-3 d-block mb-2 text-primary"></i> Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                <div id="paginationInfo" class="text-muted small fw-medium">
                    Menampilkan 0 sampai 0 dari 0 entri
                </div>
                <nav>
                    <ul class="pagination pagination-sm" id="paginationControls">
                    </ul>
                </nav>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalKlasifikasi" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg" style="border-radius: 1rem; border: none;">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold" id="modalTitle" style="color: #1e293b;">Tambah Klasifikasi</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="klasifikasi_id">
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small">KODE KLASIFIKASI</label>
                        <input type="text" id="input_kode" class="form-control form-control-modern w-100" placeholder="Contoh: PP.01.02">
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-semibold text-secondary small">URAIAN INFORMASI / DETAIL KODE</label>
                        <textarea id="input_detail" class="form-control form-control-modern w-100" rows="4" placeholder="Masukkan uraian detail..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-top: 1px solid #f1f5f9; border-radius: 0 0 1rem 1rem; padding: 1.2rem 1.5rem;">
                    <button type="button" class="btn btn-light fw-semibold px-4" style="border-radius: 0.5rem;" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn-modern btn-primary-custom px-4" onclick="saveData()"><i class="bi bi-save2"></i> Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const API_URL = 'http://192.168.100.178:8000/api/klasifikasi';
        let modalInstance = null;

        let allData = [];
        let filteredData = [];
        let currentPage = 1;
        let rowsPerPage = 10;
        let searchQuery = '';

        document.addEventListener("DOMContentLoaded", function() {
            if (typeof bootstrap !== 'undefined') {
                modalInstance = new bootstrap.Modal(document.getElementById('modalKlasifikasi'));
                loadData();
            }
        });

        function loadData() {
            fetch(API_URL)
                .then(response => response.json())
                .then(res => {
                    if(res.status === 'success') {
                        allData = res.data || [];
                        handleSearch();
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('tableData').innerHTML = '<tr><td colspan="5" class="text-center text-danger py-5"><i class="bi bi-exclamation-triangle fs-3 d-block mb-2"></i>Gagal terhubung ke API (Backend Port 8000).</td></tr>';
                });
        }

        function handleSearch() {
            searchQuery = document.getElementById('searchInput').value.toLowerCase();
            filteredData = allData.filter(item => {
                return item.Kode.toLowerCase().includes(searchQuery) ||
                       item.Detail_kode.toLowerCase().includes(searchQuery);
            });
            currentPage = 1;
            renderTable();
        }

        function changeLimit() {
            rowsPerPage = parseInt(document.getElementById('limitSelect').value);
            currentPage = 1;
            renderTable();
        }

        function renderTable() {
            const tbody = document.getElementById('tableData');
            tbody.innerHTML = '';

            if(filteredData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-5 text-muted"><i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada data ditemukan</td></tr>';
                updatePaginationInfo(0, 0, 0);
                renderPagination(1);
                return;
            }

            const totalItems = filteredData.length;
            const totalPages = Math.ceil(totalItems / rowsPerPage);

            if(currentPage > totalPages) currentPage = totalPages;

            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, totalItems);
            const paginatedData = filteredData.slice(startIndex, endIndex);

            paginatedData.forEach((item, index) => {
                const globalIndex = startIndex + index + 1;

                let statusBadge = item.is_active == 1
                    ? '<span class="badge-status-aktif"><i class="bi bi-check2-circle me-1"></i>Aktif</span>'
                    : '<span class="badge-status-nonaktif"><i class="bi bi-x-circle me-1"></i>Nonaktif</span>';

                let delay = index * 0.05;

                let toggleIcon = item.is_active == 1 ? '<i class="bi bi-toggle-on fs-5"></i>' : '<i class="bi bi-toggle-off fs-5"></i>';
                let toggleClass = item.is_active == 1 ? 'btn-action-toggle-off' : 'btn-action-toggle-on';
                let toggleTitle = item.is_active == 1 ? 'Nonaktifkan' : 'Aktifkan';

                let row = `
                    <tr class="animate-row" style="animation-delay: ${delay}s">
                        <td class="text-center text-muted fw-medium">${globalIndex}</td>
                        <td class="fw-bold text-dark">${item.Kode}</td>
                        <td>${item.Detail_kode}</td>
                        <td class="text-center">${statusBadge}</td>
                        <td class="text-center">
                            <button class="btn-action-table btn-action-edit" onclick="showModal('edit', ${item.id}, '${item.Kode}', '${item.Detail_kode}')" title="Edit Data">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn-action-table ${toggleClass}" onclick="toggleStatus(${item.id})" title="${toggleTitle}">
                                ${toggleIcon}
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });

            updatePaginationInfo(startIndex + 1, endIndex, totalItems);
            renderPagination(totalPages);
        }

        function updatePaginationInfo(start, end, total) {
            document.getElementById('paginationInfo').innerText = `Menampilkan ${start} sampai ${end} dari ${total} entri`;
        }

        function renderPagination(totalPages) {
            const paginationUl = document.getElementById('paginationControls');
            paginationUl.innerHTML = '';
            if (totalPages <= 1) return;

            let prevDisabled = currentPage === 1 ? 'disabled' : '';
            paginationUl.innerHTML += `<li class="page-item ${prevDisabled}"><a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;"><i class="bi bi-chevron-left"></i></a></li>`;

            for (let i = 1; i <= totalPages; i++) {
                let activeClass = currentPage === i ? 'active' : '';
                paginationUl.innerHTML += `<li class="page-item ${activeClass}"><a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a></li>`;
            }

            let nextDisabled = currentPage === totalPages ? 'disabled' : '';
            paginationUl.innerHTML += `<li class="page-item ${nextDisabled}"><a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;"><i class="bi bi-chevron-right"></i></a></li>`;
        }

        function changePage(page) {
            currentPage = page;
            renderTable();
        }

        function showModal(type, id = '', kode = '', detail = '') {
            document.getElementById('klasifikasi_id').value = id;
            document.getElementById('input_kode').value = kode;
            document.getElementById('input_detail').value = detail;
            document.getElementById('modalTitle').innerText = type === 'add' ? 'Tambah Klasifikasi Baru' : 'Edit Data Klasifikasi';
            modalInstance.show();
        }

        // --- MENGGUNAKAN SWEET ALERT UNTUK SAVE DATA ---
        function saveData() {
            const id = document.getElementById('klasifikasi_id').value;
            const data = {
                Kode: document.getElementById('input_kode').value,
                Detail_kode: document.getElementById('input_detail').value
            };
            const method = id ? 'PUT' : 'POST';
            const url = id ? `${API_URL}/${id}` : API_URL;

            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(res => {
                if(res.status === 'success') {
                    modalInstance.hide();

                    // Notifikasi Sukses SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data klasifikasi berhasil disimpan.',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    loadData();
                } else {
                    // Notifikasi Error SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menyimpan data.'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal terhubung ke server!'
                });
            });
        }

        // --- MENGGUNAKAN SWEET ALERT UNTUK KONFIRMASI STATUS ---
        function toggleStatus(id) {
            Swal.fire({
                title: 'Konfirmasi Perubahan',
                text: "Apakah Anda yakin ingin merubah status klasifikasi ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6', // Warna biru modern (sesuai tombol)
                cancelButtonColor: '#ef4444', // Warna merah modern
                confirmButtonText: '<i class="bi bi-check-lg"></i> Ya, Ubah!',
                cancelButtonText: '<i class="bi bi-x-lg"></i> Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    // Jika di klik "Ya", jalankan fetch
                    fetch(`${API_URL}/${id}/toggle-status`, { method: 'PATCH', headers: { 'Accept': 'application/json' } })
                    .then(response => response.json())
                    .then(res => {
                        if(res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Diubah!',
                                text: 'Status klasifikasi berhasil diperbarui.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            loadData();
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal merubah status klasifikasi.'
                        });
                    });
                }
            });
        }
    </script>
</body>
</html>
