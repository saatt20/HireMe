@extends('layouts.navbarmitra')

<head>
    <link rel="stylesheet" href="{{ asset('css/kelola-lowongan.css') }}">
    <!-- Tambahkan Font Awesome CDN untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

@section('title', 'Kelola Lowongan')
{{-- Navbar --}}
@section('content')
<div class="container">
    <!-- Card Kelola Lowongan -->
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Kelola Lowongan</h4>
    </div>

    <!-- Card Tabel Lowongan -->
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('mitra.lowongan.create') }}"
                class="btn"
                style="background-color: #C71527; border-color: #C71527; color: white;">
                + Buat Lowongan
             </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Lowongan -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Posisi</th>
                        <th>Status Lowongan</th>
                        <th>Lokasi</th>
                        <th>Tanggal Dibuka</th>
                        <th>Tanggal Berakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowongans as $lowongan)
                        <tr>
                            <td>{{ $lowongan->judul }}</td>
                            <td>{{ $lowongan->status }}</td>
                            <td>{{ $lowongan->kota }}, {{ $lowongan->provinsi }}</td>
                            <td>{{ $lowongan->created_at->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($lowongan->deadline)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('mitra.lowongan.edit', $lowongan->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('mitra.lowongan.destroy', $lowongan->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus lowongan ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada lowongan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
