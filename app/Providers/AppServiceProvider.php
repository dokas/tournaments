<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\HeaderComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function($query) {
            //dump($query->sql);
        });

        view()->composer(env('THEME').'/back/layout', HeaderComposer::class);

        Blade::if('admin', function() {
            return auth()->user()->getRole()->name === 'administrator';
        });
        
        Blade::if('author', function() {
            return auth()->user()->getRole()->name === 'author';
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
