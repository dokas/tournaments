<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\HeaderComposer;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(env('THEME').'/back/layout', HeaderComposer::class);
        
        Blade::if('admin', function() {
            return auth()->user()->role === 'admin';
        });
        
        Blade::if('redac', function() {
            return auth()->user()->role === 'redac';
        });

        Blade::if('request', function ($url) {
            return request()->is($url);
        });        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
