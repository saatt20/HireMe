<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Bukti Pemberitahuan</title>
    <link href="{{ asset('css/bukti.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Tombol cetak & tutup - hanya tampil di layar -->
    <div class="no-print">
        <button onclick="window.print()">Cetak Bukti</button>
    </div>

    <!-- Konten utama yang akan dicetak -->
    <div class="print-content">
        <p><strong>Judul Lowongan:</strong> {{ $lamaran->lowongan->judul }}</p>
        <p><strong>Perusahaan:</strong> {{ $lamaran->lowongan->user->name }}</p>
        <p><strong>Status:</strong>
            <span class="badge
                @if($lamaran->status == 'Diterima') bg-success
                @elseif($lamaran->status == 'Ditolak') bg-danger
                @else bg-warning
                @endif">
                {{ ucfirst($lamaran->status) }}
            </span>
        </p>
        <p><strong>Tanggal Lamaran:</strong> {{ $lamaran->created_at->format('d M Y') }}</p>

        <p>
            {!! $lamaran->pesan ?? '
                Setelah melalui proses seleksi administrasi dan evaluasi berkas,
                dengan ini kami menyampaikan bahwa <strong>Anda dinyatakan Lolos Seleksi Berkas</strong>.
                Besar harapan Kami untuk Anda bisa melanjutkan ke tahap berikutnya. Informasi lebih lanjut terkait jadwal dan teknis pelaksanaan
                tahap selanjutnya akan kami sampaikan setelah menerima konfirmasi dari Anda. Konfirmasi dapat dilakukan melalui
                <strong>Human Resources Department</strong> dengan melampirkan cetak bukti surat pernyataan Lolos Seleksi ke E-mail
                <strong>' . $lamaran->lowongan->user->email . '</strong>.' !!}
        </p>
    </div>

    <!-- Tombol bawah -->
    <div class="no-print">
        <button onclick="window.print()">Cetak Lagi</button>
        <button onclick="window.close()">Tutup</button>
    </div>

    <script>
        // Cetak otomatis saat halaman dimuat
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
