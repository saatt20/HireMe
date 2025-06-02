@extends('layouts.navbarmitra')

@push('styles')
<link href="{{ asset('css/mitra-profil.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@section('title', 'Profil')
@section('content')
<div class="container mt-4">
    <!-- Judul -->
   <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Profil Mitra</h4>
    </div>

    <!-- Card Profil -->
    <div class="card bg-white rounded-4 shadow-sm p-4 mb-4">
        <!-- Foto dan Nama -->
        <div class="d-flex align-items-center mb-3">
            <div class="position-relative" style="width: 100px; height: 100px;">
                <img id="previewLogo"
                     src="{{ $mitra->logo ? asset('storage/' . $mitra->logo) : asset('images/pict-profil.png') }}"
                     alt="Logo Mitra"
                     class="rounded-circle img-thumbnail"
                     style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="ms-3 w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $user->name }}</h4>
                        <h5 class="mb-1">{{ $mitra->kota }}, {{ $mitra->provinsi }}</h5>
                    </div>
                    <button id="editBtn" class="btn btn-link text-danger p-0">Edit</button>
                </div>
            </div>
        </div>

        <hr>

        <!-- Tampilan Data -->
        <div id="profileView">
            <div class="row mb-2">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Telepon</label>
                    <p>{{ $mitra->telepon ?? '-' }}</p>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <p>{{ $mitra->deskripsi ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <form id="profileEditForm" action="{{ route('mitra.profil.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Telepon</label>
                    <input type="text" class="form-control" name="telepon" value="{{ old('telepon', $mitra->telepon) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Logo</label>
                    <input type="file" class="form-control" name="logo" id="logoInput" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kota</label>
                    <input type="text" class="form-control" name="kota" value="{{ old('kota', $mitra->kota) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Provinsi</label>
                    <input type="text" class="form-control" name="provinsi" value="{{ old('provinsi', $mitra->provinsi) }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $mitra->deskripsi) }}</textarea>
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
    const editBtn = document.getElementById('editBtn');
    const profileView = document.getElementById('profileView');
    const profileEditForm = document.getElementById('profileEditForm');

    editBtn.addEventListener('click', function () {
        profileView.style.display = 'none';
        profileEditForm.style.display = 'block';
    });

    // Preview logo saat file dipilih
    const logoInput = document.getElementById('logoInput');
    const previewLogo = document.getElementById('previewLogo');

    logoInput?.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewLogo.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush
