@extends('layouts.login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="container-fluid p-0" style="height: 100vh;">
    <div class="row no-gutters" style="height: 100vh;">
        <!-- Kiri: Gambar -->
        <div class="col-md-6 p-0">
            <div style="background-image: url('{{ asset('images/telkom-bg.png') }}');
                        background-size: cover;
                        background-position: center;
                        height: 100%;"></div>
        </div>

        <!-- Kanan: Form -->
        <div class="col-md-6 d-flex justify-content-center align-items-center bg-white p-0">
            <div class="p-0 w-100">
                <!-- Logo -->
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('images/logo-telkom.png') }}" alt="Logo Telkom" class="mx-2" style="height: 40px;">
                    <img src="{{ asset('images/logo-hireme-new.png') }}" alt="Logo HireMe" class="mx-2" style="height: 40px;">
                </div>

                <!-- Login Form -->
                <div class="p-4 mx-auto" style="width: 100%; max-width: 500px;">
                    <h3 class="mb-3 fw-bold text-center">Login</h3>
                    <p class="mb-0 fw-reguler text-center">Selamat datang kembali</p>
                    <p class="mb-4 fw-reguler text-center">Silahkan masuk untuk melamar pekerjaan</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input id="username" type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   name="username" value="{{ old('username') }}"
                                   placeholder="Masukkan username" required autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" placeholder="Masukkan password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                            @if (Route::has('password.request'))
                                <div class="mb-2 text-start">
                                    <a class="text-decoration-none text-muted small" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-login py-2">Masuk</button>
                        </div>

                        <!-- Register -->
                        <div class="text-center mt-3">
                            <span class="text-muted">Belum mempunyai akun? </span>
                            <a href="{{ route('register') }}" class="text-decoration-none text-danger fw-bold">Registrasi Akun</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
