@extends('layouts.navbar')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/lowongan.css') }}">
</head>

@section('title', 'Lowongan')
{{-- Navbar --}}
@section('content')
<div class="container my-4">

    <div class="search-wrapper mb-4 rounded-4 overflow-hidden shadow-sm">
        {{-- Header Merah --}}
        <div class="search-header text-start text-white py-4 px-4 bg-red-custom relative-container">
            <img src="{{ asset('images/Group-64.png') }}" alt="Lowongan" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
            <h4 class="fw-bold mb-1">Temukan Karier Impianmu!</h4>
            <p class="mb-0">Jelajahi peluang karier yang sesuai dengan minat kamu</p>
        </div>

        {{-- Form Search --}}
        <div class="search-body bg-white p-3">
            <form action="{{ route('alumni.lowongan.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    {{-- Keyword --}}
                    <div class="col-md-5">
                        <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari berdasarkan judul, perusahaan, skill..." value="{{ request('keyword') }}">
                    </div>

                    {{-- Lokasi --}}
                    <div class="col-md-4">
                        <select name="lokasi" class="form-select form-select-sm">
                            <option value="">Semua Lokasi</option>
                            @foreach($lokasiList as $lokasi)
                                <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>
                                    {{ $lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-danger w-100">
                            <i class="bi bi-search me-1"></i> Cari Lowongan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Lowongan --}}
    <div class="row">
        @php
            $activeLowongans = 0; // Counter untuk lowongan aktif
        @endphp

        @forelse ($lowongans as $lowongan)
            @php
                // Check if the deadline has passed
                $deadlinePassed = false;
                if (!empty($lowongan->deadline)) {
                    $deadline = \Carbon\Carbon::parse($lowongan->deadline);
                    $deadlinePassed = $deadline->isPast();
                }
            @endphp

            @if (!$deadlinePassed)
                @php $activeLowongans++; @endphp
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 rounded-4">
                        <div class="card-body">
                            {{-- Logo perusahaan --}}
                            <div class="d-flex align-items-center mb-2">
                            @php
                                // Cek apakah dibuat oleh admin
                                $isCreatedByAdmin = $lowongan->created_by_role === 'admin';

                                // Tentukan sumber logo berdasarkan role pembuat
                                if ($isCreatedByAdmin) {
                                    $logoPath = $lowongan->mitra_logo ?? null;
                                } else {
                                    $logoPath = $lowongan->user->mitra->logo ?? null;
                                }
                            @endphp
                            <img src="{{ $logoPath ? asset('storage/' . $logoPath) : asset('images/logo-default.png') }}" alt="Logo" class="me-2 rounded" width="40" height="40">

                                {{-- Judul lowongan --}}
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ $lowongan->judul }}</h6>
                                    <small class="text-muted">{{ $lowongan->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            {{-- Nama perusahaan --}}
                            <div class="mt-2">
                                @php
                                    // Tentukan nama perusahaan berdasarkan role pembuat
                                    $namaPerusahaan = $isCreatedByAdmin
                                        ? $lowongan->mitra_nama
                                        : $lowongan->user->name;
                                @endphp
                                <span class="bold-text">{{ $namaPerusahaan }}</span>
                            </div>

                            {{-- Lokasi & status --}}
                            <div class="mb-3">
                                <div class="mb-2">
                                    <small class="text-muted d-flex align-items-center">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $lowongan->kota }}, {{ $lowongan->provinsi }}
                                    </small>
                                </div>

                                @php
                                    $status = strtolower(trim($lowongan->status));
                                    $badgeClass = match($status) {
                                        'full time' => 'bg-success',
                                        'part time' => 'bg-primary',
                                        'internship' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp

                                <div>
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $lowongan->status }}
                                    </span>
                                </div>

                                {{-- Nama perusahaan dari field perusahaan --}}
                                <div class="mt-2">
                                    <strong>{{ $lowongan->perusahaan }}</strong>
                                </div>
                            </div>

                            {{-- Skills --}}
                            <div class="mb-2">
                                @php
                                    $skillArray = array_map('trim', explode(',', $lowongan->skills));
                                    $displayedSkills = array_slice($skillArray, 0, 3);
                                    $remainingCount = count($skillArray) - count($displayedSkills);
                                @endphp

                                @foreach($displayedSkills as $skill)
                                    <span class="badge bg-light text-dark border">{{ $skill }}</span>
                                @endforeach

                                @if ($remainingCount > 0)
                                    <span class="badge bg-secondary">+{{ $remainingCount }}</span>
                                @endif
                            </div>

                            {{-- Deadline info --}}
                            {{-- <div class="mb-2">
                                <small class="text-muted d-flex align-items-center">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Deadline: {{ !empty($lowongan->deadline) ? \Carbon\Carbon::parse($lowongan->deadline)->format('d M Y') : 'Tidak ada deadline' }}
                                </small>
                            </div> --}}

                            {{-- Lihat detail --}}
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('alumni.lowongan.show', $lowongan->id) }}" class="text-danger text-decoration-none">Lihat...</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <p>Tidak ada lowongan tersedia saat ini.</p>
        @endforelse

        @if ($lowongans->count() > 0 && $activeLowongans === 0)
            <div class="col-12">
                <p>Semua lowongan sudah melewati deadline.</p>
            </div>
        @endif
    </div>
</div>
@endsection
