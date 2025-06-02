@extends('layouts.navbar')

{{-- Font Awesome CDN --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .back-icon {
    color: black;
    font-size: 22px;
    text-decoration: none;
    margin-bottom: 20px;
    position: absolute;
    top: 1rem;
    left: 1rem;
    }
</style>

@section('title', 'Pemberitahuan Lamaran - Alumni')
{{-- Navbar --}}
@section('content')
<div class="container py-4">
    <div class="card bg-white rounded-4 shadow-sm p-4 mb-4">
        <h4 class="mb-0 fw-semibold">Riwayat Lamaran</h4>
    </div>
    <div class="card shadow-sm border-0 rounded-3 position-relative">
        {{-- Tombol Back (pojok kiri atas dalam card) --}}
        <a href="{{ route('alumni.riwayat') }}"
        class="back-icon"><i class="fas fa-arrow-left"></i>
        </a>

        {{-- Tombol Print (pojok kanan atas dalam card) --}}
        <button onclick="window.print()"
                class="btn btn-outline-secondary btn-sm position-absolute no-print"
                style="top: 1rem; right: 1rem; z-index: 10;">
            <i class="fas fa-print"></i>
        </button>

        <div class="card-body pt-5">
            <h5 class="card-title">{{ $lamaran->lowongan->judul }}</h5>
            <p class="mb-1"><strong>Perusahaan:</strong> {{ $lamaran->lowongan->user->name }}</p>
            <p class="mb-1"><strong>Status:</strong>
                <span class="badge
                    @if($lamaran->status == 'Diterima') bg-success
                    @elseif($lamaran->status == 'Ditolak') bg-danger
                    @else bg-warning text-dark
                    @endif">
                    {{ ucfirst($lamaran->status) }}
                </span>
            </p>
            <p class="mb-3"><strong>Tanggal Lamaran:</strong> {{ $lamaran->created_at->format('d M Y') }}</p>

            {{-- Isi pemberitahuan --}}
            <div class="alert alert-info">
                {!! $lamaran->pesan ??
                    'Setelah melalui proses seleksi administrasi dan evaluasi berkas,
                    dengan ini kami menyampaikan bahwa <strong>Anda dinyatakan Lolos Seleksi Berkas</strong>.
                    Besar harapan Kami untuk Anda bisa melanjutkan ke tahap berikutnya. Informasi lebih lanjut terkait jadwal dan teknis pelaksanaan
                    tahap selanjutnya akan kami sampaikan setelah menerima konfirmasi dari Anda. <strong>Konfirmasi dapat dilakukan melalui
                    Human Resources Department</strong> dengan melampirkan cetak bukti surat pernyataan Lolos Seleksi ke E-mail
                    <strong>' . $lamaran->lowongan->user->email . '</strong>.'
                !!}
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Sembunyikan elemen dengan class no-print saat print */
    @media print {
        .no-print,
        .no-print * {
            display: none !important;
        }

        .navbar {
            display: none !important;
        }
    }
</style>
@endpush
