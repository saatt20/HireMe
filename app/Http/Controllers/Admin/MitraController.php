<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Constructor untuk memastikan hanya admin yang bisa mengakses controller ini
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Menampilkan daftar semua mitra beserta statusnya
     */
    public function index()
    {
        $mitras = User::where('role', 'mitra')
            ->with('mitra')
            ->get();

        return view('admin.kelola-mitra', compact('mitras'));
    }

    /**
     * Mengubah status mitra (approve/reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $user = User::findOrFail($id);

        if ($user->role !== 'mitra') {
            return back()->with('error', 'User bukan mitra.');
        }

        $user->status = $request->status;
        $user->save();

        $statusText = $request->status === 'approved' ? 'diterima' : 'ditolak';

        return back()->with('success', "Mitra berhasil $statusText.");
    }

    /**
     * Menghapus mitra
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'mitra') {
            return back()->with('error', 'User bukan mitra.');
        }

        $user->delete();

        return back()->with('success', 'Mitra berhasil dihapus.');
    }
}
