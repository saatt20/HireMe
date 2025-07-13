@extends('layouts.navbarmitra')

@section('title', 'Detail Rekrutmen')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-index-mitra.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-4">

    {{-- Card Judul --}}
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Detail Rekrutmen: {{ $lowongan->judul }}</h4>
        <p class="mb-0 mt-2"><strong>Jumlah Pelamar:</strong> {{ $lowongan->lamarans->count() }}</p>
    </div>

    {{-- Card Tabel --}}
    <div class="card card-tabel shadow-sm">
        <a href="{{ route('mitra.rekrutmen.index') }}"
        class="back-icon"><i class="fas fa-arrow-left"></i>
        </a>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="table-heading">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>CV</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowongan->lamarans as $index => $lamaran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $lamaran->user->name ?? '-' }}</td>
                                <td>{{ $lamaran->user->alumni->telepon ?? '-' }}</td>
                                <td>{{ $lamaran->user->email ?? '-' }}</td>
                                <td>
                                    @if($lamaran->cv_pdf)
                                        <a href="{{ asset('storage/' . $lamaran->cv_pdf) }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="fas fa-file-pdf"></i> Lihat CV
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ ucfirst($lamaran->status) }}</td>
                                <td class="d-flex gap-1">
                                    <form id="acceptForm{{ $lamaran->id }}" action="{{ route('mitra.rekrutmen.terima', $lamaran->id) }}" method="POST">
                                        @csrf
                                        <button type="button" class="btn btn-success btn-sm"
                                                title="Terima"
                                                onclick="confirmAccept({{ $lamaran->id }}, '{{ $lamaran->user->name ?? 'Pelamar' }}')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form id="rejectForm{{ $lamaran->id }}" action="{{ route('mitra.rekrutmen.tolak', $lamaran->id) }}" method="POST">
                                        @csrf
                                        <button type="button" class="btn btn-custom-red btn-sm"
                                                title="Tolak"
                                                onclick="confirmReject({{ $lamaran->id }}, '{{ $lamaran->user->name ?? 'Pelamar' }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pelamar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Modal Konfirmasi Terima --}}
<div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="acceptModalLabel">
                    <i class="fas fa-check-circle me-2"></i>Konfirmasi Penerimaan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-user-check text-success mb-3" style="font-size: 3rem;"></i>
                    <p class="fs-5 mb-3">Apakah Anda yakin ingin menerima pelamar:</p>
                    <h6 class="fw-bold text-success" id="acceptApplicantName"></h6>
                    <p class="text-muted mt-3">Pelamar akan mendapatkan notifikasi bahwa lamaran telah diterima.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="acceptForm" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>Ya, Terima
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Tolak --}}
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="rejectModalLabel">
                    <i class="fas fa-times-circle me-2"></i>Konfirmasi Penolakan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-user-times text-danger mb-3" style="font-size: 3rem;"></i>
                    <p class="fs-5 mb-3">Apakah Anda yakin ingin menolak pelamar:</p>
                    <h6 class="fw-bold text-danger" id="rejectApplicantName"></h6>
                    <p class="text-muted mt-3">Pelamar akan mendapatkan notifikasi bahwa lamaran telah ditolak.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="rejectForm" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>Ya, Tolak
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmAccept(lamaranId, applicantName) {
    // Set nama pelamar di modal
    document.getElementById('acceptApplicantName').textContent = applicantName;

    // Tampilkan modal
    var acceptModal = new bootstrap.Modal(document.getElementById('acceptModal'));
    acceptModal.show();

    // Set event listener untuk tombol konfirmasi
    document.getElementById('acceptForm').onsubmit = function(e) {
        e.preventDefault();
        document.getElementById('acceptForm' + lamaranId).submit();
    };
}

function confirmReject(lamaranId, applicantName) {
    // Set nama pelamar di modal
    document.getElementById('rejectApplicantName').textContent = applicantName;

    // Tampilkan modal
    var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
    rejectModal.show();

    // Set event listener untuk tombol konfirmasi
    document.getElementById('rejectForm').onsubmit = function(e) {
        e.preventDefault();
        document.getElementById('rejectForm' + lamaranId).submit();
    };
}
</script>
@endsection
