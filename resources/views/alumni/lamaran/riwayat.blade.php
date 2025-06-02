@extends('layouts.navbar')

@section('title', 'Riwayat Lamaran')

@section('title', 'Riwayat Lamaran')
{{-- Navbar --}}
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-index-mitra.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-4">

    {{-- Card Judul --}}
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="Riwayat" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Riwayat Lamaran</h4>
    </div>

    {{-- Card Tabel --}}
    <div class="card card-tabel shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="table-heading">
                            <th>No</th>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal Apply</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lamarans as $index => $lamaran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $lamaran->lowongan->judul ?? '-' }}</td>
                                <td>{{ $lamaran->lowongan->user->mitra->user->name ?? $lamaran->lowongan->mitra_nama ?? '-' }}</td>
                                <td>{{ $lamaran->lowongan->kota ?? '-' }}, {{ $lamaran->lowongan->provinsi ?? '-' }}</td>
                                <td>
                                    @if($lamaran->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($lamaran->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Menunggu</span>
                                    @endif
                                </td>
                                <td>{{ $lamaran->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($lamaran->status == 'diterima' && $lamaran->pesan_notifikasi)
                                        <a href="{{ route('lamaran.pemberitahuan', $lamaran->id) }}" class="btn btn-outline-primary btn-sm">Lihat</a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada lamaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
