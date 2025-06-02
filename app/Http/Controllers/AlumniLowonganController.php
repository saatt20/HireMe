<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

class AlumniLowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lowongan::query()->with('user.mitra');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', "%{$request->keyword}%")
                  ->orWhere('skills', 'like', "%{$request->keyword}%")
                  ->orWhereHas('user', function ($q2) use ($request) {
                      $q2->where('name', 'like', "%{$request->keyword}%");
                  });
            });
        }

        if ($request->filled('lokasi')) {
            $query->whereRaw("CONCAT(kota, ', ', provinsi) LIKE ?", ["%{$request->lokasi}%"]);
        }

        $lowongans = $query->latest()->get();

        $lokasiList = Lowongan::selectRaw("CONCAT(kota, ', ', provinsi) AS lokasi")
            ->distinct()->pluck('lokasi');

        return view('alumni.lowongan.index', compact('lowongans', 'lokasiList'));
    }

    public function show($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        // Ambil data user yang sedang login
        $user = auth()->user();
        $alumni = $user->alumni;

        // Cek apakah user memiliki CV
        $cv = \App\Models\CV::where('user_id', $user->id)->first();
        $hasCV = !is_null($cv);

        return view('alumni.lowongan.show', compact('lowongan', 'user', 'alumni', 'cv', 'hasCV'));
    }

}
