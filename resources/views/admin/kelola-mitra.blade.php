@extends('layouts.navbaradmin')

@section('title', 'Daftar Mitra')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-index-mitra.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-4">
    {{-- Card Judul --}}
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Daftar Mitra</h4>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- Card Tabel --}}
    <div class="card card-tabel shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <form action="{{ route('admin.daftarMitra') }}" method="GET" class="search-form">
                    <input type="text" name="search" class="form-control" placeholder="Cari Mitra" value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="table-heading">
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Email</th>
                            {{-- <th>Username</th> --}}
                            <th>Nomor Telepon</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mitras as $index => $mitra)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mitra->name }}</td>
                            <td>{{ $mitra->email }}</td>
                            {{-- <td>{{ $mitra->username }}</td> --}}
                            <td>{{ $mitra->mitra->telepon }}</td>
                            <td>{{ $mitra->mitra->kota }}</td>
                            <td>{{ $mitra->mitra->provinsi }}</td>
                            <td>
                                @if ($mitra->status === 'pending')
                                <span class="badge bg-warning">Menunggu</span>
                                @elseif ($mitra->status === 'approved')
                                <span class="badge bg-success">Diterima</span>
                                @elseif ($mitra->status === 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                                @else
                                <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    @if ($mitra->status === 'pending')
                                    <form action="{{ route('admin.mitra.status', $mitra->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm mt-1" onclick="return confirm('Apakah Anda yakin ingin menerima mitra ini?')">
                                            <i class="fas fa-check"></i> Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.mitra.status', $mitra->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Apakah Anda yakin ingin menolak mitra ini?')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>
                                    @elseif ($mitra->status === 'rejected')
                                    <form action="{{ route('admin.mitra.status', $mitra->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm mt-1" onclick="return confirm('Apakah Anda yakin ingin menerima mitra ini?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @elseif ($mitra->status === 'approved')
                                    <form action="{{ route('admin.mitra.status', $mitra->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Apakah Anda yakin ingin menolak mitra ini?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('admin.deleteMitra', $mitra->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus mitra ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mt-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "paging": true,
            "ordering": true,
            "info": true
        });
    });
</script>
@endsection
