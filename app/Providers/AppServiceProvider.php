<?php

namespace App\Providers;

use Laravel\Passport\Passport;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Menu;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        /*View::composer("layouts.menu", function ($view) {
            $menus = Menu::getMenu(true);
            
            $view->with('menus', $menus);
        });
        View::share('layouts');*/
        
        if(env('FORCE_HTTPS',false)) { 
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                URL::forceScheme('http');
            } else if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
                URL::forceScheme('https');
            }
        }


        View::composer("layouts.menu", function ($view) {
            $menus = Menu::getMenu(true);
            $view->with('menusComposer', $menus);
        });
        View::share('layouts');

        Passport::routes(); 
    }
}
