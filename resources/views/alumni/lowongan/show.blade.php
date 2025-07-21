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
                        <button type="button" class="btn text-white" style="background-color: #C71527;" data-bs-toggle="modal" data-bs-target="#lamaranModal">
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

<!-- Multi-Step Modal Lamaran -->
@if(isset($hasCV) && $hasCV && !($isCreatedByAdmin && $lowongan->link_pendaftaran) && !$sudahMelamar)
<div class="modal fade" id="lamaranModal" tabindex="-1" aria-labelledby="lamaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="lamaranModalLabel">
                    <span id="step1-title">Preview CV</span>
                    <span id="step2-title" style="display: none;">Upload Portofolio</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Step Progress -->
                <div class="progress mb-4" style="height: 8px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                         role="progressbar"
                         style="width: 50%; background-color: #C71527;"
                         id="progressBar">
                    </div>
                </div>

                <!-- Step 1: CV Preview -->
                <div id="step1-content">
                    <div class="text-center">
                        <div class="cv-paper mx-auto cv-paper-smaller">
                            @include('alumni.cv.partials.cv-preview')
                        </div>
                    </div>
                </div>

                <!-- Step 2: Upload Portofolio -->
                <div id="step2-content" style="display: none;">
                    <div class="text-center mb-4">
                        <h6>Upload Portofolio (Opsional)</h6>
                        <p class="text-muted">Anda dapat mengupload file portofolio untuk melengkapi lamaran Anda</p>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form id="lamaranForm" action="{{ route('lamaran.kirim', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="portofolio" class="form-label">
                                        <i class="bi bi-file-earmark-arrow-up"></i> File Portofolio
                                    </label>
                                    <input type="file"
                                           class="form-control"
                                           id="portofolio"
                                           name="portofolio"
                                           accept=".pdf" required>
                                    <div class="form-text">
                                        Upload File Berupa PDF (Maksimal 10MB)
                                    </div>
                                </div>

                                <div id="file-info" class="alert alert-info" style="display: none;">
                                    <i class="bi bi-info-circle"></i>
                                    <span id="file-name"></span>
                                    <button type="button" class="btn-close float-end" id="remove-file" aria-label="Remove file"></button>
                                </div>

                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    <strong>Perhatian:</strong> Setelah mengirim lamaran, Anda tidak dapat mengubah atau mengirim ulang lamaran untuk lowongan ini.
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <div id="step1-buttons">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn text-white" style="background-color: #C71527;" id="nextStep">
                        <i class="bi bi-arrow-right"></i> Selanjutnya
                    </button>
                </div>

                <div id="step2-buttons" style="display: none;">
                    <button type="button" class="btn btn-secondary" id="prevStep">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="skipPortofolio">
                        Lewati & Kirim
                    </button>
                    <button type="submit" form="lamaranForm" class="btn text-white" style="background-color: #C71527;">
                        <i class="bi bi-send"></i> Kirim Lamaran
                    </button>
                </div>
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
    padding: 0.5cm 0.5cm;
    transform: scale(0.9);
    margin: -20px auto;
}

/* CV Preview Styles */
.modal .cv-preview {
    padding: 0.8rem !important;
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

.modal .cv-section > ul {
    padding-left: 0 !important;
    list-style-type: none !important;
    margin-left: 0 !important;
}

.modal .cv-entry {
    padding-left: 0 !important;
    margin-left: 0 !important;
}

.modal .cv-description-list {
    padding-left: 20px !important;
    margin-left: 10px !important;
}

/* File Upload Styles */
.form-control:focus {
    border-color: #C71527;
    box-shadow: 0 0 0 0.2rem rgba(199, 21, 39, 0.25);
}

#file-info {
    border-left: 4px solid #C71527;
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

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Inisialisasi tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Multi-step modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, initializing modal functionality...');

        const nextStepBtn = document.getElementById('nextStep');
        const prevStepBtn = document.getElementById('prevStep');
        const skipPortofolioBtn = document.getElementById('skipPortofolio');
        const fileInput = document.getElementById('portofolio');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const removeFileBtn = document.getElementById('remove-file');
        const progressBar = document.getElementById('progressBar');
        const lamaranForm = document.getElementById('lamaranForm');

        // Debug: Check if elements exist
        console.log('Elements check:', {
            nextStepBtn: !!nextStepBtn,
            prevStepBtn: !!prevStepBtn,
            skipPortofolioBtn: !!skipPortofolioBtn,
            fileInput: !!fileInput,
            progressBar: !!progressBar,
            lamaranForm: !!lamaranForm
        });

        // Step navigation
        if (nextStepBtn) {
            nextStepBtn.addEventListener('click', function(e) {
                console.log('Next step clicked');
                e.preventDefault();
                showStep(2);
            });
        }

        if (prevStepBtn) {
            prevStepBtn.addEventListener('click', function(e) {
                console.log('Previous step clicked');
                e.preventDefault();
                showStep(1);
            });
        }

        // Skip portofolio and submit
        if (skipPortofolioBtn) {
            skipPortofolioBtn.addEventListener('click', function(e) {
                console.log('Skip portofolio clicked');
                e.preventDefault();
                if (fileInput) fileInput.value = '';
                if (lamaranForm) lamaranForm.submit();
            });
        }

        // File upload handling
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    if (fileName) {
                        fileName.textContent = file.name + ' (' + formatFileSize(file.size) + ')';
                    }
                    if (fileInfo) {
                        fileInfo.style.display = 'block';
                    }
                } else {
                    if (fileInfo) {
                        fileInfo.style.display = 'none';
                    }
                }
            });
        }

        // Remove file
        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (fileInput) fileInput.value = '';
                if (fileInfo) fileInfo.style.display = 'none';
            });
        }

        // Reset modal when closed
        const lamaranModal = document.getElementById('lamaranModal');
        if (lamaranModal) {
            lamaranModal.addEventListener('hidden.bs.modal', function() {
                console.log('Modal closed, resetting to step 1');
                showStep(1);
                if (fileInput) fileInput.value = '';
                if (fileInfo) fileInfo.style.display = 'none';
            });
        }

        function showStep(step) {
            console.log('Showing step:', step);

            const step1Content = document.getElementById('step1-content');
            const step2Content = document.getElementById('step2-content');
            const step1Title = document.getElementById('step1-title');
            const step2Title = document.getElementById('step2-title');
            const step1Buttons = document.getElementById('step1-buttons');
            const step2Buttons = document.getElementById('step2-buttons');

            if (step === 1) {
                // Show step 1
                if (step1Content) step1Content.style.display = 'block';
                if (step2Content) step2Content.style.display = 'none';
                if (step1Title) step1Title.style.display = 'inline';
                if (step2Title) step2Title.style.display = 'none';
                if (step1Buttons) step1Buttons.style.display = 'block';
                if (step2Buttons) step2Buttons.style.display = 'none';
                if (progressBar) progressBar.style.width = '50%';
                console.log('Step 1 activated');
            } else if (step === 2) {
                // Show step 2
                if (step1Content) step1Content.style.display = 'none';
                if (step2Content) step2Content.style.display = 'block';
                if (step1Title) step1Title.style.display = 'none';
                if (step2Title) step2Title.style.display = 'inline';
                if (step1Buttons) step1Buttons.style.display = 'none';
                if (step2Buttons) step2Buttons.style.display = 'block';
                if (progressBar) progressBar.style.width = '100%';
                console.log('Step 2 activated');
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Initialize step 1 on page load
        showStep(1);
    });
</script>
@endsection
