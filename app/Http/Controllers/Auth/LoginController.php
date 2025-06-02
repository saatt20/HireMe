<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect after login based on user role.
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        switch ($user->role) {
            case 'admin':
                return route('admin.lowongan.index');

            case 'mitra':
                return route('mitra.lowongan.index');

            case 'alumni':
                $alumni = $user->alumni; // pastikan relasi ini ada di model User

                // Jika belum ada data alumni atau ada field yang kosong
                if (
                    !$alumni ||
                    empty($alumni->telepon) ||
                    empty($alumni->kota) ||
                    empty($alumni->provinsi) ||
                    empty($alumni->jenis_kelamin) ||
                    empty($alumni->linkedin)
                ) {
                    return route('auth.profile_welcome');
                }

                return route('beranda');

            default:
                return '/home';
        }
    }

    /**
     * Gunakan 'username' sebagai kolom login, bukan 'email'.
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Custom login form untuk mitra/perusahaan.
     */
    public function showCompanyLoginForm()
    {
        return view('auth.login_company');
    }

    /**
     * Override untuk menangani login, menambahkan pemeriksaan status mitra
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            $user = $this->guard()->user();

            // Jika user adalah mitra dan statusnya pending atau rejected
            if ($user->role === 'mitra' && $user->status !== 'approved') {
                $this->guard()->logout();

                $message = $user->status === 'pending'
                    ? 'Akun Mitra Anda sedang menunggu persetujuan dari admin.'
                    : 'Akun Mitra Anda ditolak oleh admin.';

                throw ValidationException::withMessages([
                    $this->username() => [$message],
                ]);
            }

            return true;
        }

        return false;
    }
}
