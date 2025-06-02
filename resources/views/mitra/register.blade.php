@extends('layouts.login')

@section('content')
<div class="container-fluid p-0" style="height: 100vh;">
    <div class="row no-gutters" style="height: 100vh;">
        <!-- Kolom kiri -->
        <div class="col-md-6 p-0">
            <div style="background-image: url('{{ asset('images/bg-company.png') }}');
                        background-size: cover;
                        background-position: center;
                        height: 100%;">
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="col-md-6 d-flex justify-content-center align-items-center bg-white p-0">
            <div class=" w-100">
                <!-- Logo -->
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('images/logo-telkom.png') }}" alt="Logo 1" class="mx-2" style="height: 40px;">
                    <img src="{{ asset('images/logo-hireme-new.png') }}" alt="Logo 2" class="mx-2" style="height: 40px;">
                </div>

                <div class="p-5 w-100">
                    <h3 class="mb-4 fw-bold text-center">Registrasi Mitra</h3>

                    <form method="POST" action="{{ route('register.mitra.submit') }}">
                        @csrf

                        <!-- Row: Telepon dan Email -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>

                                @error('username')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Nama Perusahaan -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input id="nama_perusahaan" type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" placeholder="Masukkan nama perusahaan" required>

                            @error('nama_perusahaan')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input id="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror"
                                    name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan nomor telepon" required>

                                @error('telepon')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Row: Kota dan Provinsi -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kota" class="form-label">Kota</label>
                                <input id="kota" type="text" class="form-control @error('kota') is-invalid @enderror"
                                    name="kota" value="{{ old('kota') }}" placeholder="Masukkan kota">

                                @error('kota')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                    name="provinsi" value="{{ old('provinsi') }}" placeholder="Masukkan provinsi">

                                @error('provinsi')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Row: Password dan Konfirmasi Password -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Masukkan password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <!-- Tombol Register -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-login btn-block py-2">
                                Register
                            </button>
                        </div>

                        <!-- Link ke login -->
                        <div class="text-center mt-3">
                            <span class="text-muted">Sudah punya akun?</span>
                            <a href="{{ route('company.login') }}" class="text-decoration-none fw-bold">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
