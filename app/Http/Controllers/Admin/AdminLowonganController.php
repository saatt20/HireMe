<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Storage;

class AdminLowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::where('created_by_role', 'admin')->latest()->get();
        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('admin.lowongan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'required|string',
            'skills' => 'required|string',
            'status' => 'required|in:Full-Time,Part-Time,Internship',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'deadline' => 'required|date',
            'mitra_nama' => 'required|string|max:255',
            'mitra_deskripsi' => 'nullable|string',
            'mitra_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_pendaftaran' => 'required|url',
        ]);

        // Gabungkan kota dan provinsi untuk kolom lokasi
        $lokasi = $request->kota . ', ' . $request->provinsi;

        // Simpan logo mitra jika ada
        $logoPath = null;
        if ($request->hasFile('mitra_logo')) {
            $logoPath = $request->file('mitra_logo')->store('logos', 'public');
        }

        Lowongan::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kualifikasi' => $request->kualifikasi,
            'skills' => $request->skills,
            'status' => $request->status,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'lokasi' => $lokasi, // Menambahkan lokasi
            'deadline' => $request->deadline,
            'mitra_nama' => $request->mitra_nama,
            'mitra_deskripsi' => $request->mitra_deskripsi,
            'mitra_logo' => $logoPath,
            'link_pendaftaran' => $request->link_pendaftaran,
            'created_by_role' => 'admin',
        ]);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan oleh admin');
    }

    public function show($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('admin.lowongan.show', compact('lowongan'));
    }

    public function edit($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        $lowongan = Lowongan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'required|string',
            'skills' => 'required|string',
            'status' => 'required|in:Full-Time,Part-Time,Internship',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'deadline' => 'required|date',
            'mitra_nama' => 'required|string|max:255',
            'mitra_deskripsi' => 'nullable|string',
            'mitra_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_pendaftaran' => 'required|url',
        ]);

        $lokasi = $request->kota . ', ' . $request->provinsi;

        if ($request->hasFile('mitra_logo')) {
            if ($lowongan->mitra_logo) {
                Storage::disk('public')->delete($lowongan->mitra_logo);
            }
            $lowongan->mitra_logo = $request->file('mitra_logo')->store('logos', 'public');
        }

        $lowongan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kualifikasi' => $request->kualifikasi,
            'skills' => $request->skills,
            'status' => $request->status,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'lokasi' => $lokasi,
            'deadline' => $request->deadline,
            'mitra_nama' => $request->mitra_nama,
            'mitra_deskripsi' => $request->mitra_deskripsi,
            'link_pendaftaran' => $request->link_pendaftaran,
        ]);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil diperbarui');
    }


    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        if ($lowongan->mitra_logo) {
            Storage::disk('public')->delete($lowongan->mitra_logo);
        }

        $lowongan->delete();

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil dihapus');
    }
}
