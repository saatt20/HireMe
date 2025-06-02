@extends('layouts.navbaradmin') {{-- Ubah sesuai layout yang kamu gunakan --}}

@section('title', 'Edit Lowongan')

<style>
.bg-red-custom {
background-color: #C71527; /* Sesuaikan warna merah sesuai desain kamu */
}

.relative-container {
    position: relative;
    overflow: hidden;

}

.absolute-image {
    position: absolute;
    top: 20;
    left: 100px;
    width: 100px;
    height: 100%;
}
</style>
@section('content')
<div class="container mt-4">
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Edit Lowongan</h4>
    </div>

    <form action="{{ route('admin.lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Card for Judul Posisi and Deskripsi -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Posisi</h5>
            </div>
            <div class="card-body">
                <label for="judul" class="form-label">Nama Posisi</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $lowongan->judul) }}" required>

                <label for="deskripsi" class="form-label mt-3">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
            </div>
        </div>

        <!-- Card for Kualifikasi and Skills -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Persyaratan</h5>
            </div>
            <div class="card-body">
                <label for="kualifikasi" class="form-label">Kualifikasi</label>
                <textarea name="kualifikasi" class="form-control" rows="4" required>{{ old('kualifikasi', $lowongan->kualifikasi) }}</textarea>

                <label for="skills" class="form-label mt-3">Skills</label>
                <input type="text" name="skills" class="form-control" value="{{ old('skills', $lowongan->skills) }}" required>
            </div>
        </div>

        <div class="row">
            <!-- Card for Lokasi -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Lokasi</h5>
                    </div>
                    <div class="card-body">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-control" value="{{ old('kota', $lowongan->kota) }}" required>

                        <label for="provinsi" class="form-label mt-3">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $lowongan->provinsi) }}" required>
                    </div>
                </div>
            </div>

            <!-- Card for Status Lowongan -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Status</h5>
                    </div>
                    <div class="card-body">
                        <label for="status" class="form-label">Status Lowongan</label>
                        <select name="status" class="form-control" required>
                            <option value="Full-Time" {{ $lowongan->status === 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="Part-Time" {{ $lowongan->status === 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="Internship" {{ $lowongan->status === 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Card for Deadline -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Waktu</h5>
                    </div>
                    <div class="card-body">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $lowongan->deadline ? \Carbon\Carbon::parse($lowongan->deadline)->format('Y-m-d') : '') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card for Informasi Mitra -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Informasi Mitra</h5>
            </div>
            <div class="card-body">
                <label for="mitra_nama" class="form-label">Nama Mitra</label>
                <input type="text" name="mitra_nama" class="form-control" value="{{ old('mitra_nama', $lowongan->mitra_nama) }}" required>

                <label for="mitra_deskripsi" class="form-label mt-3">Deskripsi Mitra</label>
                <textarea name="mitra_deskripsi" class="form-control" rows="3">{{ old('mitra_deskripsi', $lowongan->mitra_deskripsi) }}</textarea>

                <label for="mitra_logo" class="form-label mt-3">Logo Mitra</label><br>
                @if ($lowongan->mitra_logo)
                    <img src="{{ asset('storage/' . $lowongan->mitra_logo) }}" alt="Logo" width="100" class="mb-2"><br>
                @endif
                <input type="file" name="mitra_logo" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah logo</small>
            </div>
        </div>

        <!-- Card for Link Pendaftaran -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Pendaftaran</h5>
            </div>
            <div class="card-body">
                <label for="link_pendaftaran" class="form-label">Link Pendaftaran</label>
                <input type="url" name="link_pendaftaran" class="form-control" value="{{ old('link_pendaftaran', $lowongan->link_pendaftaran) }}" required>
            </div>
        </div>

        <button type="submit" class="btn" style="background-color: #C71527; border-color: #C71527; color: white;">Simpan Perubahan</button>
        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
