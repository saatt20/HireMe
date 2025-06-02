<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lupa Password - HireMe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
            <a class="nav-link active" href="{{ route('landing') }}">Beranda</a>
          </li>
        </ul>
        <div class="d-flex gap-2">
          <a href="{{ route('login') }}" class="btn btn-outline-hireme btn-login">Job Seeker Sign In</a>
          <a href="{{ route('company.login') }}" class="btn btn-hireme btn-login">Company Sign In</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Konten Halaman -->
  <div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Lupa Password</h2>

    <!-- Alert sukses jika reset berhasil dikirim -->
    @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus>
      </div>
      <button type="submit" class="btn btn-hireme">Kirim Link Reset Password</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
