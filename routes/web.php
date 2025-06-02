<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Mitra\LowonganController;
use App\Http\Controllers\AlumniLowonganController;
use App\Http\Controllers\Admin\MitraController as AdminMitraController;
use App\Http\Controllers\Admin\AdminLowonganController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Alumni\ProfileAlumniController;
use App\Http\Controllers\Mitra\ProfileMitraController;
use App\Http\Controllers\Alumni\CVController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Alumni\LamaranController;
use App\Http\Controllers\Mitra\RecruitmentController;
use App\Http\Controllers\Mitra\RekrutmenController;
use App\Http\Controllers\Auth\MitraRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\OnBoardingController;


// Halaman form input email
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Proses kirim email reset password
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Halaman form reset password (dari link email)
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Proses reset password
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
// ==================== HALAMAN UTAMA ====================
Route::get('/', fn() => view('landing'))->name('landing');

Auth::routes();
Route::get('login/company', [LoginController::class, 'showCompanyLoginForm'])->name('company.login');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==================== CUSTOM REGISTER ====================
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Routes untuk mitra
    Route::get('/register/mitra', [MitraRegisterController::class, 'showRegistrationForm'])->name('register.mitra');
    Route::post('/register/mitra', [MitraRegisterController::class, 'register'])->name('register.mitra.submit');
// ==================== LOGOUT ====================
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('landing');
})->name('logout');

// ==================== HALAMAN UMUM ====================
// Route::get('/beranda', fn() => view('onboarding'))->name('beranda');
// Route::get('/beranda', [App\Http\Controllers\OnboardingController::class, 'index'])->name('beranda');
Route::get('/beranda', function() {
    // Mengambil 3 lowongan terbaru yang belum melewati deadline
    $latestLowongans = \App\Models\Lowongan::where(function($query) {
            // Jika deadline ada, cek apakah belum lewat
            $query->whereNull('deadline')
                  ->orWhere('deadline', '>=', \Carbon\Carbon::now());
        })
        ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal dibuat terbaru
        ->limit(3) // Ambil hanya 3 lowongan
        ->get();

    return view('onboarding', compact('latestLowongans'));
})->name('beranda');

// ==================== PROFILE ALUMNI ====================
Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::get('/alumni/profil', [ProfileAlumniController::class, 'index'])->name('alumni.profil');
    Route::put('/alumni/profil', [ProfileAlumniController::class, 'update'])->name('alumni.profil.update');
});
Route::put('/alumni/status-kerja/update', [ProfileAlumniController::class, 'updateStatusKerja'])->name('alumni.status-kerja.update');

// ==================== PROFILE WELCOME (Umum) ====================
Route::get('/profile_welcome', [ProfileController::class, 'showProfileForm'])->name('auth.profile_welcome');
Route::post('/profile_welcome', [ProfileController::class, 'updateProfile'])->name('auth.profile_welcome.submit');

// ==================== DASHBOARD ADMIN ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminMitraController::class, 'index'])->name('dashboard');

    // Mitra Management
    Route::get('/daftar-mitra', [AdminMitraController::class, 'index'])->name('daftarMitra');
    Route::get('/create-mitra', [AdminMitraController::class, 'create'])->name('mitra.create');
    Route::post('/create-mitra', [AdminMitraController::class, 'store'])->name('mitra.store');
    Route::get('/edit-mitra/{id}', [AdminMitraController::class, 'edit'])->name('editMitra');
    Route::delete('/delete-mitra/{id}', [AdminMitraController::class, 'destroy'])->name('deleteMitra');
    // Approve / Tolak Mitra
    Route::put('/mitra/{id}/approve', [AdminMitraController::class, 'approve'])->name('admin.mitra.approve');
    Route::put('/mitra/{id}/reject', [AdminMitraController::class, 'reject'])->name('admin.mitra.reject');

    // Alumni Management
    Route::get('/daftar-alumni', [AlumniController::class, 'index'])->name('alumni.index');
    Route::delete('/delete-alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');

    // Lowongan Management
    Route::resource('lowongan', AdminLowonganController::class);
    Route::get('/admin/lowongan', [AdminLowonganController::class, 'index'])->name('admin.lowongan.index');
    Route::get('/admin/lowongan/create', [AdminLowonganController::class, 'create'])->name('admin.lowongan.create');
    Route::post('/admin/lowongan', [AdminLowonganController::class, 'store'])->name('admin.lowongan.store');
    Route::get('/admin/lowongan/{id}', [AdminLowonganController::class, 'show'])->name('admin.lowongan.show');
    Route::get('/admin/lowongan/{id}/edit', [AdminLowonganController::class, 'edit'])->name('admin.lowongan.edit');
    Route::put('/admin/lowongan/{id}', [AdminLowonganController::class, 'update'])->name('admin.lowongan.update');
    Route::delete('/admin/lowongan/{id}', [AdminLowonganController::class, 'destroy'])->name('admin.lowongan.destroy');


