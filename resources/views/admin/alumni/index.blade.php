@extends('layouts.navbaradmin')

@section('title', 'Daftar Alumni')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-index-mitra.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .table-custom {
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .table-custom th {
        background-color: #ffffff;
        border-bottom: 2px solid #000000;
        font-weight: 600;
        padding: 12px 8px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-custom td {
        padding: 10px 8px;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }

    .table-custom .col-no { width: 50px; text-align: center; }
    .table-custom .col-nama { width: 180px; }
    .table-custom .col-email { width: 200px; }
    .table-custom .col-telepon { width: 130px; }
    .table-custom .col-nim { width: 120px; text-align: center; }
    .table-custom .col-prodi { width: 150px; }
    .table-custom .col-angkatan { width: 80px; text-align: center; }
    .table-custom .col-status { width: 120px; text-align: center; }
    .table-custom .col-aksi { width: 80px; text-align: center; }

    .table-custom .text-truncate-custom {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-custom .email-truncate {
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .badge-custom {
        font-size: 0.75rem;
        padding: 4px 8px;
    }

    .btn-action {
        padding: 6px 10px;
        font-size: 0.8rem;
        border-radius: 4px;
    }

    .search-form {
        max-width: 300px;
    }

    .search-form .form-control {
        font-size: 0.9rem;
        padding: 8px 12px;
    }
</style>

<div class="container mt-4">

    {{-- Card Judul --}}
    <div class="text-white bg-red-custom relative-container rounded-4 shadow-sm p-4 mb-4">
        <img src="{{ asset('images/Group-64.png') }}" alt="CV" class="position-absolute top-0 end-0" style="height: 100%; z-index: 50;">
        <h4 class="mb-0 fw-semibold">Daftar Alumni</h4>
    </div>

    {{-- Card Tabel --}}
    <div class="card card-tabel shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                {{-- Form pencarian --}}
                <form action="{{ route('admin.alumni.index') }}" method="GET" class="search-form">
                    <input type="text" name="search" class="form-control" placeholder="Cari Alumni" value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr class="table-heading">
                            <th class="col-no">No</th>
                            <th class="col-nama">Nama</th>
                            <th class="col-email">Email</th>
                            <th class="col-telepon">Telepon</th>
                            <th class="col-nim">NIM</th>
                            <th class="col-prodi">Program Studi</th>
                            <th class="col-angkatan">Angkatan</th>
                            <th class="col-status">Status Kerja</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnis as $index => $alumni)
                        <tr>
                            <td class="col-no">{{ $index + 1 }}</td>
                            <td class="col-nama">
                                <div class="text-truncate-custom" title="{{ $alumni->user->name ?? '-' }}">
                                    {{ $alumni->user->name ?? '-' }}
                                </div>
                            </td>
                            <td class="col-email">
                                <div class="email-truncate" title="{{ $alumni->user->email ?? '-' }}">
                                    {{ $alumni->user->email ?? '-' }}
                                </div>
                            </td>
                            <td class="col-telepon">{{ $alumni->telepon ?? '-' }}</td>
                            <td class="col-nim">{{ $alumni->nim ?? '-' }}</td>
                            <td class="col-prodi">
                                <div class="text-truncate-custom" title="{{ $alumni->program_studi ?? '-' }}">
                                    {{ $alumni->program_studi ?? '-' }}
                                </div>
                            </td>
                            <td class="col-angkatan">{{ $alumni->angkatan ?? '-' }}</td>
                            <td class="col-status">
                                <span class="badge badge-custom bg-{{ $alumni->status_kerja ? 'success' : 'secondary' }}">
                                    {{ $alumni->status_kerja ? 'Bekerja' : 'Mencari Kerja' }}
                                </span>
                            </td>
                            <td class="col-aksi">
                                <form action="{{ route('admin.alumni.destroy', $alumni->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus alumni ini?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-custom-red btn-action" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
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
