<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mitra;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileMitraController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mitra = Mitra::where('user_id', $user->id)->firstOrFail();

        return view('mitra.profil', compact('user', 'mitra'));
    }

    public function update(Request $request)
    {
        // Debug: Log request data
        Log::info('Update request data:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $mitra = Mitra::where('user_id', $user->id)->firstOrFail();

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Prepare data untuk update mitra
        $mitraData = [
            'telepon' => $request->telepon,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'deskripsi' => $request->deskripsi,
        ];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            Log::info('Logo file detected');

            $file = $request->file('logo');

            // Validasi file
            if ($file->isValid()) {
                // Hapus logo lama jika ada
                if ($mitra->logo && Storage::disk('public')->exists($mitra->logo)) {
                    Storage::disk('public')->delete($mitra->logo);
                    Log::info('Old logo deleted: ' . $mitra->logo);
                }

                // Simpan logo baru
                $path = $file->store('mitra/logos', 'public');
                $mitraData['logo'] = $path;

                Log::info('New logo saved: ' . $path);
            } else {
                Log::error('Logo file is not valid');
                return redirect()->back()->with('error', 'File logo tidak valid.');
            }
        }

        // Update mitra data
        $mitra->update($mitraData);

        Log::info('Mitra updated successfully');

        return redirect()->route('mitra.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
