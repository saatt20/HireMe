<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireMe - @yield('title', 'Profil')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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

        /* Sidebar Styles */
        .sidebar-profile {
            background-color: white;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #f0f0f0;
            object-fit: cover;
            margin: 0 auto 10px;
            display: block;
        }

        .profile-name {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .profile-university {
            font-size: 12px;
            color: #555;
            margin-bottom: 10px;
        }

        .job-status {
            display: inline-block;
            background-color: #f8f9fa;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            color: #0066cc;
        }

        .job-status.searching {
            background-color: #e6f3ff;
            color: #0066cc;
        }

        .job-status.working {
            background-color: #e6ffe6;
            color: #006600;
        }

        .sidebar-notifications {
            background-color: white;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .notification-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .notification-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-content {
            flex: 1;
        }

        .notification-job {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .notification-company {
            font-size: 11px;
            color: #666;
        }

        .notification-status {
            font-size: 11px;
        }

        .text-muted.small {
            font-size: 11px !important;
        }

        /* Sidebar Styles - Modified untuk background merah */
    .sidebar-profile {
        background-color: white;
        border-radius: 15px;
        padding: 0; /* Ubah dari 15px menjadi 0 */
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden; /* Tambahkan ini */
        position: relative; /* Tambahkan ini */
    }

    /* Background section dengan background merah dan hiasan */
    .profile-background {
        position: relative;
        height: 60px; /* Setengah dari tinggi total area profil */
        background: linear-gradient(135deg, #dc3545, #6f0a12);
        /* Jika menggunakan gambar background, uncomment dan sesuaikan path */
        background-image: url('{{ asset("images/bg-sidebar.png") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* Hiasan dekoratif - bisa disesuaikan */
    .profile-background::before {
        content: '';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .profile-background::after {
        content: '';
        position: absolute;
        bottom: 10px;
        left: 10px;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
    }

    /* Profile content section */
    .profile-content {
        padding: 15px;
        margin-top: -40px; /* Untuk overlap dengan background */
        position: relative;
        z-index: 2;
    }

    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 4px solid white; /* Ubah dari 2px menjadi 4px dan ubah warna menjadi putih */
        object-fit: cover;
        margin: 0 auto 10px;
        display: block;
        position: relative;
        z-index: 3;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Tambahkan shadow */
    }

    .profile-name {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .profile-university {
        font-size: 12px;
        color: #555;
        margin-bottom: 10px;
    }
</style>
@stack('styles')

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

<!-- Main Content with Sidebar -->
<main class="py-4">
    <div class="container">
        @if(isset($hideSidebar) && $hideSidebar)
            <div class="row">
                <div class="col-12">
                    @yield('content')
                </div>
            </div>
        @else
            <div class="row">
                <!-- Sidebar -->
                 <div class="col-lg-2">
    @section('sidebar')
    <div class="sidebar-profile mt-4">
        <!-- Background section dengan hiasan -->
        <div class="profile-background"></div>

        <!-- Profile content -->
                        <div class="profile-content">
                            <img
                                src="{{ auth()->user()->alumni && auth()->user()->alumni->foto ? asset('storage/' . auth()->user()->alumni->foto) : asset('images/pict-profil.png') }}"
                                alt="Profile Photo"
                                class="profile-img"
                            >
                            <div class="profile-name">{{ auth()->user()->name }}</div>
                            <div class="profile-university">Telkom University</div>

                            <div class="job-status {{ auth()->user()->alumni && auth()->user()->alumni->status_kerja == 'Mencari Kerja' ? 'searching' : 'working' }}">
                                {{ auth()->user()->alumni ? auth()->user()->alumni->status_kerja : 'Mencari Kerja' }}
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-notifications">
                        <div class="notification-title">Notifikasi</div>

                        @forelse($lamaransTerbaru as $lamaran)
                            <div class="notification-item">
                                <div class="notification-content">
                                    <div class="notification-job">{{ $lamaran->lowongan->judul ?? '-' }}</div>
                                    <div class="notification-company">
                                        {{ $lamaran->lowongan->user->mitra->user->name ?? $lamaran->lowongan->mitra_nama ?? '-' }}
                                    </div>
                                    <div class="notification-status">
                                        @if($lamaran->status === 'diterima')
                                            <span class="text-success">Diterima</span>
                                        @elseif($lamaran->status === 'ditolak')
                                            <span class="text-danger">Ditolak</span>
                                        @else
                                            <span class="text-secondary">Menunggu</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted small">Belum ada notifikasi</div>
                        @endforelse

                        <div class="text-end mt-2">
                            <a href="{{ route('alumni.riwayat') }}" class="text-muted small">Lainnya</a>
                        </div>
                    </div>
                    @show
                </div>

                <!-- Main Content -->
                <div class="col-lg-10">
                    @yield('content')
                </div>
            </div>
        @endif
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
