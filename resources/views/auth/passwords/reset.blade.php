<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Password - HireMe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    :root {
      --red-dark: #880C16;
      --red-mid: #B01021;
      --red-light: #C71527;
    }

    .btn-hireme {
      background-color: var(--red-dark);
      color: #fff;
    }

    .btn-hireme:hover {
      background-color: #6f0a12;
      color: #fff;
    }

    .form-container {
      max-width: 500px;
      margin: 60px auto;
    }
  </style>
</head>
<body>

  <div class="container form-container">
    <h2 class="mb-4">Reset Password</h2>

    @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ $email ?? old('email') }}" required autofocus>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" required>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password-confirm" class="form-label">Konfirmasi Password Baru</label>
        <input id="password-confirm" type="password" class="form-control"
               name="password_confirmation" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-hireme">Reset Password</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
