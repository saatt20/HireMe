<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HireMe - Landing Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- Menambahkan Font Awesome untuk ikon sosial media -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    :root {
      --red-dark: #880C16;
      --red-mid: #B01021;
      --red-light: #C71527;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: var(--red-dark) !important;
    }

    .nav-link {
      font-weight: 500;
    }

    .btn-login {
      border-radius: 10px;
      padding: 6px 10px;
    }

    .btn-hireme {
      background-color: var(--red-dark);
      color: #fff;
    }

    .btn-hireme:hover {
      background-color: #6f0a12;
      color: #fff;
    }

    .btn-outline-hireme {
      border: 2px solid var(--red-dark);
      color: var(--red-dark);
      background-color: transparent;
      border-radius: 10px;
      padding: 6px 10px;
      transition: 0.3s;
    }

    .btn-outline-hireme:hover {
      background-color: var(--red-dark);
      color: #fff;
    }

    .hero-section,
    .section-reverse {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
    }

    .hero-section .text,
    .section-reverse .text {
      flex: 1;
      padding: 60px 40px;
    }

    .hero-section .image,
    .section-reverse .image {
      flex: 1;
    }

    .hero-section {
        margin-bottom: 5px;
    }

    .hero-section img,
    .section-reverse img {
      width: 100%;
      height: 100%;
      object-fit: cover;
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

    .features {
      padding: 60px 0;
      text-align: center;
      background-color: #fff;
    }

    .features h2 {
      font-weight: bold;
      margin-bottom: 10px;
    }

    .features p {
      color: #666;
      margin-bottom: 40px;
    }

    .row.g-4 {
      display: flex;
      flex-wrap: wrap;
    }

    .feature-card {
      position: relative;
      border: 2px solid var(--red-dark);
      border-radius: 20px;
      padding: 30px 20px;
      transition: 0.3s;
      background-color: #fff;
      overflow: hidden;
      text-align: center;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      min-height: 350px;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: -40px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 80px;
      background-color: #fff;
      border: 2px solid var(--red-dark);
      border-radius: 50%;
      z-index: 1;
    }

    .feature-card h5 {
      margin-top: 50px;
      font-weight: bold;
      color: var(--red-dark);
    }

    .feature-card p {
      color: #444;
    }

    .feature-card:hover {
      background: linear-gradient(to bottom, var(--red-dark), var(--red-mid), var(--red-light));
      color: #fff;
      transform: translateY(-5px);
    }

    .feature-card:hover h5,
    .feature-card:hover p {
      color: #fff;
    }

       /* Style untuk Section 3 Langkah Mudah */
    .steps-section {
      background-color: #f5f5f5; /* Background abu-abu muda */
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

    .register-button {
      text-align: center;
      margin-top: 50px;
    }

    .btn-register {
      background-color: var(--red-dark);
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 25px;
      font-weight: bold;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-block;
    }

    .btn-register:hover {
      background-color: #6f0a12;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(136, 12, 22, 0.3);
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

    .footer-custom {
    background: linear-gradient(to bottom, #333333, #111111);
  }

  .footer-custom a:hover {
    color: #ff4757; /* merah saat hover */
  }

  .footer-bottom {
    background: linear-gradient(to bottom, var(--red-dark), var(--red-mid), var(--red-light));
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 10px;
}

/* Agar teks tidak terpotong dan tetap pada satu baris */
.footer-text {
    white-space: nowrap; /* Mencegah teks terpotong atau terpecah ke baris berikutnya */
    /* overflow: hidden; /* Pastikan teks yang panjang tidak keluar dari kontainer */
    /* text-overflow: ellipsis; Jika teks sangat panjang, beri tanda elipsis */
    width: 100%; /* Pastikan lebar kolom cukup untuk menampung teks */
    text-align: center; /* Pastikan teks sejajar di tengah */
}

  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo-hireme-new.png') }}" alt="Logo" height="30" class="me-2"/>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav me-4">
          <li class="nav-item">
            <a class="nav-link active" href="#">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tentang Kami</a>
          </li>
        </ul>
        <div class="d-flex gap-2">
          <a href="{{ route('login') }}" class="btn btn-outline-hireme btn-login">Job Seeker Sign In</a>
          <a href="{{ route('company.login') }}" class="btn btn-hireme btn-login">Company Sign In</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero-section">
    <div class="text ps-5">
        <p class="text-danger fw-bold mb-0">Career Development Center</p>
        <p class="text-secondary mb-3">Telkom University Surabaya</p>
      <h1 class="fw-bold">Cari Dan Wujudkan Karier Impianmu Sekarang</h1>
      <p class="mt-3">Jelajahi lowongan kerja, tunjukkan keahlian, dan biarkan perusahaan menemukanmu dengan mudah. Dengan sistem yang terintegrasi, proses rekrutmen menjadi cepat dan tepat sasaran.</p>
      <a href="{{ route('login') }}" class="btn btn-hireme mt-3">Mulai</a>
    </div>
    <div class="image">
      <img src="{{ asset('images/bagian-1.png') }}" alt="Hero Image"/>
    </div>
  </div>

  <!-- Red Separator -->
  <div class="section-bg-red">
    <h1 class="fw-bold">Career Development Center Telkom University Surabaya</h1></div>

  <!-- Second Section -->
  <div class="section-reverse">
    <div class="image">
      <img src="{{ asset('images/bagian2.png') }}" alt="Second Section Image"/>
    </div>
    <div class="text pe-5">
      <h2 class="fw-bold">Solusi Cerdas Cari Kerja Bersama <span style="color: var(--red-dark)">HireMe</span></h2>
      <p>Career Development Center menawarkan solusi inovatif dalam menghubungkan pencari kerja dengan perusahaan secara lebih efisien. Dengan sistem yang terintegrasi, kami tidak hanya menyediakan akses ke berbagai lowongan pekerjaan, tetapi juga fitur Pooling CV, yang memungkinkan mitra perusahaan menemukan kandidat potensial tanpa harus membuka lowongan baru.</p>
      <a href="#" class="btn btn-hireme mt-3">Kenapa HireMe?</a>
    </div>
  </div>

  <!-- Features Section -->
  <div class="features container">
    <h2>Jembatan Menuju Karir Impian</h2>
    <p>Dengan HireMe, langkah menuju karier impian menjadi lebih dekat dan lebih mudah.</p>
    <div class="row g-4">
      <div class="col-md-4 d-flex">
        <div class="feature-card w-100">
          <h5>Peluang Karier Tanpa Batas</h5>
          <p>Temukan pekerjaan yang sesuai dengan keterampilan dan minatmu dari berbagai perusahaan terpercaya. Unggah CV, dan lamar pekerjaan kapan saja dan di mana saja melalui HireMe.</p>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="feature-card w-100">
          <h5>Terhubung dengan Perusahaan Terbaik</h5>
          <p>Bekerja sama dengan banyak mitra industri, untuk mendapatkan akses langsung ke perusahaan yang tepat, membuka peluang lebih luas dan meningkatkan kesempatan kerja.</p>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="feature-card w-100">
          <h5>CV Profesionals</h5>
          <p>Bangun CV yang terstruktur dan menarik langsung di platform HireMe. Tampilkan pengalaman, pendidikan, dan keahlianmu dengan format profesional yang memudahkan perusahaan untuk mengenal potensimu lebih dalam.</p>
        </div>
      </div>
    </div>
  </div>

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

        <!-- Register Button -->
        <div class="register-button">
            <a href="{{ route('register') }}" class="btn-register">Registrasi Sekarang</a>
        </div>
    </div>
</div>

    <!-- Section 5: Logo Mitra -->
    <div class="container py-5">
      <div class="text-center mb-4">
        <h2 class="fw-bold">Dipercaya oleh Perusahaan Mitra</h2>
        <p class="text-muted">Berikut adalah beberapa perusahaan yang telah bekerja sama dengan kami.</p>
      </div>
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
    </div>

    <!-- Footer -->
<footer class="footer-custom text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row">
            <!-- Logo di kiri -->
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/telu-footer.png') }}" alt="Logo Telu" style="width: 100px;">
                <!-- Ganti src dengan path logomu -->
            </div>

            <!-- Menu di kanan, menggunakan flexbox untuk posisi kanan -->
            <div class="col-md-8 d-flex justify-content-end align-items-start">
                <div class="row">
                    <!-- Jelajahi -->
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-bold">Jelajahi</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Beranda</a></li>
                        </ul>
                    </div>

                    <!-- Kontak Kami -->
                    <div class="col-md-6 mb-4">
                        <h5 class="fw-bold">Kontak Kami</h5>
                        <ul class="list-unstyled">
                            <li><a href="mailto:info@hireme.com" class="text-white">info@hireme.com</a></li>
                            <li><a href="tel:+1234567890" class="text-white">+123 456 7890</a></li>
                            <li><a href="#" class="text-white">Alamat Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

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
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
