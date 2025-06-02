@extends('layouts.navbar')

<head>
    <link rel="stylesheet" href="{{ asset('css/lowongan-detail.css') }}">
</head>

@section('title', 'Detail Lowongan')
{{-- Font Awesome CDN --}}
@section('content')
<div class="container my-4">
    <div class="card card-detail">
        <div class="row">
            {{-- Kolom Kiri: Detail Lowongan --}}
            <div class="col-md-8 pe-md-4 border-md-end">
                {{-- Logo dan Judul --}}
                <div class="d-flex align-items-center mb-3">
                    @php
                        // Cek apakah dibuat oleh admin
                        $isCreatedByAdmin = $lowongan->created_by_role === 'admin';

                        // Tentukan sumber logo berdasarkan role pembuat
                        if ($isCreatedByAdmin) {
                            $logoPath = $lowongan->mitra_logo ?? null;
                        } else {
                            $logoPath = $lowongan->user->mitra->logo ?? null;
                        }

                        // Tentukan nama perusahaan berdasarkan role pembuat
                        $namaPerusahaan = $isCreatedByAdmin
                            ? $lowongan->mitra_nama
                            : $lowongan->user->name;

                        // Cek apakah alumni sudah pernah melamar
                        $sudahMelamar = false;
                        if (auth()->check() && auth()->user()->role === 'alumni') {
                            $sudahMelamar = \App\Models\Lamaran::where('lowongan_id', $lowongan->id)
                                ->where('user_id', auth()->id())
                                ->exists();
                        }
                    @endphp
                    <img src="{{ $logoPath ? asset('storage/' . $logoPath) : asset('images/logo-default.png') }}" alt="Logo" class="me-2 rounded" width="40" height="40">
                    <div>
                        <h3 class="mb-1">{{ $lowongan->judul }}</h3>
                        <p class="text-muted mb-0">
                            <strong>{{ $namaPerusahaan }}</strong> • {{ $lowongan->kota }}, {{ $lowongan->provinsi }}
                        </p>
                    </div>
                    <div class="ms-auto">
                        @php
                            $status = strtolower(trim($lowongan->status));
                            $badgeClass = match($status) {
                                'full time' => 'bg-success',
                                'part time' => 'bg-primary',
                                'internship' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $lowongan->status }}</span>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <h5>Deskripsi pekerjaan:</h5>
                    <p>{{ $lowongan->deskripsi }}</p>
                </div>

                {{-- Kualifikasi --}}
                <div class="mb-4">
                    <h5>Kualifikasi:</h5>
                    <ul>
                        @foreach(explode("\n", $lowongan->kualifikasi) as $kualifikasi)
                            <li>{{ trim($kualifikasi) }}</li>
                        @endforeach
                    </ul>
                </div>

                {{-- Skills --}}
                <div class="mb-4">
                    <h5>Skills:</h5>
                    @foreach(explode(',', $lowongan->skills) as $skill)
                        <span class="skill-badge me-1 mb-1 d-inline-block">{{ trim($skill) }}</span>
                    @endforeach
                </div>

                {{-- Gaji --}}
                @if($lowongan->gaji_min || $lowongan->gaji_max)
                    <div class="mb-4">
                        <h5>Gaji yang Ditawarkan:</h5>
                        <p>
                            @if($lowongan->gaji_min && $lowongan->gaji_max)
                                {{ $lowongan->gaji_min }} - {{ $lowongan->gaji_max }}
                            @elseif($lowongan->gaji_min)
                                Mulai dari {{ $lowongan->gaji_min }}
                            @elseif($lowongan->gaji_max)
                                Hingga {{ $lowongan->gaji_max }}
                            @endif
                        </p>
                    </div>
                @endif

                {{-- Deadline --}}
                <div class="mb-4">
                    <h5>Deadline:</h5>
                    <p>{{ \Carbon\Carbon::parse($lowongan->deadline)->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            {{-- Kolom Kanan: Info Mitra --}}
            <div class="col-md-4 ps-md-4">
                <h5 class="fw-bold">Tentang Mitra</h5>
                <p class="mb-1"><strong>Nama Mitra</strong></p>
                @php
                    // Tentukan nama mitra berdasarkan role pembuat
                    $namaMitra = $isCreatedByAdmin
                        ? $lowongan->mitra_nama
                        : $lowongan->user->name;
                @endphp
                <p>{{ $namaMitra }}</p>

                <p class="mb-1"><strong>Lokasi Mitra</strong></p>
                @php
                    // Tentukan lokasi mitra berdasarkan role pembuat
                    if ($isCreatedByAdmin) {
                        $kotaMitra = $lowongan->kota;
                        $provinsiMitra = $lowongan->provinsi;
                    } else {
                        $kotaMitra = $lowongan->user->mitra->kota;
                        $provinsiMitra = $lowongan->user->mitra->provinsi;
                    }
                @endphp
                <p>{{ $kotaMitra }}, {{ $provinsiMitra }}</p>

                <p class="mb-1"><strong>Deskripsi Mitra</strong></p>
                @php
                    // Tentukan deskripsi mitra berdasarkan role pembuat
                    $deskripsiMitra = $isCreatedByAdmin
                        ? $lowongan->mitra_deskripsi
                        : $lowongan->user->mitra->deskripsi;
                @endphp
                <p>{{ $deskripsiMitra }}</p>

                <hr class="my-4">
                <div class="d-grid gap-2">
                    @if($sudahMelamar)
                        {{-- Jika alumni sudah pernah melamar --}}
                        <button type="button" class="btn text-white disabled" style="background-color: #C71527;" data-bs-toggle="tooltip" data-bs-placement="top" title="Anda telah mengirim lamaran pada lowongan ini">
                            Lamar Pekerjaan
                        </button>
                        <div class="alert alert-info mt-2">
                            <i class="bi bi-info-circle-fill"></i> Anda telah mengirim lamaran pada lowongan ini.
                        </div>
                    @elseif($isCreatedByAdmin && $lowongan->link_pendaftaran)
                        {{-- Jika dibuat admin dan ada link pendaftaran, gunakan link eksternal --}}
                        <a href="{{ $lowongan->link_pendaftaran }}" target="_blank" class="btn text-white" style="background-color: #C71527;">
                            Lamar Pekerjaan
                        </a>
                    @elseif(isset($hasCV) && $hasCV)
                        {{-- Jika dibuat mitra dan user memiliki CV, gunakan modal --}}
                        <button type="button" class="btn text-white" style="background-color: #C71527;" data-bs-toggle="modal" data-bs-target="#cvReviewModal">
                            Lamar Pekerjaan
                        </button>
                    @else
                        {{-- Jika user tidak memiliki CV --}}
                        <button type="button" class="btn text-white disabled" style="background-color: #C71527;" data-bs-toggle="tooltip" data-bs-placement="top" title="Anda harus membuat CV terlebih dahulu">
                            Lamar Pekerjaan
                        </button>
                        <div class="alert alert-warning mt-2">
                            <i class="bi bi-exclamation-triangle-fill"></i> Anda harus <a href="{{ route('alumni.cv.index') }}">membuat CV</a> terlebih dahulu untuk melamar pekerjaan ini.
                        </div>
                    @endif
                    <a href="{{ route('alumni.lowongan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal CV Preview -->
@if(isset($hasCV) && $hasCV && !($isCreatedByAdmin && $lowongan->link_pendaftaran) && !$sudahMelamar)
<div class="modal fade" id="cvReviewModal" tabindex="-1" aria-labelledby="cvReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="cvReviewModalLabel">Preview CV</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <!-- Kertas CV -->
        <div class="cv-paper mx-auto cv-paper-smaller">
          @include('alumni.cv.partials.cv-preview')
        </div>
      </div>

      <!-- Tombol kirim lamaran dipindahkan ke bawah -->
      <div class="modal-footer justify-content-center">
        <form action="{{ route('lamaran.kirim', $lowongan->id) }}" method="POST" class="d-print-none w-50">
            @csrf
            <button type="submit" class="btn text-white w-100" style="background-color: #C71527; padding: 10px 0;">
                <i class="bi bi-send"></i> Kirim Lamaran
            </button>
        </form>
      </div>

    </div>
  </div>
</div>
@endif

<style>
.cv-paper-smaller {
    width: 100%;
    max-width: 18cm;
    min-height: auto;
    padding: 0.5cm 0.5cm; /* Mengurangi padding kanan kiri */
    transform: scale(0.9);
    margin: -20px auto;
}

/* Memperkecil teks dalam CV Preview */
.modal .cv-preview {
    padding: 0.8rem !important; /* Mengurangi padding pada container CV */
}

.modal .cv-name {
    font-size: 1.5rem !important;
}

.modal .cv-contact,
.modal .cv-location {
    font-size: 0.85rem !important;
}

.modal .cv-section h4 {
    font-size: 1.1rem !important;
    margin-bottom: 0.5rem !important;
}

.modal .cv-entry strong,
.modal .cv-entry-left,
.modal .cv-entry-right {
    font-size: 0.9rem !important;
}

.modal .cv-description-list li,
.modal .cv-section p {
    font-size: 12px !important;
    line-height: 1.4 !important;
}

.modal .cv-section {
    margin-bottom: 1.5rem !important;
}

.modal .cv-description-list {
    margin-top: 0.3rem !important;
}

.modal hr {
    margin-bottom: 0.75rem !important;
}

/* Memperbaiki indentasi pada bagian pengalaman */
.modal .cv-section > ul {
    padding-left: 0 !important;
    list-style-type: none !important;
    margin-left: 0 !important;
}

.modal .cv-entry {
    padding-left: 0 !important;
    margin-left: 0 !important;
}

/* Memberikan indentasi pada list di dalam (cv-description-list) */
.modal .cv-description-list {
    padding-left: 20px !important;
    margin-left: 10px !important;
}
</style>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Inisialisasi tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection

<style>
    .cv-paper {
        width: 21cm;
        min-height: 29.7cm;
        padding: 2cm;
        background: white;
        box-shadow: 0 0 5px rgba(0,0,0,0.15);
        margin: 1rem auto;
        border-radius: 8px;
    }

    /* Print Styles */
    @media print {
        body * {
            visibility: hidden;
        }

        .cv-paper, .cv-paper * {
            visibility: visible;
        }

        .cv-paper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            padding: 0 !important;
            box-shadow: none;
            border-radius: 0;
        }

        .modal, .modal-dialog, .modal-content, .modal-header, .modal-body {
            all: unset;
        }
    }
</style>
