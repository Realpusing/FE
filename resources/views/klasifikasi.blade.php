<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Klasifikasi - Sistem Arsip BASARNAS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* Base Styling */
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
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

        /* Header Orange Card (Sesuai Gambar) */
        .header-banner {
            background: linear-gradient(90deg, #f57c00 0%, #ff9800 100%);
            border-radius: 0.8rem;
            padding: 2.5rem 2rem;
            color: white;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .header-banner h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 2.2rem;
        }

        .header-banner p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        /* Action Buttons Row */
        .action-bar {
            background: white;
            border-radius: 0.8rem;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-custom-add { background-color: #6c757d; color: white; border-radius: 2rem; padding: 0.5rem 1.5rem; font-weight: 600; }
        .btn-custom-add:hover { background-color: #5a6268; color: white; }

        .btn-custom-excel { background-color: #198754; color: white; border-radius: 2rem; padding: 0.5rem 1.5rem; font-weight: 600; }
        .btn-custom-pdf { background-color: #dc3545; color: white; border-radius: 2rem; padding: 0.5rem 1.5rem; font-weight: 600; margin-left: 0.5rem;}

        /* Table Card & Controls */
        .table-wrapper {
            background: white;
            border-radius: 0.8rem;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .table-controls select, .table-controls input {
            border-radius: 0.4rem;
            border: 1px solid #ced4da;
        }

        /* Table Styling */
        .custom-table th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            cursor: pointer; /* Indikator bisa di-sort jika mau dikembangkan */
        }

        .custom-table td {
            vertical-align: middle;
        }

        /* Badge Status */
        .badge-status-aktif { background-color: #d1e7dd; color: #0f5132; padding: 0.4rem 0.8rem; border-radius: 2rem; font-weight: 600; font-size: 0.85rem;}
        .badge-status-nonaktif { background-color: #f8d7da; color: #842029; padding: 0.4rem 0.8rem; border-radius: 2rem; font-weight: 600; font-size: 0.85rem;}

        /* Animation */
        @keyframes fadeInRow {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-row {
            animation: fadeInRow 0.4s ease forwards;
            opacity: 0; /* Awal tersembunyi sebelum animasi jalan */
        }

        /* Pagination */
        .pagination {
            margin-top: 1.5rem;
            margin-bottom: 0;
            justify-content: flex-end;
        }
        .page-link { color: #f57c00; border: none; background: #fff; margin: 0 0.2rem; border-radius: 0.4rem; }
        .page-item.active .page-link { background-color: #f57c00; color: white; box-shadow: 0 2px 5px rgba(245, 124, 0, 0.4); }
        .page-link:hover { background-color: #ffe0b2; color: #e65100; }

        @media (max-width: 992px) {
            .main-content { margin-left: 70px; }
            .action-bar { flex-direction: column; gap: 1rem; align-items: stretch; }
            .action-bar > div { display: flex; flex-direction: column; gap: 0.5rem; }
            .btn-custom-pdf { margin-left: 0; }
            .table-controls { flex-direction: column; gap: 1rem; align-items: stretch; }
        }
    </style>
</head>
<body>

    @include('sidebar')

    <div class="main-content" id="mainContent">

        <div class="header-banner">
            <h2><i class="bi bi-folder2-open"></i> Sistem Manajemen Arsip</h2>
            <p>Daftar Kode dan Detail Klasifikasi</p>
        </div>

        <div class="action-bar">
            <div>
                <button class="btn btn-custom-add" onclick="showModal('add')">
                    <i class="bi bi-plus-circle me-1"></i> TAMBAH DATA
                </button>
            </div>
            <div>
                <button class="btn btn-custom-excel"><i class="bi bi-file-earmark-excel me-1"></i> EXPORT EXCEL</button>
                <button class="btn btn-custom-pdf"><i class="bi bi-file-earmark-pdf me-1"></i> EXPORT PDF</button>
            </div>
        </div>

        <div class="table-wrapper">

            <div class="table-controls">
                <div>
                    <label class="d-flex align-items-center gap-2">
                        Tampilkan
                        <select id="limitSelect" class="form-select form-select-sm w-auto" onchange="changeLimit()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entri
                    </label>
                </div>
                <div>
                    <label class="d-flex align-items-center gap-2">
                        Cari:
                        <input type="text" id="searchInput" class="form-control form-control-sm w-auto" placeholder="kata kunci pencarian..." onkeyup="handleSearch()">
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
                            <th width="10%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        <tr><td colspan="5" class="text-center py-4">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div id="paginationInfo" class="text-muted small">
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
            <div class="modal-content" style="border-radius: 0.8rem; border: none;">
                <div class="modal-header" style="background: #f4f7f6; border-bottom: 2px solid #dee2e6;">
                    <h5 class="modal-title fw-bold" id="modalTitle" style="color: #495057;">Tambah Klasifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="klasifikasi_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Klasifikasi</label>
                        <input type="text" id="input_kode" class="form-control" placeholder="Contoh: PP.01.02">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Uraian Informasi / Detail Kode</label>
                        <textarea id="input_detail" class="form-control" rows="4" placeholder="Masukkan uraian detail..."></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: none; padding: 1rem 1.5rem;">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-custom-add px-4" onclick="saveData()">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const API_URL = 'http://127.0.0.1:8000/api/klasifikasi';
        let modalInstance = null;

        // State Management untuk Pagination & Search
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

        // 1. Fetch Data dari Backend
        function loadData() {
            fetch(API_URL)
                .then(response => response.json())
                .then(res => {
                    if(res.status === 'success') {
                        allData = res.data || [];
                        handleSearch(); // Memanggil filter & render table
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('tableData').innerHTML = '<tr><td colspan="5" class="text-center text-danger py-4">Gagal terhubung ke API (Backend Port 8000).</td></tr>';
                });
        }

        // 2. Logika Search/Pencarian
        function handleSearch() {
            searchQuery = document.getElementById('searchInput').value.toLowerCase();

            // Filter array berdasarkan Kode atau Detail
            filteredData = allData.filter(item => {
                return item.Kode.toLowerCase().includes(searchQuery) ||
                       item.Detail_kode.toLowerCase().includes(searchQuery);
            });

            currentPage = 1; // Reset ke halaman 1 setiap kali mencari
            renderTable();
        }

        // 3. Logika Ubah Limit/Entri
        function changeLimit() {
            rowsPerPage = parseInt(document.getElementById('limitSelect').value);
            currentPage = 1;
            renderTable();
        }

        // 4. Render Tabel dengan Animasi & Pagination
        function renderTable() {
            const tbody = document.getElementById('tableData');
            tbody.innerHTML = '';

            if(filteredData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada data ditemukan</td></tr>';
                updatePaginationInfo(0, 0, 0);
                renderPagination(1);
                return;
            }

            // Hitung Data untuk Halaman Saat Ini
            const totalItems = filteredData.length;
            const totalPages = Math.ceil(totalItems / rowsPerPage);

            if(currentPage > totalPages) currentPage = totalPages;

            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, totalItems);

            const paginatedData = filteredData.slice(startIndex, endIndex);

            // Buat HTML Baris
            paginatedData.forEach((item, index) => {
                const globalIndex = startIndex + index + 1; // Nomor urut global

                let statusBadge = item.is_active == 1
                    ? '<span class="badge-status-aktif">Aktif</span>'
                    : '<span class="badge-status-nonaktif">Nonaktif</span>';

                // Animasi delay bertingkat
                let delay = index * 0.05;

                let toggleBtnText = item.is_active == 1 ? '<i class="bi bi-x-circle"></i>' : '<i class="bi bi-check-circle"></i>';
                let toggleBtnColor = item.is_active == 1 ? 'btn-outline-danger' : 'btn-outline-success';

                let row = `
                    <tr class="animate-row" style="animation-delay: ${delay}s">
                        <td class="text-center text-muted">${globalIndex}</td>
                        <td class="fw-bold">${item.Kode}</td>
                        <td>${item.Detail_kode}</td>
                        <td class="text-center">${statusBadge}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light border" onclick="showModal('edit', ${item.id}, '${item.Kode}', '${item.Detail_kode}')" title="Edit">
                                <i class="bi bi-pencil-square text-primary"></i>
                            </button>
                            <button class="btn btn-sm ${toggleBtnColor}" onclick="toggleStatus(${item.id})" title="Ubah Status Aktif/Nonaktif">
                                ${toggleBtnText}
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });

            updatePaginationInfo(startIndex + 1, endIndex, totalItems);
            renderPagination(totalPages);
        }

        // 5. Update Teks Informasi Bawah ("Menampilkan 1 sampai 10...")
        function updatePaginationInfo(start, end, total) {
            document.getElementById('paginationInfo').innerText = `Menampilkan ${start} sampai ${end} dari ${total} entri`;
        }

        // 6. Generate Tombol Halaman (1, 2, 3...)
        function renderPagination(totalPages) {
            const paginationUl = document.getElementById('paginationControls');
            paginationUl.innerHTML = '';

            if (totalPages <= 1) return;

            // Tombol Previous
            let prevDisabled = currentPage === 1 ? 'disabled' : '';
            paginationUl.innerHTML += `<li class="page-item ${prevDisabled}"><a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">Sebelumnya</a></li>`;

            // Nomor Halaman
            for (let i = 1; i <= totalPages; i++) {
                let activeClass = currentPage === i ? 'active' : '';
                paginationUl.innerHTML += `<li class="page-item ${activeClass}"><a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a></li>`;
            }

            // Tombol Next
            let nextDisabled = currentPage === totalPages ? 'disabled' : '';
            paginationUl.innerHTML += `<li class="page-item ${nextDisabled}"><a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">Selanjutnya</a></li>`;
        }

        // 7. Event Ganti Halaman
        function changePage(page) {
            currentPage = page;
            renderTable();
        }

        // CRUD Functions (Tetap Sama)
        function showModal(type, id = '', kode = '', detail = '') {
            document.getElementById('klasifikasi_id').value = id;
            document.getElementById('input_kode').value = kode;
            document.getElementById('input_detail').value = detail;
            document.getElementById('modalTitle').innerText = type === 'add' ? 'Tambah Klasifikasi Baru' : 'Edit Data Klasifikasi';
            modalInstance.show();
        }

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
                    loadData(); // Panggil ulang data dan reset
                } else {
                    alert('Gagal menyimpan data.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function toggleStatus(id) {
            if(!confirm('Yakin ingin merubah status klasifikasi ini?')) return;
            fetch(`${API_URL}/${id}/toggle-status`, { method: 'PATCH', headers: { 'Accept': 'application/json' } })
            .then(response => response.json())
            .then(res => {
                if(res.status === 'success') {
                    loadData(); // Refresh data dari server
                }
            });
        }
    </script>
</body>
</html>
