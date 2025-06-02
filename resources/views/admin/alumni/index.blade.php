@extends('layouts.navbaradmin')

@section('title', 'Daftar Alumni')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-index-mitra.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
                {{-- Optional: Tambahkan form pencarian --}}
                <form action="{{ route('admin.alumni.index') }}" method="GET" class="search-form">
                    <input type="text" name="search" class="form-control" placeholder="Cari Alumni" value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="table-heading">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Program Studi</th>
                            <th>Angkatan</th>
                            <th>Status Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnis as $index => $alumni)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $alumni->user->name ?? '-' }}</td>
                            <td>{{ $alumni->user->email ?? '-' }}</td>
                            <td>{{ $alumni->telepon ?? '-' }}</td>
                            <td>{{ $alumni->program_studi ?? '-' }}</td>
                            <td>{{ $alumni->angkatan ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $alumni->status_kerja ? 'success' : 'secondary' }}">
                                    {{ $alumni->status_kerja ? 'Bekerja' : 'Mencari Kerja' }}
                                </span>
                            </td>
                            <td class="d-flex gap-1 justify-content-center">
                                <form action="{{ route('admin.alumni.destroy', $alumni->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus alumni ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-custom-red" title="Hapus">
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
