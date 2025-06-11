<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ManajemenMenu as Menu;
use App\Models\Admin\ManajemenModul as Modul;

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
        View::composer('*', function ($view) {
            $view->with('publicMenus', Menu::where('isActive', '1')->orderBy('order')->get());

            if (Auth::check()) {
                $role = Auth::user()->role;
                $dashboardModuls = Modul::where('isActive', '1')
                    ->where(function ($q) use ($role) {
                        $q->whereNull('role')
                        ->orWhere('role', 'like', "%$role%");
                    })
                    ->whereNull('parent_id')
                    ->with('children.children.children')
                    ->orderBy('order')
                    ->get();

                $view->with('dashboardModuls', $dashboardModuls);
            }
        });
    }
}
