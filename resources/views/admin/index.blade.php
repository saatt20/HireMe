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

    {{-- Card Tabel --}}
    <div class="card card-tabel shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <a href="{{ route('admin.mitra.create') }}" class="btn btn-custom-red mb-3">
                    <i class="fas fa-plus"></i> Tambah Mitra
                </a>

                <form action="{{ route('admin.daftarMitra') }}" method="GET" class="search-form">
                    <input type="text" name="search" class="form-control" placeholder="Cari Mitra" value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="table-heading">
                            <th>No</th>
                            <th>Nama Mitra</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Telepon</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mitras as $index => $mitra)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mitra->user->name }}</td>
                        <td>{{ $mitra->user->email }}</td>
                        <td>{{ $mitra->user->username }}</td>
                        <td>{{ $mitra->kota }}</td>
                        <td>{{ $mitra->provinsi }}</td>
                        <td>{{ $mitra->telepon }}</td>
                        <td class="d-flex flex-column gap-1">
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.deleteMitra', $mitra->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mitra ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mt-1">
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
