<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lowongan;
use Carbon\Carbon;

class LowonganController extends Controller
{
    // Menampilkan daftar lowongan
    public function index()
    {
        $user = Auth::user();
        $lowongans = Lowongan::where('user_id', auth()->id())
                        ->orderBy('deadline', 'asc')
                        ->get();

        return view('mitra.lowongan.index', compact('lowongans'));
    }

    // Menampilkan form untuk menambah lowongan
    public function create()
    {
        return view('mitra.lowongan.create');
    }

    // Menyimpan data lowongan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'required|string',
            'skills' => 'required|string',
            'status' => 'required|in:Full-Time,Part-Time,Internship',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'deadline' => 'required|date',
            'gaji_min' => 'nullable|string|max:50',
            'gaji_max' => 'nullable|string|max:50',
        ]);

        // Format gaji jika ada
        $gaji_min = $request->gaji_min ? $request->gaji_min . ' Juta' : null;
        $gaji_max = $request->gaji_max ? $request->gaji_max . ' Juta' : null;

        // Simpan data ke database
        $lowongan = new Lowongan();
        $lowongan->user_id = Auth::id();
        $lowongan->judul = $request->judul;
        $lowongan->deskripsi = $request->deskripsi;
        $lowongan->kualifikasi = $request->kualifikasi;
        $lowongan->skills = $request->skills;
        $lowongan->status = $request->status;
        $lowongan->kota = $request->kota;
        $lowongan->provinsi = $request->provinsi;
        $lowongan->lokasi = $request->kota . ', ' . $request->provinsi;
        $lowongan->gaji_min = $gaji_min;
        $lowongan->gaji_max = $gaji_max;
        $lowongan->deadline = $request->deadline;
        $lowongan->save();

        return redirect()->route('mitra.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        // Remove 'Juta' from gaji fields for display in the edit form
        if ($lowongan->gaji_min) {
            $lowongan->gaji_min = str_replace(' Juta', '', $lowongan->gaji_min);
        }

        if ($lowongan->gaji_max) {
            $lowongan->gaji_max = str_replace(' Juta', '', $lowongan->gaji_max);
        }

        return view('mitra.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input yang diterima dari form
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'required|string',
            'skills' => 'required|string',
            'status' => 'required|in:Full-Time,Part-Time,Internship',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'deadline' => 'required|date',
            'gaji_min' => 'nullable|string|max:50',
            'gaji_max' => 'nullable|string|max:50',
        ]);

        // Format gaji jika ada
        $gaji_min = $request->gaji_min ? $request->gaji_min . ' Juta' : null;
        $gaji_max = $request->gaji_max ? $request->gaji_max . ' Juta' : null;

        // Cari lowongan berdasarkan ID
        $lowongan = Lowongan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Update data lowongan
        $lowongan->judul = $request->judul;
        $lowongan->deskripsi = $request->deskripsi;
        $lowongan->kualifikasi = $request->kualifikasi;
        $lowongan->skills = $request->skills;
        $lowongan->status = $request->status;
        $lowongan->kota = $request->kota;
        $lowongan->provinsi = $request->provinsi;
        $lowongan->lokasi = $request->kota . ', ' . $request->provinsi;
        $lowongan->deadline = $request->deadline;

        // Perbarui gaji_min dan gaji_max
        $lowongan->gaji_min = $gaji_min;
        $lowongan->gaji_max = $gaji_max;

        // Simpan perubahan pada database
        $lowongan->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('mitra.lowongan.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    // Menghapus lowongan
    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('mitra.lowongan.index')->with('success', 'Lowongan berhasil dihapus');
    }

    public function show($id)
    {
        $lowongan = Lowongan::with('lamarans.alumni')->findOrFail($id);
        return view('mitra.rekrutmen.detail', compact('lowongan'));
    }
}
