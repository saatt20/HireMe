@extends('layouts.navbarmitra')

@section('title', 'Detail Rekrutmen')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-index-mitra.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-4">

    {{-- Card Judul --}}
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Detail Rekrutmen: {{ $lowongan->judul }}</h4>
        <p class="mb-0 mt-2"><strong>Jumlah Pelamar:</strong> {{ $lowongan->lamarans->count() }}</p>
    </div>

    {{-- Card Tabel --}}
    <div class="card card-tabel shadow-sm">
        <a href="{{ route('mitra.rekrutmen.index') }}"
        class="back-icon"><i class="fas fa-arrow-left"></i>
        </a>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="table-heading">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>CV</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowongan->lamarans as $index => $lamaran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $lamaran->user->name ?? '-' }}</td>
                                <td>{{ $lamaran->user->alumni->telepon ?? '-' }}</td>
                                <td>{{ $lamaran->user->email ?? '-' }}</td>
                                <td>
                                    @if($lamaran->cv_pdf)
                                        <a href="{{ asset('storage/' . $lamaran->cv_pdf) }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="fas fa-file-pdf"></i> Lihat CV
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($lamaran->status) }}</td>
                                <td class="d-flex gap-1">
                                    <form action="{{ route('mitra.rekrutmen.terima', $lamaran->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm" title="Terima">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('mitra.rekrutmen.tolak', $lamaran->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-custom-red btn-sm" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pelamar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
