@extends('layouts.navbar')

@push('styles')
<link href="{{ asset('css/alumni-profil.css') }}" rel="stylesheet">
@endpush

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

@section('title', 'Profil')
@section('content')
<div class="container mt-4">

    <!-- Card: Judul Profil -->
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Profil Saya</h4>
    </div>

    <!-- Card Gabungan -->
    <div class="card bg-white rounded-4 shadow-sm p-4 mb-4">

        <!-- Bagian Foto dan Nama -->
        <div class="d-flex align-items-center mb-3">
    <div class="position-relative" style="width: 100px; height: 100px;">
        <img id="previewFoto"
            src="{{ $alumni && $alumni->foto ? asset('storage/' . $alumni->foto) : asset('images/pict-profil.png') }}"
            alt="Foto Profil"
            class="rounded-circle img-thumbnail"
            style="width: 100px; height: 100px; object-fit: cover;">
    </div>
    <div class="ms-3 w-100">
        <!-- Nama dan institusi -->
        <h4 class="mb-0">{{ $user->name }}</h4>
        <h5 class="mb-1">Telkom University Surabaya</h5>

        <!-- Status kerja di bawah institusi -->
        <div class="d-flex justify-content-between align-items-center mt-2">
            <span id="statusLabelText" class="text-danger fw-bold">
                {{ $alumni->status_kerja == 'Mencari Kerja' ? 'Mencari Kerja' : 'Sudah Bekerja' }}
            </span>
            <div>
                <label class="switch">
                    <input type="checkbox"
                           id="statusKerjaSwitch"
                           {{ $alumni->status_kerja == 'Mencari Kerja' ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                <input type="hidden" name="status_kerja" id="statusKerjaInput" value="{{ $alumni->status_kerja }}" form="statusKerjaForm">
            </div>
        </div>
    </div>
</div>

        <!-- Form khusus untuk status kerja -->
        <form id="statusKerjaForm" action="{{ route('alumni.status-kerja.update') }}" method="POST">
            @csrf
            @method('PUT')
        </form>

        <!-- Garis Pemisah -->
        <hr>

        <!-- Bagian Informasi Pribadi -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Informasi Pribadi</h5>
            <button id="editBtn" class="btn btn-link text-danger p-0">Edit</button>
        </div>

        <!-- Tampilan Data -->
        <div id="profileView">
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nomor Telepon</label>
                    <p>{{ $alumni->telepon ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">LinkedIn (Link)</label>
                    <p>{{ $alumni->linkedin ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Program Studi</label>
                    <p>{{ $alumni->program_studi ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Angkatan</label>
                    <p>{{ $alumni->angkatan ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tempat Tinggal</label>
                    <p>{{ $alumni->kota ?? '-' }}, {{ $alumni->provinsi ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jenis Kelamin</label>
                    <p>{{ $alumni->jenis_kelamin ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <form id="profileEditForm" action="{{ route('alumni.profil.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nomor Telepon</label>
                    <input type="text" class="form-control" name="telepon" value="{{ old('telepon', $alumni->telepon) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">LinkedIn</label>
                    <input type="url" class="form-control" name="linkedin" value="{{ old('linkedin', $alumni->linkedin) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Program Studi</label>
                    <select name="program_studi" class="form-select">
                        <option value="">Pilih</option>
                        <option value="Teknik Elektro" {{ old('program_studi', $alumni->program_studi) == 'Teknik Elektro' ? 'selected' : '' }}>Teknik Elektro</option>
                        <option value="Teknik Telekomunikasi" {{ old('program_studi', $alumni->program_studi) == 'Teknik Telekomunikasi' ? 'selected' : '' }}>Teknik Telekomunikasi</option>
                        <option value="Teknik Komputer" {{ old('program_studi', $alumni->program_studi) == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                        <option value="Teknik Industri" {{ old('program_studi', $alumni->program_studi) == 'Teknik Industri' ? 'selected' : '' }}>Teknik Industri</option>
                        <option value="Teknik Logistik" {{ old('program_studi', $alumni->program_studi) == 'Teknik Logistik' ? 'selected' : '' }}>Teknik Logistik</option>
                        <option value="Informatika" {{ old('program_studi', $alumni->program_studi) == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                        <option value="Rekayasa Perangkat Lunak" {{ old('program_studi', $alumni->program_studi) == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                        <option value="Teknologi Informasi" {{ old('program_studi', $alumni->program_studi) == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Sains Data" {{ old('program_studi', $alumni->program_studi) == 'Sains Data' ? 'selected' : '' }}>Sains Data</option>
                        <option value="Bisnis Digital" {{ old('program_studi', $alumni->program_studi) == 'Bisnis Digital' ? 'selected' : '' }}>Bisnis Digital</option>
                        <option value="Sistem Informasi" {{ old('program_studi', $alumni->program_studi) == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                    </select>
                    {{-- <input type="text" class="form-control" name="program_studi" value="{{ old('program_studi', $alumni->program_studi) }}"> --}}
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Angkatan</label>
                    <input type="text" class="form-control" name="angkatan" value="{{ old('angkatan', $alumni->angkatan) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kota</label>
                    <input type="text" class="form-control" name="kota" value="{{ old('kota', $alumni->kota) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Provinsi</label>
                    <input type="text" class="form-control" name="provinsi" value="{{ old('provinsi', $alumni->provinsi) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Foto Profil</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi untuk mengubah tampilan antara form dan tampilan profil
    const editBtn = document.getElementById('editBtn');
    const profileView = document.getElementById('profileView');
    const profileEditForm = document.getElementById('profileEditForm');

    editBtn.addEventListener('click', function () {
        profileView.style.display = 'none';
        profileEditForm.style.display = 'block';
    });

    // Fungsi untuk menghandle toggle status kerja
    const statusKerjaSwitch = document.getElementById('statusKerjaSwitch');
    const statusLabelText = document.getElementById('statusLabelText');
    const statusKerjaInput = document.getElementById('statusKerjaInput');
    const statusKerjaForm = document.getElementById('statusKerjaForm');

    statusKerjaSwitch.addEventListener('change', function() {
    let statusValue;

    if (this.checked) {
        statusValue = 'Mencari Kerja';
        statusLabelText.textContent = 'Mencari Kerja';
        statusLabelText.classList.add('text-danger');
        statusLabelText.classList.remove('text-secondary');
    } else {
        statusValue = 'Sudah Bekerja';
        statusLabelText.textContent = 'Sudah Bekerja';
        statusLabelText.classList.remove('text-danger');
        statusLabelText.classList.add('text-secondary');
    }

    // Update nilai input hidden
    statusKerjaInput.value = statusValue;

    // Submit form untuk menyimpan ke database secara otomatis
    statusKerjaForm.submit();
});

    // Preview gambar saat memilih file
    const fotoInput = document.getElementById('fotoInput');
    const previewFoto = document.getElementById('previewFoto');

    fotoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewFoto.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush
