<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AtmiBlast')</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #f8f9fa;
            border-right: 1px solid #ddd;
            padding-top: 20px;
            transition: .3s;
            z-index: 1000;
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .sidebar-logo img {
            width: 120px;
        }

        .sidebar-menu a {
            padding: 12px 20px;
            display: block;
            color: #333;
            font-weight: 500;
            text-decoration: none;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #0d6efd;
            color: #fff;
        }

        .sidebar-item {
            padding: 10px 20px;
            font-weight: 600;
            border-top: 1px solid #e9ecef;
        }

        .sidebar .dropdown .btn {
            text-align: left;
            border: none;
            padding-left: 0;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            padding: 0 20px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: .3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                margin-left: 0;
            }
        }

        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            font-size: 26px;
            cursor: pointer;
            z-index: 1100;
        }
    </style>

    @yield('head')
</head>

<body>

    <!-- Toggle Button (Mobile) -->
    <i class="fa-solid fa-bars toggle-btn d-md-none" id="toggleSidebar"></i>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/atmiblast.png') }}" alt="AtmiBlast Logo">
        </div>

        <div class="sidebar-menu">

            @auth
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house me-2"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Login
                </a>
            @endauth

            <!-- Menu Divider -->
            <div class="sidebar-item">Master Data</div>

            <a href="{{ route('institusis.index') }}">
                <i class="bi bi-building me-2"></i> Divisi
            </a>

            <a href="{{ route('employees.index') }}">
                <i class="bi bi-people me-2"></i> Karyawan
            </a>

           
            <a href="{{ route('units.index') }}" class="nav-link">
                <i class="bi bi-box nav-icon"></i>
                Unit Karya
            </a>

            <a href="{{ route('email.index') }}">
                <i class="bi bi-envelope me-2"></i> Tambah Email Pengirim
            </a>

            <div class="sidebar-item">Kirim Email</div>

            <div class="px-3">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                        Pilih Opsi
                    </button>
                    <ul class="dropdown-menu w-100">
                        <li><a class="dropdown-item" href="{{ route('email.individual') }}">
                            <i class="bi bi-person me-2"></i> Ke Individu
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('email.division') }}">
                            <i class="bi bi-diagram-3 me-2"></i> Ke Divisi
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('email.unit') }}">
                            <i class="bi bi-box me-2"></i> Ke Unit Karya
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- LOGOUT -->
        @auth
            <div class="logout-btn">
                <a href="#" class="btn btn-danger w-100"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                    @csrf
                </form>
            </div>
        @endauth
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $("#toggleSidebar").click(() => {
            $("#sidebar").toggleClass("show");
        });
    </script>

</body>

</html>
