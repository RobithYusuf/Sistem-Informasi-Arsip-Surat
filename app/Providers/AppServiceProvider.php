<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

   

        View::composer('layouts.sidebar', function ($view) {
            $menus = [];

            if (Auth::check()) {
                $role = Auth::user()->role;
                $menus = $role->menus; // Mengambil menu berdasarkan relasi yang telah Anda buat di model Role
            }

            $view->with('menus', $menus);
        });
    }
}
