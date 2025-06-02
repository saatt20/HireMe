<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class LamaranController extends Controller
{
    public function kirim(Request $request, Lowongan $lowongan)
    {
        $user = auth()->user();
        $alumni = $user->alumni;
        $cv = $user->cv;

        // Generate PDF dari view
        $pdf = Pdf::loadView('pdf.cv', compact('cv', 'user', 'alumni',))->output();
        $filename = 'cv-' . $user->id . '-' . time() . '.pdf';

        Storage::put('public/cv/' . $filename, $pdf);

        Lamaran::create([
            'lowongan_id' => $lowongan->id,
            'user_id' => $user->id,
            'cv_pdf' => 'cv/' . $filename,
            'telepon' => $alumni->telepon,
            'email' => $user->email,
            'linkedin' => $alumni->linkedin,
        ]);

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim!');
    }

    public function riwayat()
    {
        $lamarans = Lamaran::with(['lowongan', 'lowongan.user.mitra'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('alumni.lamaran.riwayat', compact('lamarans'));
    }

    public function showPemberitahuan($id)
    {
        $lamaran = Lamaran::with(['lowongan.mitra', 'cv'])->findOrFail($id);

        return view('alumni.lamaran.pemberitahuan', compact('lamaran'));
    }

    public function showPrint($id)
    {
        $lamaran = Lamaran::with('lowongan.user')->findOrFail($id);
        return view('alumni.lamaran.print', compact('lamaran'));
    }


}