Route::get('/mitra', [AdminMitraController::class, 'index'])->name('admin.mitra.index');
    Route::put('/mitra/{id}/status', [AdminMitraController::class, 'updateStatus'])->name('mitra.status');
    Route::delete('/mitra/{id}', [AdminMitraController::class, 'destroy'])->name('mitra.destroy');
});

// ==================== DASHBOARD MITRA ====================
Route::middleware(['auth', 'role:mitra'])->group(function () {
    Route::get('/mitra/dashboard', fn() => redirect()->route('mitra.lowongan.index'))->name('mitra.dashboard');
    // Route::resource('mitra/lowongan', LowonganController::class);
    Route::get('/mitra/lowongan', [LowonganController::class, 'index'])->name('mitra.lowongan.index');
    Route::get('/mitra/lowongan/create', [LowonganController::class, 'create'])->name('mitra.lowongan.create');
    Route::post('/mitra/lowongan', [LowonganController::class, 'store'])->name('mitra.lowongan.store');
    Route::get('/mitra/lowongan/{id}', [LowonganController::class, 'show'])->name('mitra.lowongan.show');
    Route::get('/mitra/lowongan/{id}/edit', [LowonganController::class, 'edit'])->name('mitra.lowongan.edit');
    Route::put('/mitra/lowongan/{id}', [LowonganController::class, 'update'])->name('mitra.lowongan.update');
    Route::delete('/mitra/lowongan/{id}', [LowonganController::class, 'destroy'])->name('mitra.lowongan.destroy');


    Route::get('/mitra/profil', [ProfileMitraController::class, 'index'])->name('mitra.profil');
    Route::put('/mitra/profil', [ProfileMitraController::class, 'update'])->name('mitra.profil.update');
    Route::prefix('mitra')->middleware('auth')->group(function () {
    Route::get('/rekrutmen', [RekrutmenController::class, 'index'])->name('mitra.rekrutmen.index');
    Route::get('/rekrutmen/{id}', [RekrutmenController::class, 'show'])->name('mitra.rekrutmen.show');
    Route::post('/rekrutmen/{id}/terima', [RekrutmenController::class, 'terima'])->name('mitra.rekrutmen.terima');
    Route::post('/rekrutmen/{id}/tolak', [RekrutmenController::class, 'tolak'])->name('mitra.rekrutmen.tolak');
});



});

// ==================== LOWONGAN UNTUK ALUMNI ====================
Route::get('/alumni/lowongan', [AlumniLowonganController::class, 'index'])->name('alumni.lowongan.index');
Route::get('/alumni/lowongan/{id}', [AlumniLowonganController::class, 'show'])->name('alumni.lowongan.show');
// Route::post('/lamaran/kirim/{lowongan}', [App\Http\Controllers\LamaranController::class, 'kirim'])->name('lamaran.kirim');

Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::post('/lamaran/kirim/{lowongan}', [LamaranController::class, 'kirim'])->name('lamaran.kirim');
});
Route::middleware(['auth', 'alumni'])->group(function () {
    Route::get('/alumni/riwayat-lamaran', [App\Http\Controllers\Alumni\LamaranController::class, 'riwayat'])->name('alumni.riwayat');
});

Route::get('/lamaran/{id}/pemberitahuan', [App\Http\Controllers\Alumni\LamaranController::class, 'showPemberitahuan'])->name('lamaran.pemberitahuan');
Route::get('/lamaran/{id}/print', [App\Http\Controllers\Alumni\LamaranController::class, 'showPrint'])->name('lamaran.print');

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CV;
use App\Models\User;
use App\Models\Alumni;

Route::get('/test-pdf', function () {
    $user = User::first(); // pastikan user ada
    if (!$user) {
        abort(404, 'User tidak ditemukan');
    }

    $alumni = $user->alumni; // pakai relasi
    $cv = $user->cv; // pakai relasi

    if (!$alumni || !$cv) {
        abort(404, 'Data CV atau Alumni tidak ditemukan');
    }

    $pdf = Pdf::loadView('pdf.cv', compact('cv', 'user', 'alumni'));
    return $pdf->download('test_cv.pdf');
});

// ==================== CV UNTUK ALUMNI ====================
Route::get('/alumni/cv', [CVController::class, 'index'])->name('alumni.cv.index');
Route::get('/alumni/cv/create', [CVController::class, 'create'])->name('alumni.cv.create');
Route::post('/alumni/cv', [CVController::class, 'store'])->name('alumni.cv.store');
Route::get('/alumni/cv/preview', [CVController::class, 'preview'])->name('alumni.cv.preview');
