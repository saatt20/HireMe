@extends('layouts.navbaradmin')

@section('title', 'Tambah Mitra')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create-mitra.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container mt-4">
    <div class="card bg-white rounded-4 shadow-sm p-4 mb-4">
        <h4 class="mb-0 fw-semibold">Buat Lowongan</h4>
    </div>

    <form action="{{ route('admin.mitra.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-columns d-flex flex-wrap gap-4">
            {{-- KIRI: Informasi Mitra --}}
            <div class="left-column flex-fill">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <a href="{{ route('admin.dashboard') }}" class="back-icon">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <br><br>
                        <h5 class="fw-bold mb-3">Informasi Mitra</h5>

                        <div class="mb-3">
                            <label for="logo" class="form-label fw-bold">Logo Mitra</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Mitra</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email Mitra</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label fw-bold">Nomor Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}">
                        </div>

                        <div class="mb-3">
                            <label for="kota" class="form-label fw-bold">Kota</label>
                            <input type="text" name="kota" class="form-control" id="kota" value="{{ old('kota') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="provinsi" class="form-label fw-bold">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" id="provinsi" value="{{ old('provinsi') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN: Registrasi --}}
            <div class="right-column" style="width: 100%; max-width: 360px;">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3 fw-bold">Registrasi Akun</h5>

                       <!-- Username input -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                placeholder="Buat username baru"
                                required
                            >
                        </div>

                        <!-- Password input -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Buat password baru"
                                required
                            >
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">Simpan Mitra</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
