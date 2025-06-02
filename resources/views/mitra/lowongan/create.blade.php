@extends('layouts.navbarmitra')

@section('title', 'Buat Lowongan')

@section('content')
<link rel="stylesheet" href="{{ asset('css/buat-lowongan.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<div class="buat-lowongan-wrapper container">
    <!-- Judul -->
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Buat Lowongan</h4>
    </div>

    <!-- Layout 2 Kolom -->
    <div class="form-card">
        <a href="{{ route('mitra.lowongan.index') }}" class="back-icon">
            <i class="fas fa-arrow-left"></i>
        </a>
        <br><br>
        <form action="{{ route('mitra.lowongan.store') }}" method="POST">
            @csrf
            <div class="form-columns">
                <!-- KIRI -->
                <div class="left-column">
                    <!-- Card Posisi -->
                    <div class="card-sub">
                        <h5 class="section-title">Posisi</h5>
                        <label for="judul">Nama Posisi:</label>
                        <input type="text" name="judul" id="judul" required>

                        <label for="deskripsi">Deskripsi Posisi:</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" required></textarea>
                    </div>

                    <!-- Card Persyaratan -->
                    <div class="card-sub">
                        <h5 class="section-title">Persyaratan</h5>
                        <label for="kualifikasi">Kualifikasi:</label>
                        <textarea name="kualifikasi" id="kualifikasi" rows="4" required></textarea>

                        <label for="skills">Skills:</label>
                        <input type="text" name="skills" id="skills" required>
                    </div>
                </div>

                <!-- KANAN -->
                <div class="right-column">
                    <!-- Card Status -->
                    <div class="card-sub">
                        <h5 class="section-title">Status</h5>
                        <label for="status">Status Lowongan:</label>
                        <select name="status" id="status" required>
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>

                    <!-- Card Lokasi -->
                    <div class="card-sub">
                        <h5 class="section-title">Lokasi</h5>
                        <label for="kota">Kota:</label>
                        <input type="text" name="kota" id="kota" required>

                        <label for="provinsi">Provinsi:</label>
                        <input type="text" name="provinsi" id="provinsi" required>
                    </div>

                   <!-- Card Gaji -->
                    <!-- Card Gaji -->
                    <div class="card-sub">
                        <h5 class="section-title">Gaji THP</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="gaji_min">Gaji Minimum (Juta):</label>
                                <div class="input-group">
                                    <input type="text" name="gaji_min" id="gaji_min" required placeholder="Contoh: 5 " class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="gaji_max">Gaji Maksimum (Juta):</label>
                                <div class="input-group">
                                    <input type="text" name="gaji_max" id="gaji_max" required placeholder="Contoh: 8" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Waktu -->
                    <div class="card-sub">
                        <h5 class="section-title">Waktu</h5>
                        <label for="deadline">Deadline:</label>
                        <input type="date" name="deadline" id="deadline" required>
                    </div>

                    <!-- Tombol -->
                    <div class="btn-wrapper">
                        <button type="submit" class="btn-submit" >Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
