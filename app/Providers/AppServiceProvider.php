<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);
        $guard = "";
        if(auth()->guard("web")->check()){
            $guard = "web";
        }
        else if(auth()->guard("admin")->check()){
            $guard = "admin";
        }
        view()->share("grd",$guard);

    }
}
