<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV - {{ $user->name }}</title>
    <style>
        @page {
            margin: 30px 40px;
        }

        body {
            font-family: Arial;
            font-size: 12px;
            line-height: 1.6;
            background: white;
            padding: 20px 30px;
            margin: 0;
            color: #000000;
        }

        /* Global text classes */
        .cv-text {
            color: #000000;
            font-family: Arial;
        }

        .cv-text-muted {
            color: #000000;
            font-family: Arial;
        }

        .cv-text-strong {
            color: #000000;
            font-weight: bold;
            font-family: Arial;
        }

       .cv-title {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1.5px solid #000000;
            padding-bottom: 0.25rem;
            margin-bottom: 0.5rem;
            color: #000000;
            font-size: 1rem;
            font-family: Arial;
        }

        .cv-subtitle {
            color: #000000;
            font-size: 1rem;
            font-family: Arial;
        }

        .cv-paragraph {
            color: #000000;
            margin-bottom: 0.8rem;
            font-family: Arial;
        }

        .cv-name {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            font-family: Arial;
        }

        .cv-contact {
            margin-bottom: 0.3rem;
            font-family: Arial;
        }

        .cv-location {
            margin-bottom: 1.5rem;
            font-family: Arial;
        }

        .cv-section {
            margin-top: 1rem;
            page-break-inside: avoid;
            font-family: Arial;
        }

        .cv-entry-left {
            float: left;
            width: 68%;
        }

        .cv-entry-right {
            float: right;
            width: 30%;
            text-align: right;
            font-size: 1rem;
            font-style: normal;
            font-weight: 600;
        }

        .cv-description-list {
            margin-top: 0.5rem;
            padding-left: 1.2rem;
            list-style-type: disc;
        }

        .cv-description-list li {
            color: #000000;
            font-family: Arial;
        }

        .clear {
            clear: both;
        }

        .clearfix::after {
        content: "";
        display: table;
        clear: both;
        }

        .cv-entry.clearfix::after {
        content: "";
        display: table;
        clear: both;
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
    </style>
</head>
<body>

    <!-- Identitas -->
    <div class="cv-name cv-text-strong">{{ $user->name }}</div>
    <div class="cv-contact cv-text">{{ $alumni->telepon ?? '-' }} | {{ $user->email }} | {{ $alumni->linkedin ?? '-' }}</div>
    <div class="cv-location cv-text-muted">{{ $alumni->kota ?? '-' }}, {{ $alumni->provinsi ?? '-' }}</div>

    <!-- Tentang Saya -->
    @php
        $hasTentangSaya = isset($cv->tentang_saya) && trim($cv->tentang_saya) !== '' && $cv->tentang_saya !== null && $cv->tentang_saya !== 'Belum ada data';
    @endphp
    @if($hasTentangSaya)
    <div class="cv-section">
        <h4 class="cv-title">Tentang Saya</h4>
        <p class="cv-paragraph">{!! nl2br(e($cv->tentang_saya)) !!}</p>
    </div>
    @endif

    <!-- Pendidikan -->
    @php
        $hasPendidikan = false;
        if (isset($cv->riwayat_pendidikan) && is_array($cv->riwayat_pendidikan) && count($cv->riwayat_pendidikan) > 0) {
            foreach ($cv->riwayat_pendidikan as $pendidikan) {
                if (!empty($pendidikan['nama_sekolah']) || !empty($pendidikan['tingkat']) || !empty($pendidikan['jurusan'])) {
                    $hasPendidikan = true;
                    break;
                }
            }
        }
    @endphp
    @if($hasPendidikan)
    <div class="cv-section">
        <h4 class="cv-title">Riwayat Pendidikan</h4>
        @foreach($cv->riwayat_pendidikan as $pendidikan)
            @if(!empty($pendidikan['nama_sekolah']) || !empty($pendidikan['tingkat']) || !empty($pendidikan['jurusan']))
            <div class="cv-entry clearfix">
                <div class="cv-entry-left cv-text">
                    <strong class="cv-text-strong">{{ $pendidikan['nama_sekolah'] ?? '-' }}</strong><br>
                    <span class="cv-subtitle">{{ $pendidikan['tingkat'] ?? '-' }} - {{ $pendidikan['jurusan'] ?? '-' }}</span>
                    @if(!empty($pendidikan['info_tambahan']))
                    <ul class="cv-description-list">
                        @foreach(explode("\n", $pendidikan['info_tambahan']) as $poin)
                            @if(trim($poin) != '')
                                <li class="cv-text">{{ $poin }}</li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="cv-entry-right cv-text-muted">
                    {{ $pendidikan['lokasi'] ?? '-' }}<br>
                    {{ $pendidikan['tahun_mulai'] ?? '-' }} - {{ $pendidikan['tahun_lulus'] ?? '-' }}
                </div>
            </div>
            @endif
        @endforeach
        <div class="clear"></div>
    </div>
    @endif

    <!-- Pengalaman Kerja -->
    @php
        $hasKerja = false;
        if (isset($cv->pengalaman_kerja) && is_array($cv->pengalaman_kerja) && count($cv->pengalaman_kerja) > 0) {
            foreach ($cv->pengalaman_kerja as $kerja) {
                if (!empty($kerja['posisi']) || !empty($kerja['nama_perusahaan'])) {
                    $hasKerja = true;
                    break;
                }
            }
        }
    @endphp
    @if($hasKerja)
    <div class="cv-section">
        <h4 class="cv-title">Pengalaman Kerja</h4>
        @foreach($cv->pengalaman_kerja as $kerja)
            @if(!empty($kerja['posisi']) || !empty($kerja['nama_perusahaan']))
            <div class="cv-entry clearfix">
                <div class="cv-entry-left cv-text">
                    <strong class="cv-text-strong">{{ $kerja['posisi'] ?? '-' }}</strong><br>
                    <span class="cv-subtitle">{{ $kerja['nama_perusahaan'] ?? '-' }}</span>
                    @if(!empty($kerja['info_tambahan']))
                    <ul class="cv-description-list">
                        @foreach(explode("\n", $kerja['info_tambahan']) as $poin)
                            @if(trim($poin) != '')
                                <li class="cv-text">{{ $poin }}</li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="cv-entry-right cv-text-muted">
                    {{ $kerja['lokasi'] ?? '-' }}<br>
                    {{ $kerja['tahun_mulai'] ?? '-' }} - {{ $kerja['tahun_selesai'] ?? '-' }}
                </div>
            </div>
            @endif
        @endforeach
        <div class="clear"></div>
    </div>
    @endif

    <!-- Pengalaman Organisasi -->
    @php
        $hasOrganisasi = false;
        if (isset($cv->pengalaman_organisasi) && is_array($cv->pengalaman_organisasi) && count($cv->pengalaman_organisasi) > 0) {
            foreach ($cv->pengalaman_organisasi as $org) {
                if (!empty($org['posisi']) || !empty($org['nama_organisasi'])) {
                    $hasOrganisasi = true;
                    break;
                }
            }
        }
    @endphp
    @if($hasOrganisasi)
    <div class="cv-section">
        <h4 class="cv-title">Pengalaman Organisasi</h4>
        @foreach($cv->pengalaman_organisasi as $org)
            @if(!empty($org['posisi']) || !empty($org['nama_organisasi']))
            <div class="cv-entry clearfix">
                <div class="cv-entry-left cv-text">
                    <strong class="cv-text-strong">{{ $org['posisi'] ?? '-' }}</strong><br>
                    <span class="cv-subtitle">{{ $org['nama_organisasi'] ?? '-' }}</span>
                    @if(!empty($org['info_tambahan']))
                    <ul class="cv-description-list">
                        @foreach(explode("\n", $org['info_tambahan']) as $poin)
                            @if(trim($poin) != '')
                                <li class="cv-text">{{ $poin }}</li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="cv-entry-right cv-text-muted">
                    {{ $org['lokasi'] ?? '-' }}<br>
                    {{ $org['tahun_mulai'] ?? '-' }} - {{ $org['tahun_selesai'] ?? '-' }}
                </div>
            </div>
            @endif
        @endforeach
        <div class="clear"></div>
    </div>
    @endif

    <!-- Skill -->
    @php
        $hasSkill = isset($cv->skill) && trim($cv->skill) !== '' && $cv->skill !== null && $cv->skill !== 'Belum ada data';
    @endphp
    @if($hasSkill)
    <div class="cv-section">
        <h4 class="cv-title">Skill</h4>
        <p class="cv-paragraph">{!! nl2br(e($cv->skill)) !!}</p>
    </div>
    @endif

    <!-- Penghargaan -->
    @php
        $hasPenghargaan = false;
        if (isset($cv->penghargaan) && is_array($cv->penghargaan) && count($cv->penghargaan) > 0) {
            foreach ($cv->penghargaan as $award) {
                if (!empty($award['judul']) || !empty($award['penyelenggara'])) {
                    $hasPenghargaan = true;
                    break;
                }
            }
        }
    @endphp
    @if($hasPenghargaan)
    <div class="cv-section">
        <h4 class="cv-title">Penghargaan & Kompetisi</h4>
        @foreach($cv->penghargaan as $award)
            @if(!empty($award['judul']) || !empty($award['penyelenggara']))
            <div class="cv-entry clearfix">
                <div class="cv-entry-left cv-text">
                    <strong class="cv-text-strong">{{ $award['judul'] ?? '-' }}</strong><br>
                    <span class="cv-subtitle">{{ $award['penyelenggara'] ?? '-' }}</span>
                </div>
                <div class="cv-entry-right cv-text-muted">
                    {{ $award['lokasi'] ?? '-' }}<br>
                    {{ $award['tahun'] ?? '-' }}
                </div>
            </div>
            @endif
        @endforeach
        <div class="clear"></div>
    </div>
    @endif
    {{-- Watermark untuk cetak --}}
        <div class="watermark-footer">
            Career Development Center Telkom University Surabaya
        </div>
</body>
</html>
