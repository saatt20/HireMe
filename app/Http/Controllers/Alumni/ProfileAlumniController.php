<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileAlumniController extends Controller
{
    public function index()
    {
        $user = auth()->user();


        // Jika belum ada data alumni, buat dummy kosong
        $alumni = $user->alumni ?? (object)[
            'telepon' => '',
            'program_studi' => '',
            'angkatan' => '',
            'kota' => '',
            'provinsi' => '',
            'jenis_kelamin' => '',
            'linkedin' => '',
            'foto' => null,
            'status_kerja' => 'Sudah Bekerja', // default: Sudah Bekerja
        ];

        return view('alumni.profil', compact('user', 'alumni'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'program_studi' => 'nullable|string',
            'angkatan' => 'nullable|string|max:10',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'linkedin' => 'nullable|url|max:255',
            'foto' => 'nullable|image|max:2048', // max 2MB

        ]);

        // Update tabel users
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Ambil relasi alumni
        $alumni = $user->alumni;

        // Jika belum ada, buat baru
        if (!$alumni) {
            $alumni = $user->alumni()->create([]);
        }

        // Jika ada upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($alumni->foto) {
                Storage::disk('public')->delete($alumni->foto);
            }

            // Simpan foto baru
            $path = $request->file('foto')->store('alumni/foto', 'public');
            $alumni->foto = $path;
        }

        // Update data alumni
        $alumni->telepon = $request->telepon;
        $alumni->program_studi = $request->program_studi;
        $alumni->angkatan = $request->angkatan;
        $alumni->kota = $request->kota;
        $alumni->provinsi = $request->provinsi;
        $alumni->jenis_kelamin = $request->jenis_kelamin;
        $alumni->linkedin = $request->linkedin;
        $alumni->save();

        return redirect()->route('alumni.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateStatusKerja(Request $request)
    {
    $user = Auth::user();
    $alumni = $user->alumni;

    // Jika belum ada data alumni, buat baru
    if (!$alumni) {
        $alumni = $user->alumni()->create([
            'status_kerja' => $request->status_kerja,
        ]);
    } else {
        $alumni->status_kerja = $request->status_kerja;
        $alumni->save();
    }

    return redirect()->back()->with('success', 'Status kerja berhasil diperbarui');
    }


}
