<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MitraRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('mitra.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'nama_perusahaan' => 'required|string|max:255',
                'telepon' => 'required|string|max:15',
                'email' => 'required|string|email|max:255|unique:users',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'kota' => 'nullable|string|max:255',
                'provinsi' => 'nullable|string|max:255',
            ],
            [
                'email.unique' => 'Email sudah digunakan',
                'username.unique' => 'Username sudah digunakan',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ],
        );



        User::create([
            'name' => $request->nama_perusahaan,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mitra',
            'status' => 'pending', // Status awal mitra adalah pending
        ]);
        $user = User::where('email', $request->email)->first();

        Mitra::create([
            'user_id' => $user->id,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'telepon' => $request->telepon,
            // 'deskripsi' => $request->deskripsi,
            // 'logo' => $request->logo, // Pastikan ini adalah path yang benar
            'nama_perusahaan' => $request->nama_perusahaan,
        ]);
        return redirect()->route('company.login')->with('success', 'Registrasi berhasil, silakan tunggu konfirmasi dari admin.');
    }
}
