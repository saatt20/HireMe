<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Carbon\Carbon;

class OnboardingController extends Controller
{
    /**
     * Menampilkan halaman onboarding dengan 3 lowongan terbaru
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil 3 lowongan terbaru yang belum melewati deadline
        $latestLowongans = Lowongan::where(function($query) {
                // Jika deadline ada, cek apakah belum lewat
                $query->whereNull('deadline')
                      ->orWhere('deadline', '>=', Carbon::now());
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal dibuat terbaru
            ->limit(3) // Ambil hanya 3 lowongan
            ->get();

        return view('onboarding', compact('latestLowongans'));
    }
}
