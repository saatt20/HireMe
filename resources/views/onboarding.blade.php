@extends('layouts.onboarding', ['hideSidebar' => true])

@section('title', 'Onboarding')
{{-- Font Awesome CDN --}}
@section('content')

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- Menambahkan Font Awesome untuk ikon sosial media -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>

    :root {
      --red-dark: #880C16;
      --red-mid: #B01021;
      --red-light: #C71527;
    }

  .hero-section {
    background-image: url('{{ asset('images/bg-onboard.png') }}'); /* Ganti dengan path gambar kamu */
    background-size: cover;
    background-position: center;
    height: 83vh;
    color: black;
    position: relative;
    margin-top: -30px; /* Atur jarak untuk menyesuaikan dengan tinggi navbar */
    padding-top: 0; /* Hapus padding atas jika ada */
  }

  .hero-overlay {
    background-color: none;
  }

  .hero-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
  }

  .hero-text h1 {
    font-size: 3rem;
    font-weight: bold;
    color: black;
  }

  .hero-text p {
    font-size: 1.25rem;
    margin-top: 1rem;
    color: black;
  }

  .hero-text .text-danger {
    margin-bottom: 0.5rem; /* Mengurangi jarak bawah antara 'Career Development Center' dan 'Telkom University Surabaya' */
  }

  .hero-text .text-secondary {
    margin-top: 0.2rem; /* Mengurangi jarak atas antara 'Telkom University Surabaya' dan 'Selamat Datang di HireMe!' */
  }

  .bg-red-custom {
    background-color: #C71527;
  }

  @media (max-width: 768px) {
    .hero-text h1 {
      font-size: 2rem;
    }

    .hero-text p {
      font-size: 1rem;
    }
  }

  body {
    background-image: none;
  }

  .section-gray {
    background-color: #EEEEEE;
  }

  .section-bg-red {
      background: linear-gradient(to bottom, var(--red-dark), var(--red-mid), var(--red-light));
      color: #fff;
      text-align: center;
      padding: 20px 0;
      font-weight: bold;
      font-size: 1.2rem;
      margin-top: -5px;
    }

       /* Style untuk Section 3 Langkah Mudah */
    .steps-section {
      background-color: #ffffff; /* Background abu-abu muda */
      padding: 80px 0;
      position: relative;
    }

    .step-container {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 60px;
    }

    .step-item {
      flex: 1;
      text-align: center;
      position: relative;
      padding: 0 20px;
    }

    .step-number {
      position: relative;
      display: inline-block;
      margin-bottom: 30px;
    }

    .step-number-bg {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 120px;
      height: 120px;
      /* background: linear-gradient(135deg, #ff6b6b, #ee5a52); */
      background-image: url('{{ asset("images/bg-angka.png") }}');
      border-radius: 50%;
      opacity: 0.5;
      z-index: 1;
    }

    .step-number h4 {
      position: relative;
      z-index: 2;
      font-size: 5rem;
      font-weight: bold;
      color: var(--red-dark);
      margin: 0;
      line-height: 1;
    }

    .step-title {
      font-size: 1.25rem;
      font-weight: bold;
      color: #000000;
      margin-bottom: 20px;
    }

    .step-divider {
      width: 60px;
      height: 3px;
      background-color: var(--red-dark);
      margin: 20px auto;
    }

    .step-description {
      font-size: 1rem;
      color: #666;
      line-height: 1.6;
    }

    .step-arrow {
      position: absolute;
      top: 50%;
      right: -25px;
      transform: translateY(-50%);
      color: var(--red-dark);
      font-size: 2rem;
      z-index: 3;
    }

    .step-item:last-child .step-arrow {
      display: none;
    }

  .carousel-container {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .carousel-track {
            display: flex;
            animation: scroll 30s linear infinite;
            width: calc(200% + 40px); /* Double width for seamless loop */
        }

        .carousel-track:hover {
            animation-play-state: paused;
        }

        .logo-item {
            flex: 0 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 180px;
            height: 120px;
        }

        .logo-item img {
            max-height: 80px;
            max-width: 150px;
            object-fit: contain;
            filter: grayscale(100%) opacity(0.7);
            transition: all 0.3s ease;
        }

        .logo-item:hover img {
            filter: grayscale(0%) opacity(1);
            transform: scale(1.1);
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .carousel-track {
                animation-duration: 25s;
            }

            .logo-item {
                min-width: 150px;
                height: 100px;
            }

            .logo-item img {
                max-height: 60px;
                max-width: 120px;
            }
        }

        /* Alternative: Fade edges for better visual effect */
        .carousel-container::before,
        .carousel-container::after {
            content: '';
            position: absolute;
            top: 0;
            width: 50px;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        .carousel-container::before {
            left: 0;
            background: linear-gradient(to right, rgba(255,255,255,1), rgba(255,255,255,0));
        }

        .carousel-container::after {
            right: 0;
            background: linear-gradient(to left, rgba(255,255,255,1), rgba(255,255,255,0));
        }

    .footer-bottom {
    background: linear-gradient(to bottom, var(--red-dark), var(--red-mid), var(--red-light));
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
  }

  .footer-text {
    white-space: nowrap; /* Mencegah teks terpotong atau terpecah ke baris berikutnya */
    /* overflow: hidden; /* Pastikan teks yang panjang tidak keluar dari kontainer */
    /* text-overflow: ellipsis; Jika teks sangat panjang, beri tanda elipsis */ */
    display: block; /* Pastikan teks berada di satu baris */
    width: 100%; /* Pastikan lebar kolom cukup untuk menampung teks */
    text-align: center; /* Pastikan teks sejajar di tengah */
  }

</style>

<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="container hero-content">
    <div class="row">
      <div class="col-md-6 hero-text">
        <p class="text-danger fw-bold mb-0">Career Development Center</p>
        <p class="text-secondary mb-3">Telkom University Surabaya</p>
        <h1>Selamat Datang di HireMe!</h1>
        <p>Platform resmi Career Development Center
        Telkom University Surabaya untuk bantu kamu memulai karier impian.</p>
      </div>
    </div>
  </div>

  <!-- Red Separator -->
  <div class="section-bg-red">
    <h1 class="fw-bold">Career Development Center Telkom University Surabaya</h1>
  </div>

<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold">Kategori Job Terbaru</h3>
        <p class="text-muted">Jelajahi berbagai jenis pekerjaan yang tersedia<br>Kami akan membantu kamu untuk menemukan pekerjaan yang kamu cari.</p>
        <div class="d-flex justify-content-end">
            <a href="{{ route('alumni.lowongan.index') }}" class="btn text-white bg-red-custom">Jelajahi</a>
        </div>

        <div class="row g-4 mt-3">
            @forelse ($latestLowongans as $lowongan)
                @php
                    // Check if the deadline has passed
                    $deadlinePassed = false;
                    if (!empty($lowongan->deadline)) {
                        $deadline = \Carbon\Carbon::parse($lowongan->deadline);
                        $deadlinePassed = $deadline->isPast();
                    }

                    // Cek apakah dibuat oleh admin
                    $isCreatedByAdmin = $lowongan->created_by_role === 'admin';

                    // Tentukan sumber logo berdasarkan role pembuat
                    if ($isCreatedByAdmin) {
                        $logoPath = $lowongan->mitra_logo ?? null;
                    } else {
                        $logoPath = $lowongan->user->mitra->logo ?? null;
                    }

                    // Tentukan nama perusahaan berdasarkan role pembuat
                    $namaPerusahaan = $isCreatedByAdmin
                        ? $lowongan->mitra_nama
                        : $lowongan->user->name;

                    // Menentukan kelas badge berdasarkan status
                    $status = strtolower(trim($lowongan->status));
                    $badgeClass = match($status) {
                        'full time' => 'bg-success',
                        'part time' => 'bg-primary',
                        'internship', 'magang' => 'bg-danger',
                        default => 'bg-secondary'
                    };
                @endphp

                @if (!$deadlinePassed)
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100 rounded-4">
                            <div class="card-body">
                                {{-- Logo perusahaan --}}
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ $logoPath ? asset('storage/' . $logoPath) : asset('images/logo-default.png') }}" alt="Logo" class="me-2 rounded" width="40" height="40">

                                    {{-- Judul lowongan --}}
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $lowongan->judul }}</h6>
                                        <small class="text-muted">{{ $lowongan->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>

                                {{-- Nama perusahaan --}}
                                <div class="mt-2">
                                    <span class="bold-text">{{ $namaPerusahaan }}</span>
                                </div>

                                {{-- Lokasi & status --}}
                                <div class="mb-3">
                                    <div class="mb-2">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-geo-alt me-1"></i> {{ $lowongan->kota }}, {{ $lowongan->provinsi }}
                                        </small>
                                    </div>

                                    <div>
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $lowongan->status }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Skills --}}
                                <div class="mb-2">
                                    @php
                                        $skillArray = array_map('trim', explode(',', $lowongan->skills));
                                        $displayedSkills = array_slice($skillArray, 0, 3);
                                        $remainingCount = count($skillArray) - count($displayedSkills);
                                    @endphp

                                    @foreach($displayedSkills as $skill)
                                        <span class="badge bg-light text-dark border">{{ $skill }}</span>
                                    @endforeach

                                    @if ($remainingCount > 0)
                                        <span class="badge bg-secondary">+{{ $remainingCount }}</span>
                                    @endif
                                </div>

                                {{-- Lihat detail --}}
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('alumni.lowongan.show', $lowongan->id) }}" class="text-danger text-decoration-none">Lihat...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-12">
                    <p>Belum ada lowongan tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
    <!-- Section 4: 3 Langkah Mudah -->
