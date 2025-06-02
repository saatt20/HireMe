<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alumni;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::with('user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        $alumnis = $query->get();

        return view('admin.alumni.index', compact('alumnis'));
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        // Hapus user juga jika ingin:
        if ($alumni->user) {
            $alumni->user->delete();
        }

        $alumni->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil dihapus.');
    }


}
