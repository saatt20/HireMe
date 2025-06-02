<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;

class CVController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $alumni = $user->alumni;

        // Cek apakah profil alumni sudah lengkap
        $isProfileComplete = $this->checkProfileCompleteness($alumni);
        // Ambil 1 CV milik user yang sudah ada
        $cv = CV::where('user_id', $user->id)->first();

        return view('alumni.cv.index', compact('user', 'alumni', 'cv', 'isProfileComplete'));
    }

    public function create()
    {
        $user = auth()->user();
        $alumni = $user->alumni;

        // Cek apakah profil alumni sudah lengkap
        $isProfileComplete = $this->checkProfileCompleteness($alumni);
        // ambil data alumni berdasarkan user login
        $cv = CV::where('user_id', $user->id)->first();

        return view('alumni.cv.create', compact('user', 'alumni', 'cv', 'isProfileComplete'));
    }

    private function checkProfileCompleteness($alumni)
    {
        $requiredFields = ['telepon', 'linkedin', 'kota', 'provinsi'];
        $isComplete = true;

        foreach ($requiredFields as $field) {
            if (empty($alumni->$field)) {
                $isComplete = false;
                break;
            }
        }

        return $isComplete;
    }

    public function store(Request $request)
    {
        $request->validate([
            'tentang_saya' => 'required|string',
            'skill' => 'nullable|string',
        ]);

        // Debugging - Uncomment jika perlu
        // dd($request->all());

        // Proses data pendidikan dari form
        // Proses data pendidikan dari form
        $riwayat_pendidikan = [];
        if ($request->filled('riwayat_pendidikan')) {
            foreach ($request->riwayat_pendidikan as $item) {
                // Filter data kosong
                if (!empty($item['nama_sekolah'])) {
                    $riwayat_pendidikan[] = [
                        'tingkat' => $item['tingkat'] ?? null,
                        'jurusan' => $item['jurusan'] ?? null,
                        'nama_sekolah' => $item['nama_sekolah'] ?? null,
                        'tahun_mulai' => $item['tahun_mulai'] ?? null,
                        'tahun_lulus' => $item['tahun_lulus'] ?? null,
                        'lokasi' => $item['lokasi'] ?? null,
                        'info_tambahan' => $item['info_tambahan'] ?? null,
                    ];
                }
            }
        }

        // Proses data pengalaman kerja
        $pengalaman_kerja = [];
        if ($request->filled('pengalaman_kerja')) {
            foreach ($request->pengalaman_kerja as $item) {
                // Filter data kosong
                if (!empty($item['nama_perusahaan'])) {
                    $pengalaman_kerja[] = [
                        'nama_perusahaan' => $item['nama_perusahaan'] ?? null,
                        'posisi' => $item['posisi'] ?? null,
                        'tahun_mulai' => $item['tahun_mulai'] ?? null,
                        'tahun_selesai' => $item['tahun_selesai'] ?? null,
                        'lokasi' => $item['lokasi'] ?? null,
                        'info_tambahan' => $item['info_tambahan'] ?? null,
                    ];
                }
            }
        }

        // Proses data organisasi
        $pengalaman_organisasi = [];
        if ($request->filled('pengalaman_organisasi')) {
            foreach ($request->pengalaman_organisasi as $item) {
                // Filter data kosong
                if (!empty($item['nama_organisasi'])) {
                    $pengalaman_organisasi[] = [
                        'nama_organisasi' => $item['nama_organisasi'] ?? null,
                        'posisi' => $item['posisi'] ?? null,
                        'tahun_mulai' => $item['tahun_mulai'] ?? null,
                        'tahun_selesai' => $item['tahun_selesai'] ?? null,
                        'lokasi' => $item['lokasi'] ?? null,
                        'info_tambahan' => $item['info_tambahan'] ?? null,
                    ];
                }
            }
        }

        // Proses data penghargaan
        $penghargaan = [];
        if ($request->filled('penghargaan')) {
            foreach ($request->penghargaan as $item) {
                // Filter data kosong
                if (!empty($item['judul'])) {
                    $penghargaan[] = [
                        'judul' => $item['judul'] ?? null,
                        'penyelenggara' => $item['penyelenggara'] ?? null,
                        'tahun' => $item['tahun'] ?? null,
                        'lokasi' => $item['lokasi'] ?? null,
                        'info_tambahan' => $item['info_tambahan'] ?? null,
                    ];
                }
            }
        }

        // Konversi ke JSON
        // $riwayat_pendidikanJson = !empty($riwayat_pendidikan) ? json_encode($riwayat_pendidikan) : null;
        // $pengalaman_kerjaJson = !empty($pengalaman_kerja) ? json_encode($pengalaman_kerja) : null;
        // $pengalaman_organisasiJson = !empty($pengalaman_organisasi) ? json_encode($pengalaman_organisasi) : null;
        // $penghargaanJson = !empty($penghargaan) ? json_encode($penghargaan) : null;

        $data = [
            'tentang_saya' => $request->tentang_saya,
            'skill' => $request->skill,
            'riwayat_pendidikan' => $riwayat_pendidikan,
            'pengalaman_kerja' => $pengalaman_kerja,
            'pengalaman_organisasi' => $pengalaman_organisasi,
            'penghargaan' => $penghargaan,
        ];

        $userId = Auth::id();
        $cv = CV::where('user_id', $userId)->first();

        if ($cv) {
            $cv->update($data);
            $message = 'CV berhasil diperbarui!';
        } else {
            $data['user_id'] = $userId;
            CV::create($data);
            $message = 'CV berhasil disimpan!';
        }

        return redirect()->route('alumni.cv.index')->with('success', $message);
    }

    public function preview()
    {
        $user = auth()->user();
        $alumni = $user->alumni;
        $cv = CV::where('user_id', $user->id)->first();

        return view('alumni.cv.partials.cv-preview', compact('user', 'alumni', 'cv'));
    }
}
