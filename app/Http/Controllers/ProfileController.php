<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function showProfileForm()
    {
        $user = auth()->user();

        // Cek apakah profil sudah ada
        $profile = $user->profile;

        // Jika belum ada, buat profil kosong
        if (!$profile) {
            $profile = new Profile();
        }

        return view('auth.profile_welcome', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validasi data profil
        $request->validate([
            'phone_number' => 'required|string',
            'gender' => 'required|string',
            'linkedin' => 'nullable|string',
            'photo' => 'nullable|image',
            'company_description' => 'nullable|string',
            'company_email' => 'nullable|email',
            'company_phone' => 'nullable|string',
            'company_logo' => 'nullable|image',
        ]);

        // Menyimpan atau memperbarui profil pengguna
        $profile = $user->profile ?? new Profile();

        $profile->user_id = $user->id;
        $profile->phone_number = $request->phone_number;
        $profile->gender = $request->gender;
        $profile->linkedin = $request->linkedin;
        $profile->address = $request->address;
        $profile->provinsi = $request->provinsi;
        $profile->kota = $request->kota;

        if ($request->hasFile('photo')) {
            // Simpan foto dan ambil path-nya
            $profile->photo = $request->file('photo')->store('profile_photos');
        }

        // Kolom untuk mitra
        $profile->company_description = $request->company_description;
        $profile->company_email = $request->company_email;
        $profile->company_phone = $request->company_phone;

        if ($request->hasFile('company_logo')) {
            // Simpan logo perusahaan dan ambil path-nya
            $profile->company_logo = $request->file('company_logo')->store('company_logos');
        }

        $profile->save();

        // Redirect ke halaman lain setelah sukses
        return redirect('/home');
    }
}
