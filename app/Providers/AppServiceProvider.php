<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\MobileNavLink;
use App\View\Components\NavLink;
use Illuminate\Support\Facades\Gate;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Keuangan;
use App\Policies\MahasiswaPolicy;
use App\Policies\DosenPolicy;
use App\Policies\KeuanganPolicy;
use App\Observers\MahasiswaObserver;

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
    public function boot(): void
    {
        Mahasiswa::observe(MahasiswaObserver::class);
        Blade::component('mobile-nav-link', MobileNavLink::class);
        Blade::component('nav-link', NavLink::class);
        // Register policies
        Gate::policy(Mahasiswa::class, MahasiswaPolicy::class);
        Gate::policy(Dosen::class, DosenPolicy::class);
        Gate::policy(Keuangan::class, KeuanganPolicy::class);

        // Define admin access gate
        Gate::define('admin-access', function ($user) {
            return $user->role === 'admin';
        });
    }
}