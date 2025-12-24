<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('Image/WhatsApp_Image_2025-11-24_at_10.39.51-removebg-preview.png') }}" alt="Logo BASARNAS">
        </div>
        <h5 class="sidebar-title">Sistem Arsip BASARNAS</h5>
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="bi bi-chevron-left"></i>
        </div>
    </div>

    <div class="sidebar-menu">
        <a href="/dashboard" class="menu-item" data-page="dashboard">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="/arsip" class="menu-item active" data-page="arsip">
            <i class="bi bi-folder2-open"></i>
            <span>Data Arsip</span>
        </a>
        <a href="" class="menu-item" data-page="klasifikasi">
            <i class="bi bi-tags"></i>
            <span>Klasifikasi</span>
        </a>
        <a href="" class="menu-item" data-page="laporan">
            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Laporan</span>
        </a>

        <div class="menu-separator"></div>

        <a href="" class="menu-item" data-page="pengaturan">
            <i class="bi bi-gear"></i>
            <span>Pengaturan</span>
        </a>
        <a href="" class="menu-item" data-page="bantuan">
            <i class="bi bi-question-circle"></i>
            <span>Bantuan</span>
        </a>
        <a href="" class="menu-item text-danger" data-page="logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
        </a>
    </div>
</div>

<style>
    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        background: linear-gradient(180deg, #1a237e 0%, #283593 100%);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1000;
        overflow: hidden;
    }

    .sidebar.collapsed {
        width: 70px;
    }

    /* Header */
    .sidebar-header {
        position: relative;
        padding: 2rem 1.5rem;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        height: 140px; /* Sedikit lebih tinggi agar logo nyaman */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Logo container: pastikan selalu persegi (aspect-ratio) dan hanya atur lebar */
    .sidebar-logo {
        width: 96px;
        aspect-ratio: 1 / 1;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        margin-bottom: 1rem;
        transition: transform 0.25s ease, opacity 0.2s ease;
        background: rgba(255, 255, 255, 0.06);
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        height: auto;
        min-height: 0;
    }

    /* Gambar: selalu cover seluruh kotak, jangan membuat lonjong */
    .sidebar-logo img {
        display: block;
        width: 100%;
        height: 100%;
        max-width: none;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        clip-path: circle(50% at 50% 50%);
        -webkit-clip-path: circle(50% at 50% 50%);
    }

    /* Saat collapsed: JANGAN sembunyikan logo, hanya perkecil sedikit agar tetap terlihat */
    .sidebar.collapsed .sidebar-logo {
        transform: scale(0.82);
        margin-bottom: 0.4rem;
    }

    /* Hanya sembunyikan title (bukan logo) saat collapsed */
    .sidebar.collapsed .sidebar-title {
        opacity: 0;
        transform: scale(0.85);
        pointer-events: none;
    }

    .sidebar-title {
        color: white;
        font-weight: 600;
        font-size: 1.2rem;
        margin: 0;
        white-space: nowrap;
        opacity: 1;
        transition: opacity 0.2s ease 0.1s;
    }

    /* Tombol Toggle */
    .sidebar-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0;
        pointer-events: none;
    }

    .sidebar:hover .sidebar-toggle,
    .sidebar:not(.collapsed) .sidebar-toggle {
        opacity: 1;
        pointer-events: all;
    }

    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-50%) scale(1.1);
    }

    .sidebar-toggle i {
        color: white;
        font-size: 16px;
        transition: transform 0.35s ease;
    }

    .sidebar.collapsed .sidebar-toggle i {
        transform: rotate(180deg);
    }

    /* Menu */
    .sidebar-menu {
        padding: 1.5rem 0;
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

    .sidebar.collapsed .menu-item span {
        opacity: 0;
        pointer-events: none;
    }

    .sidebar.collapsed .menu-item {
        justify-content: center;
        padding: 1rem 0;
    }

    .sidebar.collapsed .menu-item:hover {
        padding-left: 0;
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

    /* Responsive */
    @media (max-width: 992px) {
        .sidebar { width: 70px; }
        .sidebar .sidebar-logo,
        .sidebar .sidebar-title,
        .sidebar .menu-item span {
            opacity: 0;
            pointer-events: none;
        }
        .sidebar .sidebar-toggle { opacity: 1; pointer-events: all; }
        .main-content { margin-left: 70px; }
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

<script>
    // sinkronisasi toggle: simpan state dan adjust main-content
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');

        sidebar.classList.toggle('collapsed');
        const collapsed = sidebar.classList.contains('collapsed');

        // tambahkan class pada main-content untuk styling yang reliable
        if (main) main.classList.toggle('sidebar-collapsed', collapsed);

        // simpan state agar persist antar reload
        try { localStorage.setItem('sidebarCollapsed', collapsed ? '1' : '0'); } catch(e) {}

        // kecilkan/perbesar ikon toggle (visual)
        const icon = sidebar.querySelector('.sidebar-toggle i');
        if (icon) icon.style.transform = collapsed ? 'rotate(180deg)' : 'rotate(0deg)';
    }

    document.addEventListener('DOMContentLoaded', () => {
        // restore state dari localStorage
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');
        try {
            const collapsed = localStorage.getItem('sidebarCollapsed') === '1';
            if (collapsed) {
                sidebar.classList.add('collapsed');
                if (main) main.classList.add('sidebar-collapsed');
            }
        } catch (e) {}

        // set active menu (existing behaviour)
        const currentPath = window.location.pathname;
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
            if (item.getAttribute('href') === currentPath || (currentPath === '/' && item.getAttribute('href') === '/dashboard')) {
                item.classList.add('active');
            }
        });
    });

    // Show toggle when hover only when collapsed (improve UX)
    const sidebarEl = document.getElementById('sidebar');
    if (sidebarEl) {
        sidebarEl.addEventListener('mouseenter', () => {
            if (sidebarEl.classList.contains('collapsed') && window.innerWidth > 992) {
                const t = document.querySelector('.sidebar-toggle');
                if (t) t.style.opacity = '1';
            }
        });
    }
</script>
