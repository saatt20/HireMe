<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Lowongan;
use App\Models\Lamaran;

class RekrutmenController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::withCount('lamarans') // asumsi ada relasi 'lamarans'
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('mitra.rekrutmen.index', compact('lowongans'));
    }

    public function show($id)
    {
        $lowongan = Lowongan::with('lamarans.alumni.user', 'lamarans.cv')->findOrFail($id);
        return view('mitra.rekrutmen.detail', compact('lowongan'));
    }


    public function terima($id)
    {
        $lamaran = Lamaran::with('lowongan.user')->findOrFail($id);

        $mitra = $lamaran->lowongan->user; // user = mitra
        $pesan = "Setelah melalui proses seleksi administrasi dan evaluasi berkas, dengan ini kami menyampaikan bahwa Anda dinyatakan Lolos Seleksi Berkas.
            Besar harapan Kami untuk Anda bisa melanjutkan ke tahap berikutnya. Informasi lebih lanjut terkait jadwal dan teknis pelaksanaan tahap selanjutnya
            akan kami sampaikan setelah menerima konfirmasi dari Anda. Konfirmasi melalui Human Resources Department dengan melampirkan cetak bukti surat pernyataan
            Lolos Seleksi ke E-mail {$mitra->email}.";

        // Memperbarui status dan pesan notifikasi
        $lamaran->update([
            'status' => 'diterima',
            'pesan_notifikasi' => $pesan,
        ]);

        return redirect()->back()->with('success', 'Lamaran diterima dan notifikasi dikirim.');
    }


    public function tolak($id)
    {
        $lamaran = \App\Models\Lamaran::findOrFail($id);
        $lamaran->status = 'ditolak';
        $lamaran->save();

        return back()->with('success', 'Lamaran ditolak.');
    }

}

