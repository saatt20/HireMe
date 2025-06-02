@extends('layouts.navbaradmin')

<head>
    <link rel="stylesheet" href="{{ asset('css/kelola-lowongan.css') }}">
    <!-- Tambahkan Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

@section('title', 'Kelola Lowongan')
@section('content')
<div class="container">
    <!-- Card Header -->
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Kelola Lowongan</h4>
    </div>

    <!-- Card Isi -->
    <div class="card">
        <div class="card-body">
            <!-- Tombol Tambah -->
            <div class="mb-3">
                <a href="{{ route('admin.lowongan.create') }}"
                   class="btn"
                   style="background-color: #C71527; border-color: #C71527; color: white;">
                   + Tambah Lowongan
                </a>
            </div>

            <!-- Alert -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Mitra</th>
                            <th>Link Pendaftaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lowongans as $index => $lowongan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start">{{ $lowongan->judul }}</td>
                                <td class="text-start">{{ Str::limit($lowongan->deskripsi, 50) }}</td>
                                <td>{{ $lowongan->mitra_nama }}</td>
                                <td>
                                    <a href="{{ $lowongan->link_pendaftaran }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-link"></i> Lihat
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.lowongan.edit', $lowongan->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.lowongan.destroy', $lowongan->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus lowongan ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada lowongan yang dibuat oleh admin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
