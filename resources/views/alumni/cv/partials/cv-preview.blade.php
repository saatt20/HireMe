<div class="container cv-preview text-start">
    {{-- Header Nama dan Kontak --}}
    <div class="mb-4">
        <h2 class="cv-name">{{ $user->name }}</h2>
        <p class="cv-contact">{{ $alumni->telepon }} | {{ $user->email }} | {{ $alumni->linkedin }}</p>
        <p class="cv-location">{{ $alumni->kota }}, {{ $alumni->provinsi }}</p>
    </div>

    {{-- Tentang Saya --}}
    @php
        $hasTentangSaya = isset($cv->tentang_saya) && trim($cv->tentang_saya) !== '' && $cv->tentang_saya !== null;
    @endphp
    @if($hasTentangSaya)
    <div class="cv-section">
        <h4>Tentang Saya</h4>
        <hr>
        <p>{{ $cv->tentang_saya }}</p>
    </div>
    @endif

    {{-- Riwayat Pendidikan --}}
    @php
        $hasPendidikan = isset($cv->riwayat_pendidikan) && is_array($cv->riwayat_pendidikan) && count($cv->riwayat_pendidikan) > 0;
        if ($hasPendidikan) {
            // Periksa apakah ada data yang benar-benar terisi
            $hasValidPendidikan = false;
            foreach ($cv->riwayat_pendidikan as $pendidikan) {
                if (!empty($pendidikan['nama_sekolah']) || !empty($pendidikan['tingkat']) || !empty($pendidikan['jurusan'])) {
                    $hasValidPendidikan = true;
                    break;
                }
            }
            $hasPendidikan = $hasValidPendidikan;
        }
    @endphp
    @if($hasPendidikan)
    <div class="cv-section">
        <h4>Riwayat Pendidikan</h4>
        <hr>
        @foreach($cv->riwayat_pendidikan as $pendidikan)
            @if(!empty($pendidikan['nama_sekolah']) || !empty($pendidikan['tingkat']) || !empty($pendidikan['jurusan']))
            <div class="cv-entry">
                <div class="cv-entry-left">
                    <strong>{{ $pendidikan['nama_sekolah'] ?? '-' }}</strong><br>
                    {{ $pendidikan['tingkat'] ?? '-' }} - {{ $pendidikan['jurusan'] ?? '-' }}
                    @if(!empty($pendidikan['info_tambahan']))
                        <ul class="cv-description-list">
                            @foreach(explode("\n", $pendidikan['info_tambahan']) as $poin)
                                @if(trim($poin) != '')
                                    <li>{{ $poin }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="cv-entry-right text-end">
                    <div><strong>{{ $pendidikan['lokasi'] ?? '-' }}</strong></div>
                    <div><strong>{{ $pendidikan['tahun_mulai'] ?? '-' }} - {{ $pendidikan['tahun_lulus'] ?? '-' }}</strong></div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif

    {{-- Pengalaman Kerja --}}
    @php
        $hasKerja = isset($cv->pengalaman_kerja) && is_array($cv->pengalaman_kerja) && count($cv->pengalaman_kerja) > 0;
        if ($hasKerja) {
            // Periksa apakah ada data yang benar-benar terisi
            $hasValidKerja = false;
            foreach ($cv->pengalaman_kerja as $kerja) {
                if (!empty($kerja['posisi']) || !empty($kerja['nama_perusahaan'])) {
                    $hasValidKerja = true;
                    break;
                }
            }
            $hasKerja = $hasValidKerja;
        }
    @endphp
    @if($hasKerja)
    <div class="cv-section">
        <h4>Pengalaman Kerja</h4>
        <hr>
        @foreach($cv->pengalaman_kerja as $kerja)
            @if(!empty($kerja['posisi']) || !empty($kerja['nama_perusahaan']))
            <div class="cv-entry">
                <div class="cv-entry-left">
                    <strong>{{ $kerja['posisi'] ?? '-' }}</strong><br>
                    {{ $kerja['nama_perusahaan'] ?? '-' }}
                    @if(!empty($kerja['info_tambahan']))
                        <ul class="cv-description-list">
                            @foreach(explode("\n", $kerja['info_tambahan']) as $poin)
                                @if(trim($poin) != '')
                                    <li>{{ $poin }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="cv-entry-right text-end">
                    <div><strong>{{ $kerja['lokasi'] ?? '-' }}</strong></div>
                    <div><strong>{{ $kerja['tahun_mulai'] ?? '-' }} - {{ $kerja['tahun_selesai'] ?? '-' }}</strong></div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif

    {{-- Pengalaman Organisasi --}}
    @php
        $hasOrganisasi = isset($cv->pengalaman_organisasi) && is_array($cv->pengalaman_organisasi) && count($cv->pengalaman_organisasi) > 0;
        if ($hasOrganisasi) {
            // Periksa apakah ada data yang benar-benar terisi
            $hasValidOrganisasi = false;
            foreach ($cv->pengalaman_organisasi as $org) {
                if (!empty($org['posisi']) || !empty($org['nama_organisasi'])) {
                    $hasValidOrganisasi = true;
                    break;
                }
            }
            $hasOrganisasi = $hasValidOrganisasi;
        }
    @endphp
    @if($hasOrganisasi)
    <div class="cv-section">
        <h4>Pengalaman Organisasi</h4>
        <hr>
        @foreach($cv->pengalaman_organisasi as $org)
            @if(!empty($org['posisi']) || !empty($org['nama_organisasi']))
            <div class="cv-entry">
                <div class="cv-entry-left">
                    <strong>{{ $org['posisi'] ?? '-' }}</strong><br>
                    {{ $org['nama_organisasi'] ?? '-' }}
                    @if(!empty($org['info_tambahan']))
                        <ul class="cv-description-list">
                            @foreach(explode("\n", $org['info_tambahan']) as $poin)
                                @if(trim($poin) != '')
                                    <li>{{ $poin }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="cv-entry-right text-end">
                    <div><strong>{{ $org['lokasi'] ?? '-' }}</strong></div>
                    <div><strong>{{ $org['tahun_mulai'] ?? '-' }} - {{ $org['tahun_selesai'] ?? '-' }}</strong></div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif

    {{-- Skill --}}
    @php
        $hasSkill = isset($cv->skill) && trim($cv->skill) !== '' && $cv->skill !== null;
    @endphp
    @if($hasSkill)
    <div class="cv-section">
        <h4>Skill</h4>
        <hr>
        <p>{{ $cv->skill }}</p>
    </div>
    @endif

    {{-- Penghargaan dan Kompetisi --}}
    @php
        $hasPenghargaan = isset($cv->penghargaan) && is_array($cv->penghargaan) && count($cv->penghargaan) > 0;
        if ($hasPenghargaan) {
            // Periksa apakah ada data yang benar-benar terisi
            $hasValidPenghargaan = false;
            foreach ($cv->penghargaan as $award) {
                if (!empty($award['judul']) || !empty($award['penyelenggara'])) {
                    $hasValidPenghargaan = true;
                    break;
                }
            }
            $hasPenghargaan = $hasValidPenghargaan;
        }
    @endphp
    @if($hasPenghargaan)
    <div class="cv-section">
        <h4>Penghargaan dan Kompetisi</h4>
        <hr>
        @foreach($cv->penghargaan as $award)
            @if(!empty($award['judul']) || !empty($award['penyelenggara']))
            <div class="cv-entry">
                <div class="cv-entry-left">
                    <strong>{{ $award['judul'] ?? '-' }}</strong><br>
                    {{ $award['penyelenggara'] ?? '-' }}
                </div>
                <div class="cv-entry-right text-end">
                    <div><strong>{{ $award['lokasi'] ?? '-' }}</strong></div>
                    <div><strong>{{ $award['tahun'] ?? '-' }}</strong></div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif

    {{-- Watermark untuk cetak --}}
    <div class="watermark-footer">
        Career Development Center Telkom University Surabaya
    </div>
</div>

<style>
    .cv-section {
        margin-bottom: 0;
        margin-top: 0;
        padding-top: 0;
    }

    .cv-name {
        font-size: 1.75rem;
        font-weight: bold;
    }

    .cv-contact, .cv-location {
        font-size: 0.95rem;
        color: #555555;
    }

    .cv-entry {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 0px;
    }

    .cv-entry-left {
        flex: 1;
        min-width: 60%;
    }

    .cv-entry-right {
        flex: 1;
        min-width: 30%;
    }

    .cv-description-list {
        padding-left: 20px;
        margin-top: 0.5rem;
    }

    .cv-description-list li {
        list-style-type: disc;
        margin-bottom: 0.3rem;
    }

    .cv-preview {
        padding: 1.5rem;
        background-color: #fff;
    }

    .cv-preview h4 {
        color: #000000;
        font-weight: bold;
        margin-bottom: 0.75rem;
    }

    .cv-preview hr {
        border-top: 2px solid #000000;
        margin-bottom: 0.5rem;
    }

    /* Watermark */
    .watermark-footer {
        margin-top: 30px;
        padding-top: 10px;
        border-top: 1px solid #eee;
        color: #888;
        font-size: 11px;
        text-align: center;
    }

    /* Print-specific styles */
    @media print {
        .cv-preview {
            padding: 0 !important;
            margin: 0 !important;
        }

        .container {
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin: 0;
        }

        /* Membuat pagebreak lebih predictable */
        .cv-section {
            page-break-inside: avoid;
        }

        /* Watermark untuk cetak */
        .watermark-footer {
            display: block !important;
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 10pt;
            color: #999;
            border-top: none;
        }

        /* Optimasi untuk cetak */
        body {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
