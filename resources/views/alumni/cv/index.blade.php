@extends('layouts.navbar') {{-- Sesuaikan layout alumni jika berbeda --}}
<link href="{{ asset('css/cv.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

{{-- Tambahkan CSS untuk kondisi print --}}
<style>
@media print {
    .no-print {
        display: none !important;
    }

    /* Kategori yang akan disembunyikan jika kosong saat cetak */
    .empty-section {
        display: none !important;
    }

    /* Style tambahan untuk cetak */
    .cv-card {
        border: none !important;
        box-shadow: none !important;
        /* padding: 0 !important; */
    }

    /*  watermark tetap terlihat saat cetak */
    .watermark-footer {
        display: block !important;
        position: fixed;
        bottom: 10px;
        width: 100%;
        text-align: center;
        font-size: 10pt;
        color: #999;
    }
}
</style>

@section('title', 'CV Alumni')
@section('content')
<div class="container cv-preview">
    @if(session('success'))
        <div class="alert alert-success no-print">{{ session('success') }}</div>
    @endif

    {{-- Card Judul --}}
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Buat CV</h4>
    </div>

    {{-- Card Isi CV --}}
    <div class="cv-card">
        <div class="d-flex justify-content-end mb-3 no-print">
            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="fas fa-print"></i>
            </button>
        </div>
        {{-- Header: Logo --}}

        {{-- Header: Nama dan Kontak --}}
        <h2 class="cv-name">{{ $user->name }}</h2>
        <p class="cv-contact">{{ $alumni->telepon ?? 'Belum ada data' }} | {{ $user->email }} | {{ $alumni->linkedin ?? 'Belum ada data' }}</p>
        <p class="cv-location">{{ $alumni->kota ?? 'Belum ada data' }}, {{ $alumni->provinsi ?? 'Belum ada data' }}</p>

        {{-- Tentang Saya --}}
        @php
            $hasTentangSaya = isset($cv->tentang_saya) && trim($cv->tentang_saya) !== '' && $cv->tentang_saya !== 'Belum ada data';
        @endphp
        <div class="cv-section @if(!$hasTentangSaya) empty-section @endif">
            <h4>Tentang Saya</h4>
            <p>{{ $cv->tentang_saya ?? 'Belum ada data' }}</p>
        </div>

        {{-- Riwayat Pendidikan --}}
        @php
            $hasPendidikan = isset($cv->riwayat_pendidikan) && is_array($cv->riwayat_pendidikan) && count($cv->riwayat_pendidikan) > 0;
        @endphp
        <div class="cv-section @if(!$hasPendidikan) empty-section @endif">
            <h4>Riwayat Pendidikan</h4>
            <ul>
                @if($hasPendidikan)
                    @foreach($cv->riwayat_pendidikan as $pendidikan)
                        <li class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>{{ $pendidikan['nama_sekolah'] ?? '-' }}</strong><br>
                                {{ $pendidikan['tingkat'] ?? '-' }} - {{ $pendidikan['jurusan'] ?? '-' }}
                                <ul class="cv-description-list">
                                    @foreach(explode("\n", $pendidikan['info_tambahan'] ?? '') as $poin)
                                        @if(trim($poin) != '')
                                            <li>{{ $poin }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="cv-entry-right text-end">
                                <div><strong>{{ $pendidikan['lokasi'] ?? '-' }}</strong></div>
                                <div><strong>{{$pendidikan['tahun_mulai'] ?? '-' }} - {{ $pendidikan['tahun_lulus'] ?? '-' }}</strong></div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="no-print">Belum ada data</p>
                @endif
            </ul>
        </div>

        {{-- Pengalaman Kerja --}}
        @php
            $hasKerja = isset($cv->pengalaman_kerja) && is_array($cv->pengalaman_kerja) && count($cv->pengalaman_kerja) > 0;
        @endphp
        <div class="cv-section @if(!$hasKerja) empty-section @endif">
            <h4>Pengalaman Kerja</h4>
            <ul>
                @if($hasKerja)
                    @foreach($cv->pengalaman_kerja as $kerja)
                        <li class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>{{ $kerja['posisi'] ?? '-' }}</strong><br>
                                {{ $kerja['nama_perusahaan'] ?? '-' }}
                                <ul class="cv-description-list">
                                    @foreach(explode("\n", $kerja['info_tambahan'] ?? '') as $poin)
                                        @if(trim($poin) != '')
                                            <li>{{ $poin }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="cv-entry-right text-end">
                                <div><strong>{{ $kerja['lokasi'] ?? '-' }}</strong></div>
                                <div><strong>{{ $kerja['tahun_mulai'] ?? '-' }} - {{ $kerja['tahun_selesai'] ?? '-' }}</strong></div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="no-print">Belum ada data</p>
                @endif
            </ul>
        </div>

        {{-- Pengalaman Organisasi --}}
        @php
            $hasOrganisasi = isset($cv->pengalaman_organisasi) && is_array($cv->pengalaman_organisasi) && count($cv->pengalaman_organisasi) > 0;
        @endphp
        <div class="cv-section @if(!$hasOrganisasi) empty-section @endif">
            <h4>Pengalaman Organisasi</h4>
            <ul>
                @if($hasOrganisasi)
                    @foreach($cv->pengalaman_organisasi as $org)
                        <li class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>{{ $org['posisi'] ?? '-' }}</strong><br>
                                {{ $org['nama_organisasi'] ?? '-' }}
                                <ul class="cv-description-list">
                                    @foreach(explode("\n", $org['info_tambahan'] ?? '') as $poin)
                                        @if(trim($poin) != '')
                                            <li>{{ $poin }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="cv-entry-right text-end">
                                <div><strong>{{ $org['lokasi'] ?? '-' }}</strong></div>
                                <div><strong>{{ $org['tahun_mulai'] ?? '-' }} - {{ $org['tahun_selesai'] ?? '-' }}</strong></div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="no-print">Belum ada data</p>
                @endif
            </ul>
        </div>

        {{-- Skill --}}
        @php
            $hasSkill = isset($cv->skill) && trim($cv->skill) !== '' && $cv->skill !== 'Belum ada data';
        @endphp
        <div class="cv-section @if(!$hasSkill) empty-section @endif">
            <h4>Skill</h4>
            <p>{{ $cv->skill ?? 'Belum ada data' }}</p>
        </div>

        {{-- Penghargaan & Kompetisi --}}
        @php
            $hasPenghargaan = isset($cv->penghargaan) && is_array($cv->penghargaan) && count($cv->penghargaan) > 0;
        @endphp
        <div class="cv-section @if(!$hasPenghargaan) empty-section @endif">
            <h4>Penghargaan dan Kompetisi</h4>
            <ul>
                @if($hasPenghargaan)
                    @foreach($cv->penghargaan as $award)
                        <li class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>{{ $award['judul'] ?? '-' }}</strong><br>
                                {{ $award['penyelenggara'] ?? '-' }}
                            </div>
                            <div class="cv-entry-right text-end">
                                <div><strong>{{ $award['lokasi'] ?? '-' }}</strong></div>
                                <div><strong>{{ $award['tahun'] ?? '-' }}</strong></div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="no-print">Belum ada data</p>
                @endif
            </ul>
        </div>

        {{-- Tombol --}}
        <div class="text-end mt-4 no-print">
            @if ($cv)
                <a href="{{ route('alumni.cv.create') }}" class="btn btn-warning">Edit CV</a>
            @else
                @if(isset($isProfileComplete) && $isProfileComplete)
                    <a href="{{ route('alumni.cv.create') }}" class="btn btn-primary">Buat CV</a>
                @else
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileIncompleteModal">
                        Buat CV
                    </button>
                @endif
            @endif
        </div>

        {{-- Watermark Footer yang akan terlihat saat dicetak --}}
        <div class="watermark-footer">
            Career Development Center Telkom University Surabaya
        </div>
    </div>
</div>

<!-- Modal untuk profil belum lengkap -->
@if(isset($isProfileComplete) && !$isProfileComplete)
<div class="modal fade" id="profileIncompleteModal" tabindex="-1" aria-labelledby="profileIncompleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileIncompleteModalLabel">Lengkapi Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Anda harus melengkapi profil terlebih dahulu sebelum membuat CV.
                </div>
                <p>Beberapa informasi penting yang perlu dilengkapi di profil Anda:</p>
                <ul>
                    @if(empty($alumni->telepon))
                        <li>Nomor Telepon</li>
                    @endif
                    @if(empty($alumni->linkedin))
                        <li>LinkedIn</li>
                    @endif
                    @if(empty($alumni->kota))
                        <li>Kota</li>
                    @endif
                    @if(empty($alumni->provinsi))
                        <li>Provinsi</li>
                    @endif
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('alumni.profil') }}" class="btn btn-primary">Lengkapi Profil</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection


@push('scripts')
<script>
    function printCV() {
        window.print();
    }

    // Otomatis buka modal jika profil belum lengkap dan ada parameter showModal
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($isProfileComplete) && !$isProfileComplete && request()->has('showModal'))
            var myModal = new bootstrap.Modal(document.getElementById('profileIncompleteModal'));
            myModal.show();
        @endif

        // Kode JavaScript untuk watermark (opsional jika ingin dinamis)
        var watermark = document.querySelector('.watermark-footer');
        if (!watermark) {
            watermark = document.createElement('div');
            watermark.className = 'watermark-footer';
            watermark.textContent = 'Career Development Center Telkom University Surabaya';

            var cvCard = document.querySelector('.cv-card');
            if (cvCard) {
                cvCard.appendChild(watermark);
            }
        }
    });
</script>
@endpush
