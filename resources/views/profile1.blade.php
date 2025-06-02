@extends('layouts.navbar')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<style>
    .switch { position: relative; display: inline-block; width: 48px; height: 24px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: 0.4s; border-radius: 34px; }
    .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: 0.4s; border-radius: 50%; }
    input:checked + .slider { background-color: #6f0a12; }
    input:checked + .slider:before { transform: translateX(24px); }
    .card { border-radius: 1rem !important; }
</style>

<div class="container py-3">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card text-center mb-3">
                <div class="card-body">
                    <img src="{{ $profile->photo ? asset('storage/' . $profile->photo) : asset('images/pict-profil.png') }}" class="rounded-circle mb-2 border border-3 border-danger" alt="Foto Profil">
                    <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                    <small class="text-muted">Telkom University Surabaya</small><br>
                    <span id="job-status-sidebar" class="text-danger d-block">Sedang Mencari Kerja</span>
                </div>
            </div>
            <div class="card text-white bg-danger text-center">
                <div class="card-body">
                    <p class="mb-2">Unggah CV dan Biarkan Mitra Menemukanmu</p>
                    <a href="#" class="btn btn-light btn-sm">Pooling CV</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-0 fw-bold">Profil Saya</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Foto Profil -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3 position-relative">
                            <img src="{{ $profile->photo ? asset('storage/' . $profile->photo) : asset('images/pict-profil.png') }}" class="rounded-circle mb-2 border border-3 border-danger" alt="Foto Profil">
                            <button class="btn btn-sm btn-light rounded-circle position-absolute bottom-0 end-0 border" title="Edit Foto" data-bs-toggle="modal" data-bs-target="#uploadFotoModal">
                                <span class="fw-bold text-danger">+</span>
                            </button>
                        </div>
                        <div class="w-100">
                            <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                            <small class="text-muted">Telkom University Surabaya</small><br>
                            <div class="d-flex justify-content-between align-items-center">
                                <small id="job-status-text" class="text-danger">Saya Terbuka Untuk Lowongan Kerja</small>
                                <div class="ms-3">
                                    <label class="switch">
                                        <input type="checkbox" id="job-toggle" onchange="toggleJobStatus()" {{ $profile->job_status ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Informasi Pribadi</h5>
                        <a href="javascript:void(0)" class="text-danger" onclick="toggleEdit()">Edit</a>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <div class="view-field">
                                    <label>Email</label>
                                    <p class="mb-0">{{ $profile->email }}</p>
                                </div>
                                <div class="edit-field d-none">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $profile->email }}" class="form-control" required>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <div class="view-field">
                                    <label>Jenis Kelamin</label>
                                    <p class="mb-0">{{ $profile->gender }}</p>
                                </div>
                                <div class="edit-field d-none">
                                    <label>Jenis Kelamin</label>
                                    <select name="gender" class="form-select" required>
                                        <option value="L" {{ $profile->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ $profile->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 mb-3">
                                <div class="view-field">
                                    <label>No. Telepon</label>
                                    <p class="mb-0">{{ $profile->phone_number }}</p>
                                </div>
                                <div class="edit-field d-none">
                                    <label>No. Telepon</label>
                                    <input type="text" name="phone_number" value="{{ $profile->phone_number }}" class="form-control" required>
                                </div>
                            </div>

                            <!-- LinkedIn -->
                            <div class="col-md-6 mb-3">
                                <div class="view-field">
                                    <label>LinkedIn</label>
                                    <p class="mb-0">{{ $profile->linkedin }}</p>
                                </div>
                                <div class="edit-field d-none">
                                    <label>LinkedIn</label>
                                    <input type="text" name="linkedin" value="{{ $profile->linkedin }}" class="form-control">
                                </div>
                            </div>

                            <!-- Provinsi -->
                            <div class="col-md-6 mb-3">
                                <div class="view-field">
                                    <label>Provinsi</label>
                                    <p class="mb-0">{{ $profile->provinsi }}</p>
                                </div>
                                <div class="edit-field d-none">
                                    <label>Provinsi</label>
                                    <select id="provinsi" name="provinsi" class="form-select" required></select>
                                </div>
                            </div>

                            <!-- Kota -->
                            <div class="col-md-6 mb-3">
                                <div class="view-field">
                                    <label>Kota</label>
                                    <p class="mb-0">{{ $profile->kota }}</p>
                                </div>
                                <div class="edit-field d-none">
                                    <label>Kota</label>
                                    <select id="kota" name="kota" class="form-select" required>
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="edit-field d-none text-end">
                            <button type="submit" class="btn btn-danger mt-3">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Foto -->
<div class="modal fade" id="uploadFotoModal" tabindex="-1" aria-labelledby="uploadFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFotoModalLabel">Upload Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Pilih Foto</label>
                        <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
    function toggleJobStatus() {
        const text = document.getElementById('job-status-text');
        const toggle = document.getElementById('job-toggle');
        const sidebarStatus = document.getElementById('job-status-sidebar');

        if (toggle.checked) {
            text.classList.remove('text-secondary');
            text.classList.add('text-danger');
            sidebarStatus.style.visibility = 'visible';
        } else {
            text.classList.remove('text-danger');
            text.classList.add('text-secondary');
            sidebarStatus.style.visibility = 'hidden';
        }
    }

    function toggleEdit() {
        const viewFields = document.querySelectorAll('.view-field');
        const editFields = document.querySelectorAll('.edit-field');
        const isHidden = editFields[0].classList.contains('d-none');

        viewFields.forEach(el => el.classList.toggle('d-none', isHidden));
        editFields.forEach(el => el.classList.toggle('d-none', !isHidden));
    }

    document.addEventListener('DOMContentLoaded', function () {
        const provinsiSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');
        const selectedProvinsi = "{{ $profile->provinsi ?? '' }}";
        const selectedKota = "{{ $profile->kota ?? '' }}";

        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                provinces.forEach(prov => {
                    const option = document.createElement('option');
                    option.value = prov.name;
                    option.textContent = prov.name;
                    if (prov.name === selectedProvinsi) {
                        option.selected = true;
                        loadCities(prov.id); // Load cities for selected province
                    }
                    provinsiSelect.appendChild(option);
                });
            });

        provinsiSelect.addEventListener('change', function () {
            const selectedId = this.options[this.selectedIndex].getAttribute('data-id');
            loadCities(selectedId);
        });

        function loadCities(provinceId) {
            kotaSelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                .then(response => response.json())
                .then(cities => {
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        if (city.name === selectedKota) {
                            option.selected = true;
                        }
                        kotaSelect.appendChild(option);
                    });
                });
        }
    });
</script>
