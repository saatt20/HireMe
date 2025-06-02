@extends('layouts.navbarmitra')

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

@section('title', 'Edit Lowongan')
@section('content')
<div class="container">
    <!-- Card Kelola Lowongan -->
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Edit Lowongan</h4>
    </div>

    <form action="{{ route('mitra.lowongan.update', $lowongan->id) }}" method="POST">
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

        <!-- Card for Kota and Provinsi -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Lokasi</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-control" value="{{ old('kota', $lowongan->kota) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $lowongan->provinsi) }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Card for Status Lowongan -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Status</h5>
                    </div>
                    <div class="card-body">
                        <label for="status" class="form-label">Status Lowongan</label>
                        <select name="status" class="form-control" required>
                            <option value="Full-Time" {{ $lowongan->status == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="Part-Time" {{ $lowongan->status == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="Internship" {{ $lowongan->status == 'Internship' ? 'selected' : '' }}>Internship</option>
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
                        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $lowongan->deadline) }}" required>
                    </div>
                </div>
            </div>

            <!-- Card for Gaji -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Gaji</h5>
                    </div>
                    <div class="card-body">
                        <label for="gaji_min" class="form-label">Gaji Minimal (Juta)</label>
                        <input type="text" name="gaji_min" class="form-control" min="0" required placeholder="Contoh: 2,5 Juta" value="{{ old('gaji_min', $lowongan->gaji_min) }}">

                        <label for="gaji_max" class="form-label mt-3">Gaji Maksimal (Juta)</label>
                        <input type="text" name="gaji_max" class="form-control" min="0" required placeholder="Contoh: 4,5 Juta" value="{{ old('gaji_max', $lowongan->gaji_max) }}">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn" style="background-color: #C71527; border-color: #C71527; color: white;">Update Lowongan</button>
        <a href="{{ route('mitra.lowongan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
