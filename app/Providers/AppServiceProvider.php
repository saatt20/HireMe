<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ✅ Tambahkan baris ini
use App\Models\Lamaran;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $lamarans = Lamaran::with('lowongan.user.mitra.user')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->take(1)
                    ->get();

                $view->with('lamaransTerbaru', $lamarans);

            }
        });
    }
}
