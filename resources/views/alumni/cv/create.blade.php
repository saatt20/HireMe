@extends('layouts.navbar')

<link href="{{ asset('css/cv-alumni.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@section('title', 'Buat CV')
@section('content')
<div class="cv-container">
    {{-- Card 1 - Header --}}
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h2>{{ $cv ? 'Edit CV' : 'Buat CV' }}</h2>
        <!-- CV Example Button -->
        <button type="button" class="btn-example"  data-bs-toggle="modal" data-bs-target="#cvExampleModal">
            <i class="fas fa-file-alt"></i> Lihat Contoh CV
        </button>
    </div>

    {{-- Card 2 - Form --}}
    <div class="cv-form-card">
        <a href="{{ route('alumni.cv.index') }}" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <form action="{{ route('alumni.cv.store') }}" method="POST">
            @csrf

            {{-- Identitas pengguna --}}
            <div class="cv-identity mt-4">
                <h3 class="nama-user">{{ $user->name }}</h3>
                <p class="kontak-user">
                    {{ $alumni->telepon ?? '-' }} |
                    {{ $user->email }} |
                    {{ $alumni->linkedin ?? '-' }}
                </p>
                <p class="lokasi-user">
                    {{ $alumni->kota ?? '-' }}, {{ $alumni->provinsi ?? '-' }}
                </p>
            </div>

            {{-- Tentang Saya --}}
            <div class="cv-section">
                <h4>Tentang Saya</h4>
                <p class="section-desc">Deskripsikan tentang dirimu secara singkat</p>
                <textarea name="tentang_saya" class="form-control" rows="4" required>{{ $cv->tentang_saya ?? '' }}</textarea>
            </div>

            {{-- Riwayat Pendidikan (Array Dinamis) --}}
            <div class="cv-section">
                <h4>Riwayat Pendidikan</h4>
                <p class="section-desc">Tambah lebih dari satu riwayat pendidikan jika perlu</p>

                <div id="pendidikan-wrapper">
                    @php
                        $riwayat_pendidikan = $cv && $cv->riwayat_pendidikan ? $cv->riwayat_pendidikan : [[]];
                    @endphp

                    @foreach($riwayat_pendidikan as $i => $riwayat_pendidikan)
                    <div class="pendidikan-item mb-3 border rounded p-3">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <select name="riwayat_pendidikan[{{ $i }}][tingkat]" class="form-control" required>
                                    <option value="" disabled {{ empty($riwayat_pendidikan['tingkat']) ? 'selected' : '' }}>Pilih Tingkat Pendidikan</option>
                                    <option value="SMA" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'SMA') ? 'selected' : '' }}>SMA</option>
                                    <option value="SMK" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'SMK') ? 'selected' : '' }}>SMK</option>
                                    <option value="Diploma (D1)" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'Diploma (D1)') ? 'selected' : '' }}>Diploma (D1)</option>
                                    <option value="Diploma (D2)" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'Diploma (D2)') ? 'selected' : '' }}>Diploma (D2)</option>
                                    <option value="Diploma (D3)" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'Diploma (D3)') ? 'selected' : '' }}>Diploma (D3)</option>
                                    <option value="Sarjana (S1)" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'Sarjana (S1)') ? 'selected' : '' }}>Sarjana (S1)</option>
                                    <option value="Magister (S2)" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'Magister (S2)') ? 'selected' : '' }}>Magister (S2)</option>
                                    <option value="Doktor (S3)" {{ (isset($riwayat_pendidikan['tingkat']) && $riwayat_pendidikan['tingkat'] == 'Doktor (S3)') ? 'selected' : '' }}>Doktor (S3)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="riwayat_pendidikan[{{ $i }}][jurusan]" class="form-control" placeholder="Jurusan/Program Studi" value="{{ $riwayat_pendidikan['jurusan'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="riwayat_pendidikan[{{ $i }}][nama_sekolah]" class="form-control" placeholder="Nama Sekolah/PT" value="{{ $riwayat_pendidikan['nama_sekolah'] ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <input type="text" name="riwayat_pendidikan[{{ $i }}][tahun_mulai]" class="form-control" placeholder="Tahun Mulai" value="{{ $riwayat_pendidikan['tahun_mulai'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="riwayat_pendidikan[{{ $i }}][tahun_lulus]" class="form-control" placeholder="Tahun Lulus" value="{{ $riwayat_pendidikan['tahun_lulus'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="riwayat_pendidikan[{{ $i }}][lokasi]" class="form-control" placeholder="Lokasi (Kota)" value="{{ $riwayat_pendidikan['lokasi'] ?? '' }}">
                            </div>
                        </div>
                        <textarea name="riwayat_pendidikan[{{ $i }}][info_tambahan]" class="form-control" rows="2" placeholder="* Contoh: Mendapat Beasiswa Prestasi Awardee dengan minimum IPK 3,75">{{ $riwayat_pendidikan['info_tambahan'] ?? '' }}</textarea>

                       <button type="button" class="btn btn-danger btn-remove-kerja mt-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="btn-add-pendidikan" class="btn btn-outline-danger mt-2">
                    Tambah Pendidikan
                </button>
            </div>

            {{-- Pengalaman Kerja (Array Dinamis) --}}
            <div class="cv-section">
                <h4>Pengalaman Kerja</h4>
                <div id="kerja-wrapper">
                    @php
                        $pengalaman_kerja = $cv && $cv->pengalaman_kerja ? $cv->pengalaman_kerja : [[]];
                    @endphp

                    @foreach($pengalaman_kerja as $i => $pengalaman_kerja)
                    <div class="kerja-item mb-3 border rounded p-3">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="pengalaman_kerja[{{ $i }}][nama_perusahaan]" class="form-control" placeholder="Nama Perusahaan" value="{{ $pengalaman_kerja['nama_perusahaan'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="pengalaman_kerja[{{ $i }}][posisi]" class="form-control" placeholder="Posisi/Role" value="{{ $pengalaman_kerja['posisi'] ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <input type="text" name="pengalaman_kerja[{{ $i }}][tahun_mulai]" class="form-control" placeholder="Tahun Mulai" value="{{ $pengalaman_kerja['tahun_mulai'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="pengalaman_kerja[{{ $i }}][tahun_selesai]" class="form-control" placeholder="Tahun Selesai" value="{{ $pengalaman_kerja['tahun_selesai'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="pengalaman_kerja[{{ $i }}][lokasi]" class="form-control" placeholder="Lokasi (Kota)" value="{{ $pengalaman_kerja['lokasi'] ?? '' }}">
                            </div>
                        </div>
                        <textarea name="pengalaman_kerja[{{ $i }}][info_tambahan]" class="form-control" rows="3" placeholder="Informasi Tambahan / Tugas dan Pencapaian">{{ $pengalaman_kerja['info_tambahan'] ?? '' }}</textarea>
                        <button type="button" class="btn btn-danger btn-remove-kerja mt-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="btn-add-pendidikan" class="btn btn-outline-danger mt-2">
                    Tambah Pengalaman Kerja
                </button>
            </div>

            {{-- Pengalaman Organisasi (Array Dinamis) --}}
            <div class="cv-section">
                <h4>Pengalaman Organisasi</h4>
                <div id="organisasi-wrapper">
                    @php
                        $pengalaman_organisasi = $cv && $cv->pengalaman_organisasi ? $cv->pengalaman_organisasi : [[]];
                    @endphp

                    @foreach($pengalaman_organisasi as $i => $pengalaman_organisasi)
                    <div class="organisasi-item mb-3 border rounded p-3">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="pengalaman_organisasi[{{ $i }}][nama_organisasi]" class="form-control" placeholder="Nama Organisasi" value="{{ $pengalaman_organisasi['nama_organisasi'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="pengalaman_organisasi[{{ $i }}][posisi]" class="form-control" placeholder="Jabatan" value="{{ $pengalaman_organisasi['posisi'] ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <input type="text" name="pengalaman_organisasi[{{ $i }}][tahun_mulai]" class="form-control" placeholder="Tahun Mulai" value="{{ $pengalaman_organisasi['tahun_mulai'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="pengalaman_organisasi[{{ $i }}][tahun_selesai]" class="form-control" placeholder="Tahun Selesai" value="{{ $pengalaman_organisasi['tahun_selesai'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="pengalaman_organisasi[{{ $i }}][lokasi]" class="form-control" placeholder="Lokasi (Kota)" value="{{ $pengalaman_organisasi['lokasi'] ?? '' }}">
                            </div>
                        </div>
                        <textarea name="pengalaman_organisasi[{{ $i }}][info_tambahan]" class="form-control" rows="3" placeholder="Deskripsi Peran dan Kontribusi">{{ $pengalaman_organisasi['info_tambahan'] ?? '' }}</textarea>

                        <button type="button" class="btn btn-danger btn-remove-kerja mt-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="btn-add-pendidikan" class="btn btn-outline-danger mt-2">
                    Tambah Pengalaman Organisasi
                </button>
            </div>

            {{-- Skill --}}
            <div class="cv-section">
                <h4>Skill</h4>
                <textarea name="skill" class="form-control" rows="3" placeholder="Contoh: Public Speaking, Microsoft Excel, Laravel, Figma, Bahasa Inggris, dsb.">{{ $cv->skill ?? '' }}</textarea>
            </div>

           {{-- Penghargaan (Array Dinamis) --}}
            <div class="cv-section">
                <h4>Penghargaan</h4>
                <div id="penghargaan-wrapper">
                    @php
                        $penghargaans = $cv && $cv->penghargaan ? $cv->penghargaan : [[]];
                    @endphp

                    @foreach($penghargaans as $i => $penghargaan)
                    <div class="penghargaan-item mb-3 border rounded p-3">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="penghargaan[{{ $i }}][judul]" class="form-control" placeholder="Judul Penghargaan" value="{{ $penghargaan['judul'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="penghargaan[{{ $i }}][penyelenggara]" class="form-control" placeholder="Penyelenggara" value="{{ $penghargaan['penyelenggara'] ?? '' }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="penghargaan[{{ $i }}][tahun]" class="form-control" placeholder="Tahun" value="{{ $penghargaan['tahun'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="penghargaan[{{ $i }}][lokasi]" class="form-control" placeholder="Lokasi (Kota)" value="{{ $penghargaan['lokasi'] ?? '' }}">
                            </div>
                        </div>
                        {{-- <textarea name="penghargaan[{{ $i }}][info_tambahan]" class="form-control" rows="2" placeholder="Informasi Tambahan">{{ $penghargaan['info_tambahan'] ?? '' }}</textarea> --}}

                        <button type="button" class="btn btn-danger btn-remove-kerja mt-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="btn-add-pendidikan" class="btn btn-outline-danger mt-2">
                    Tambah Penghargaan
                </button>
            </div>
            {{-- Tombol Simpan --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- CV Example Modal -->
<div class="modal fade" id="cvExampleModal" tabindex="-1" aria-labelledby="cvExampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cvExampleModalLabel">Contoh CV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cv-example">
                    <!-- Identitas -->
                    <div class="cv-example-header">
                        <h3 class="cv-name">Aldy Ramadhan</h3>
                        <p class="cv-contact kontak-user">081324214732 | satsatria2011@gmail.com | https://www.linkedin.com/in/aldy-ramadhan-putra-satria</p>
                        <p class="cv-location lokasi-user">Surabaya, Jawa Timur</p>
                    </div>

                    <!-- Tentang Saya -->
                    <div class="cv-example-section">
                        <h4>Tentang Saya</h4>
                        <p>Mahasiswa Sistem Informasi dengan keahlian dalam digital marketing dan pengembangan web. Terampil dalam manajemen media sosial dan pembuatan konten, dengan pengalaman dalam merancang visual yang menarik serta menulis yang efektif. Paham dalam menggunakan Laravel untuk pengembangan web, Figma dan Canva untuk desain. Berpengalaman sebagai Social Media Officer di Telkom University Surabaya dengan mengelola platform media sosial resmi kemahasiswaan dan pengembangan karir.</p>
                    </div>

                    <!-- Riwayat Pendidikan -->
                    <div class="cv-example-section">
                        <h4>Riwayat Pendidikan</h4>
                        <div class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>Sarjana (S1) - Sistem Informasi</strong>
                                <div>Telkom University Surabaya</div>
                                <ul class="cv-description-list">
                                    <li>Mengikuti pelatihan desain UI/UX selama 3 bulan</li>
                                    <li>Terpilih untuk menjadi Student Staff Social Media Design</li>
                                </ul>
                            </div>
                            <div class="cv-entry-right">
                                <div>2021 - 2025</div>
                                <div>Surabaya</div>
                            </div>
                        </div>
                    </div>

                    <!-- Pengalaman Kerja -->
                    <div class="cv-example-section">
                        <h4>Pengalaman Kerja</h4>
                        <div class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>Telkom University</strong>
                                <div>Student Staff Social Media Design</div>
                                <ul class="cv-description-list">
                                    <li>Mengembangkan konten Social Media Instagram terkait Kemahasiswaan</li>
                                    <li>Melakukan perencanaan strategi terkait konten setiap hari</li>
                                    <li>Meningkatkan follower Social Media Instagram sebesar 1500</li>
                                </ul>
                            </div>
                            <div class="cv-entry-right">
                                <div>2024 - 2025</div>
                                <div>Surabaya</div>
                            </div>
                        </div>
                    </div>

                    <!-- Pengalaman Organisasi -->
                    <div class="cv-example-section">
                        <h4>Pengalaman Organisasi</h4>
                        <div class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>Himpunan Mahasiswa Sistem Informasi</strong>
                                <div>Anggota Divisi Kewirausahaan</div>
                                <ul class="cv-description-list">
                                    <li>Melakukan perencanaan strategi penjualan merchandise</li>
                                    <li>Inisiasi Jaket Angkatan Sistem Informasi 2021 - 2023</li>
                                </ul>
                            </div>
                            <div class="cv-entry-right">
                                <div>2023 - 2024</div>
                                <div>Surabaya</div>
                            </div>
                        </div>
                    </div>

                    <!-- Skill -->
                    <div class="cv-example-section">
                        <h4>Skill</h4>
                        <p>Design, UI/UX, Creative, Teamwork</p>
                    </div>

                    <!-- Penghargaan & Kompetisi -->
                    <div class="cv-example-section">
                        <h4>Penghargaan & Kompetisi</h4>
                        <div class="cv-entry">
                            <div class="cv-entry-left">
                                <strong>Juara 1 Lomba Desain Grafis</strong>
                                <div>Telkom University</div>
                            </div>
                            <div class="cv-entry-right">
                                <div>2024</div>
                                <div>Surabaya</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Utility untuk tambah item
    function addItem(wrapperId, itemClass, htmlTemplate) {
        const wrapper = document.getElementById(wrapperId);
        const count = wrapper.querySelectorAll('.' + itemClass).length;
        const newHtml = htmlTemplate.replace(/__INDEX__/g, count);
        const div = document.createElement('div');
        div.classList.add(itemClass, 'mb-3', 'border', 'rounded', 'p-3');
        div.innerHTML = newHtml;
        wrapper.appendChild(div);
    }

    // Utility untuk hapus item
    document.body.addEventListener('click', function(e) {
        if (e.target.matches('.btn-remove-pendidikan, .btn-remove-kerja, .btn-remove-organisasi, .btn-remove-penghargaan')) {
            const item = e.target.closest('div.mb-3.border.rounded.p-3');
            if (item) item.remove();
        }
    });

    // Templates dengan placeholder __INDEX__ untuk diganti dengan nomor index
    const pendidikanTemplate = `
        <div class="row mb-2">
            <div class="col-md-4">
                <select name="riwayat_pendidikan[__INDEX__][tingkat]" class="form-control" required>
                    <option value="" disabled selected>Pilih Tingkat Pendidikan</option>
                    <option value="Diploma (D1-D4)">Diploma (D1-D4)</option>
                    <option value="Sarjana (S1)">Sarjana (S1)</option>
                    <option value="Magister (S2)">Magister (S2)</option>
                    <option value="Doktor (S3)">Doktor (S3)</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="riwayat_pendidikan[__INDEX__][jurusan]" class="form-control" placeholder="Jurusan/Program Studi">
            </div>
            <div class="col-md-4">
                <input type="text" name="riwayat_pendidikan[__INDEX__][nama_sekolah]" class="form-control" placeholder="Nama Sekolah/PT">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4">
                <input type="text" name="riwayat_pendidikan[__INDEX__][tahun_mulai]" class="form-control" placeholder="Tahun Mulai">
            </div>
            <div class="col-md-4">
                <input type="text" name="riwayat_pendidikan[__INDEX__][tahun_lulus]" class="form-control" placeholder="Tahun Lulus">
            </div>
            <div class="col-md-4">
                <input type="text" name="riwayat_pendidikan[__INDEX__][lokasi]" class="form-control" placeholder="Lokasi (Kota)">
            </div>
        </div>
        <textarea name="riwayat_pendidikan[__INDEX__][info_tambahan]" class="form-control" rows="2" placeholder="* Contoh: Mendapat Beasiswa Prestasi Awardee dengan minimum IPK 3,75"></textarea>
        <button type="button" class="btn btn-danger btn-remove-pendidikan mt-2">Hapus</button>
    `;

    const kerjaTemplate = `
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" name="pengalaman_kerja[__INDEX__][nama_perusahaan]" class="form-control" placeholder="Nama Perusahaan">
            </div>
            <div class="col-md-6">
                <input type="text" name="pengalaman_kerja[__INDEX__][posisi]" class="form-control" placeholder="Posisi/Role">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4">
                <input type="text" name="pengalaman_kerja[__INDEX__][tahun_mulai]" class="form-control" placeholder="Tahun Mulai">
            </div>
            <div class="col-md-4">
                <input type="text" name="pengalaman_kerja[__INDEX__][tahun_selesai]" class="form-control" placeholder="Tahun Selesai">
            </div>
            <div class="col-md-4">
                <input type="text" name="pengalaman_kerja[__INDEX__][lokasi]" class="form-control" placeholder="Lokasi (Kota)">
            </div>
        </div>
        <textarea name="pengalaman_kerja[__INDEX__][info_tambahan]" class="form-control" rows="3" placeholder="Informasi Tambahan / Tugas dan Pencapaian"></textarea>
        <button type="button" class="btn btn-danger btn-remove-kerja mt-2">Hapus</button>
    `;

    const organisasiTemplate = `
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" name="pengalaman_organisasi[__INDEX__][nama_organisasi]" class="form-control" placeholder="Nama Organisasi">
            </div>
            <div class="col-md-6">
                <input type="text" name="pengalaman_organisasi[__INDEX__][posisi]" class="form-control" placeholder="Jabatan">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4">
                <input type="text" name="pengalaman_organisasi[__INDEX__][tahun_mulai]" class="form-control" placeholder="Tahun Mulai">
            </div>
            <div class="col-md-4">
                <input type="text" name="pengalaman_organisasi[__INDEX__][tahun_selesai]" class="form-control" placeholder="Tahun Selesai">
            </div>
            <div class="col-md-4">
                <input type="text" name="pengalaman_organisasi[__INDEX__][lokasi]" class="form-control" placeholder="Lokasi (Kota)">
            </div>
        </div>
        <textarea name="pengalaman_organisasi[__INDEX__][info_tambahan]" class="form-control" rows="3" placeholder="Deskripsi Peran dan Kontribusi"></textarea>
        <button type="button" class="btn btn-danger btn-remove-organisasi mt-2">Hapus</button>
    `;

    const penghargaanTemplate = `
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" name="penghargaan[__INDEX__][judul]" class="form-control" placeholder="Judul Penghargaan">
            </div>
            <div class="col-md-6">
                <input type="text" name="penghargaan[__INDEX__][penyelenggara]" class="form-control" placeholder="Penyelenggara">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <input type="text" name="penghargaan[__INDEX__][tahun]" class="form-control" placeholder="Tahun">
            </div>
            <div class="col-md-6">
                <input type="text" name="penghargaan[__INDEX__][lokasi]" class="form-control" placeholder="Lokasi (Kota)">
            </div>
        </div>
        <button type="button" class="btn btn-danger btn-remove-penghargaan mt-2">Hapus</button>
    `;

    document.getElementById('btn-add-pendidikan').addEventListener('click', () => {
        addItem('pendidikan-wrapper', 'pendidikan-item', pendidikanTemplate);
    });
    document.getElementById('btn-add-kerja').addEventListener('click', () => {
        addItem('kerja-wrapper', 'kerja-item', kerjaTemplate);
    });
    document.getElementById('btn-add-organisasi').addEventListener('click', () => {
        addItem('organisasi-wrapper', 'organisasi-item', organisasiTemplate);
    });
    document.getElementById('btn-add-penghargaan').addEventListener('click', () => {
        addItem('penghargaan-wrapper', 'penghargaan-item', penghargaanTemplate);
    });
});

</script>
