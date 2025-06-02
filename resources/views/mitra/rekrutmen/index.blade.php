@extends('layouts.navbarmitra')

<head>
    <link rel="stylesheet" href="{{ asset('css/kelola-lowongan.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

@section('title', 'Rekrutmen')
@section('content')
<div class="container">
    <!-- Card Rekrutmen -->
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Rekrutmen</h4>
    </div>

    <!-- Card Tabel -->
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Posisi</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th>Tanggal Dibuka</th>
                        <th>Tanggal Berakhir</th>
                        <th>Jumlah Pelamar</th>
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
                            <td>{{ $lowongan->lamarans_count }}</td>
                           <td>
                                <a href="{{ route('mitra.rekrutmen.show', $lowongan->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada lowongan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
