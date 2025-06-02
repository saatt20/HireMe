<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireMe - @yield('title', 'Profil')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            background-color: #f1f1f1;
        }
        .navbar-brand span {
            color: #6f0a12;
        }
        .profile-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #ccc;
            display: inline-block;
        }
        .btn-cv {
            background-color: #6f0a12;
            color: #fff;
        }
        .btn-cv:hover {
            background-color: #5c080f;
            color: #fff;
        }

        .dropdown-item:hover {
        background-color: #880C16 !important;
        color: white !important;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('images/logo-hireme-new.png') }}" alt="Logo" height="30" class="me-2">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <!-- Navbar Menu Rata Kanan -->
                <div class="d-flex align-items-center ms-auto gap-4">
                    <a class="nav-link text-dark {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                    <a class="nav-link text-dark {{ request()->routeIs('alumni.lowongan.index') ? 'active' : '' }}" href="{{ route('alumni.lowongan.index') }}">Lowongan Kerja</a>
                    <a class="nav-link text-dark {{ request()->routeIs('alumni.riwayat') ? 'active' : '' }}" href="{{ route('alumni.riwayat') }}">Riwayat Lamaran</a>
                    <a href="{{ route('alumni.cv.index') }}" class="btn btn-cv">Buat CV</a>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <img
                            src="{{ auth()->user()->alumni && auth()->user()->alumni->foto ? asset('storage/' . auth()->user()->alumni->foto) : asset('images/pict-profil.png') }}"
                            alt="Foto Profil"
                            class="rounded-circle border border-danger"
                            style="width: 32px; height: 32px; object-fit: cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                             <li><a class="dropdown-item" href="{{ route('alumni.profil') }}">Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