<!-- Section 4: 3 Langkah Mudah -->
<div class="steps-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-start mb-5">
                <h2 class="text-danger fw-bold">3 Langkah Mudah</h2>
                <h3 class="text-dark fw-bold">Memulai Karier Impian</h3>
            </div>
        </div>

        <div class="step-container">
            <!-- Step 1 -->
            <div class="step-item">
                <div class="step-number">
                    <div class="step-number-bg"></div>
                    <h4>1</h4>
                </div>
                <div class="step-title">Daftar & Lengkapi Profil</div>
                <div class="step-divider"></div>
                <div class="step-description">
                    Pertama, kamu harus membuat akun terlebih dahulu dan lengkapi data diri di profil agar perusahaan dapat mengenalmu.
                </div>
                <div class="step-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-item">
                <div class="step-number">
                    <div class="step-number-bg"></div>
                    <h4>2</h4>
                </div>
                <div class="step-title">Cari & Pilih Pekerjaan</div>
                <div class="step-divider"></div>
                <div class="step-description">
                    Kedua, gunakan fitur pencarian untuk menemukan pekerjaan sesuai dengan keterampilan dan minatmu.
                </div>
                <div class="step-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-item">
                <div class="step-number">
                    <div class="step-number-bg"></div>
                    <h4>3</h4>
                </div>
                <div class="step-title">Lamar & Tunggu Panggilan</div>
                <div class="step-divider"></div>
                <div class="step-description">
                    Ketiga, Kirim lamaran dengan mudah dan tunggu notifikasi saat ada tanggapan dari perusahaan.
                </div>
            </div>
        </div>

    <!-- Section 5: Logo Mitra -->
    <div class="carousel-container">
            <div class="carousel-track">
                <div class="logo-item">
                    <img src="{{ asset('images/telkomsel.png') }}" alt="Mitra 1" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/metranet.png') }}" alt="Mitra 2" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/telkominfra.png') }}" alt="Mitra 3" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/finnet.png') }}" alt="Mitra 4" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/agroteknik.jpg') }}" alt="Mitra 5" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/spunindo.png') }}" alt="Mitra 6" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/dbklik.png') }}" alt="Mitra 7" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/bankkalteng.png') }}" alt="Mitra 8" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/niaga logistic.png') }}" alt="Mitra 9" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/telin.png') }}" alt="Mitra 10" class="img-fluid" />
                </div>
                <!-- Duplicate set for seamless loop -->
                <div class="logo-item">
                    <img src="{{ asset('images/telkomsel.png') }}" alt="Mitra 1" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/metranet.png') }}" alt="Mitra 2" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/telkominfra.png') }}" alt="Mitra 3" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/finnet.png') }}" alt="Mitra 4" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/agroteknik.jpg') }}" alt="Mitra 5" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/spunindo.png') }}" alt="Mitra 6" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/dbklik.png') }}" alt="Mitra 7" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/bankkalteng.png') }}" alt="Mitra 8" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/niaga logistic.png') }}" alt="Mitra 9" class="img-fluid" />
                </div>
                <div class="logo-item">
                    <img src="{{ asset('images/telin.png') }}" alt="Mitra 10" class="img-fluid" />
                </div>
            </div>
        </div>
</section>
 <!-- Pembatas bawah footer -->
 <div class="footer-bottom text-white py-3">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo di kiri -->
            <div class="col-md-4">
                <img src="{{ asset('images/logo-hireme-white.png') }}" alt="Logo Telu" style="width: 100px;">
            </div>

            <!-- Kalimat di tengah -->
            <div class="col-md-4 text-center">
                <p class="footer-text mb-0">© 2025 Career Development Center Telkom University Surabaya</p>
            </div>

            <!-- Icon sosial media di kanan -->
            <div class="col-md-4 text-end">
                <a href="https://www.instagram.com/karir.telkomunivsby/" class="text-white mx-2" target="_blank">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="https://wa.me/082337538183" class="text-white mx-2" target="_blank">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </a>
            </div>
        </div>
    </div>

@endsection
