<?php

namespace App\Providers;

use App\Utilities\Copyright;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        view()->composer('layouts.bottom', function($view){
//            $view->with('copyright', Copyright::displayNotice());
//        });

        $value = \App\Utilities\Copyright::displayNotice();
        view()->share('copyright', $value);
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
