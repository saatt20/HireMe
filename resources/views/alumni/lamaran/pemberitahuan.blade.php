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

@section('content')
<div class="container py-4">
    <div class="card bg-white rounded-4 shadow-sm p-4 mb-4 no-print">
        <h4 class="mb-0 fw-semibold">Riwayat Lamaran</h4>
    </div>

    <div class="card shadow-sm border-0 rounded-3 position-relative">
        <img src="{{ asset('images/logo-hireme-new.png') }}" class="watermark print-only" alt="Watermark">
        <a href="{{ route('alumni.riwayat') }}" class="back-icon no-print"><i class="fas fa-arrow-left"></i></a>

        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm position-absolute no-print"
            style="top: 1rem; right: 1rem; z-index: 10;">
            <i class="fas fa-print"></i>
        </button>

        <div class="card-body pt-5 print-content">
            <div class="print-only">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">PEMBERITAHUAN LAMARAN</h3>
                    <hr>
                </div>
            </div>

            <h5 class="card-title">{{ $lamaran->lowongan->judul }}</h5>
            <p class="mb-1"><strong>Perusahaan:</strong> {{ $lamaran->lowongan->user->name }}</p>
            <p class="mb-1"><strong>Status:</strong>
                <span class="badge print-status
                    @if($lamaran->status == 'Diterima') bg-success
                    @elseif($lamaran->status == 'Ditolak') bg-danger
                    @else bg-warning text-dark
                    @endif">
                    {{ ucfirst($lamaran->status) }}
                </span>
            </p>
            <p class="mb-3"><strong>Tanggal Lamaran:</strong> {{ $lamaran->created_at->format('d M Y') }}</p>

            <div class="alert alert-info print-message">
                {!! $lamaran->pesan ??
                'Setelah melalui proses seleksi administrasi dan evaluasi berkas,
                dengan ini kami menyampaikan bahwa <strong>Anda dinyatakan Lolos Seleksi Berkas</strong>.
                Besar harapan Kami untuk Anda bisa melanjutkan ke tahap berikutnya. Informasi lebih lanjut terkait jadwal dan teknis pelaksanaan
                tahap selanjutnya akan kami sampaikan setelah menerima konfirmasi dari Anda. <strong>Konfirmasi dapat dilakukan melalui
                Human Resources Department</strong> dengan melampirkan cetak bukti surat pernyataan Lolos Seleksi ke E-mail
                <strong>' . $lamaran->lowongan->user->email . '</strong>.' !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .print-only {
        display: none;
    }

    @media print {
        @page {
            margin: 1cm;
            size: A4;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
            color: black !important;
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .no-print,
        .navbar,
        .nav,
        .sidebar,
        .footer,
        .btn,
        .offcanvas,
        .modal,
        .dropdown,
        .toast,
        .alert-dismissible .btn-close,
        .main-sidebar,
        .navbar-main,
        .user-panel,
        .main-header,
        [class*="sidebar"],
        [class*="navbar"],
        [id*="sidebar"],
        [id*="navbar"] {
            display: none !important;
        }

        .print-only {
            display: block !important;
        }

        .container {
            width: 100% !important;
            max-width: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .card:first-child {
            display: none !important;
        }

        .card:last-child {
            box-shadow: none !important;
            border: none !important;
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 20px !important;
            margin: 0 !important;
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .print-only h3 {
            margin-bottom: 10px !important;
            font-size: 18pt;
            font-weight: bold;
        }

        .print-only hr {
            border: 1px solid black;
            margin: 10px 0 20px 0 !important;
            width: 100%;
        }

        .card-title {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 15px !important;
        }

        p {
            margin-bottom: 8px !important;
            font-size: 12pt;
        }

        .badge {
            background: #f8f9fa !important;
            color: black !important;
            border: 1px solid #333 !important;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .alert {
            background: #f8f9fa !important;
            border: 1px solid #333 !important;
            color: black !important;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0 !important;
            page-break-inside: avoid;
        }

        strong {
            font-weight: bold;
        }

        .card-body > *:first-child {
            margin-top: 0 !important;
        }

        .card:last-child::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%) rotate(-45deg);
            background-image: url("{{ url('images/logo-hireme-new.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 70%;
            opacity: 0.1;
            z-index: 0;
            pointer-events: none;
        }

        .card:last-child * {
            position: relative;
            z-index: 2;
        }

        .watermark {
        position: fixed;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        width: 500px;
        opacity: 0.06;
        z-index: 0;
        pointer-events: none;
        }

        .card-body {
        position: relative;
        z-index: 1;
        }
    }
</style>
@endpush
