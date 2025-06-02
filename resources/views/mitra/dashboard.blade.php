<!-- resources/views/recruitment/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Rekrutmen - Lowongan: {{ $lowongan->title }}</h2>

    <!-- Tabel Daftar Pelamar -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>LinkedIn</th>
                <th>CV</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr>
                    <td>{{ $application->user->name }}</td>
                    <td>{{ $application->telepon }}</td>
                    <td>{{ $application->email }}</td>
                    <td><a href="{{ $application->linkedin }}" target="_blank">LinkedIn</a></td>
                    <td><a href="{{ asset('storage/' . $application->cv_pdf) }}" target="_blank">Download CV</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
