@extends('layouts.onboarding')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Gambar kosong profil -->
            <img src="{{ asset('images/file.png') }}" alt="Empty Profile" class="img-fluid" style="max-width: 200px; margin-bottom: 20px;">

            <!-- Headline -->
            <h3 class="fw-bold">Profil Anda Belum Lengkap</h3>

            <!-- Paragraf pengantar -->
            <p>Silakan lengkapi informasi yang dibutuhkan untuk melanjutkan ke proses lamaran.</p>

            <!-- Tautan Edit Profil -->
            <a href="{{ route('alumni.profil') }}" class="fw-bold" style="color: red; text-decoration: none;">
                Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
