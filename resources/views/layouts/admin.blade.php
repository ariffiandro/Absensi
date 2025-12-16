<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #eaeaea;
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: #65a1fc;
            height: 100vh;
            padding: 25px;
            color: #fff;
            border-right: 1px solid #4d8bf5;
            position: fixed;
            top: 0;
            left: 0;
        }

        .menu-title {
            font-weight: 700;
            margin-bottom: 10px;
            color: #d9e6ff;
            font-size: 18px;
        }

        .sidebar a {
            display: block;
            padding: 10px 8px;
            font-size: 17px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #8cbaff;
            transform: translateX(4px);
        }

        .submenu {
            margin-left: 25px;
            display: none;
        }

        .submenu a {
            font-size: 16px;
        }

        /* HEADER BAR */
        .header-wrapper {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 20;
        }

        .header-bar {
            background: #65a1fc;
            color: white;
            padding: 25px 30px;
            font-size: 20px;
        }

        /* CONTENT AREA */
        .main-content {
            margin-left: 300px;
            margin-top: 80px;
            padding: 20px;
        }

        .btn-soft-blue {
            background: #65a1fc;
            color: white;
            border: none;
        }

        .btn-soft-blue:hover {
            background: #4c8df2;
        }
    </style>

    <script>
        function toggleMenu() {
            let submenu = document.getElementById("submenu-akademik");
            submenu.style.display = submenu.style.display === "block" ? "none" : "block";
        }
    </script>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a href="{{ route('dashboard') }}" class="fw-bold d-flex align-items-center">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <div class="menu-title">Menu Utama</div>

        <a href="#" onclick="toggleMenu()">
            <i class="bi bi-journal-text"></i> Manajemen Akademik
        </a>

        <div id="submenu-akademik" class="submenu">
            <a href="{{ route('siswa.index') }}"><i class="bi bi-people"></i> Data Siswa</a>
            <a href="{{ route('data_guru.index') }}"><i class="bi bi-person-badge"></i> Data Guru</a>
            <a href="{{ route('kelas.index') }}"><i class="bi bi-building"></i> Data Kelas</a>
            <a href="{{ route('admin.absensi.index') }}">
                <i class="bi bi-clipboard-check"></i> Data Absensi
            </a>
            <a href="{{ route('guru.kelas.index') }}">
                <i class="bi bi-building"></i> Data Kelas
            </a>

            <a href="{{ route('guru.absensi.index') }}">
                <i class="bi bi-clipboard-check"></i> Data Absensi
            </a>

        </div>

        <a href="#"><i class="bi bi-person-gear"></i> Kelola Pengguna</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <!-- NAVBAR / HEADER -->
    <div class="header-wrapper">
        <div class="header-bar d-flex justify-content-between align-items-center">
            <h5 class="m-0">@yield('title')</h5>
            <span>👤 Admin</span>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- MODAL LOGOUT -->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-bold">Yakin ingin keluar?</h5>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-soft-blue px-3"
                            onclick="document.getElementById('logout-form').submit();">
                            Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>
