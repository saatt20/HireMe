{{-- @extends('layouts.navbarmitra')

@section('content')
<div class="container">
    <h2>Edit Profil Mitra</h2>

    <form action="{{ route('mitra.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" name="telepon" value="{{ $mitra->telepon }}">
        </div>

        <div class="mb-3">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" name="kota" value="{{ $mitra->kota }}">
        </div>

        <div class="mb-3">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" name="provinsi" value="{{ $mitra->provinsi }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi">{{ $mitra->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="logo">Logo</label>
            @if ($mitra->logo)
                <img src="{{ asset('storage/' . $mitra->logo) }}" alt="Logo" class="img-thumbnail mb-2" width="100">
            @endif
            <input type="file" class="form-control" name="logo" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection --}}
