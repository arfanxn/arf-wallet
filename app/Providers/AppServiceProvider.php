<?php

namespace App\Providers;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("AuthWallet", function () {
            return Auth::check() ? ((Auth::user())->load("wallet"))->wallet
                : throw new Exception("Access Denied - must Login!");
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale($this->app->getLocale());
        Paginator::useBootstrap();
        // Paginator::defaultSimpleView("");

        JsonResource::withoutWrapping();
    }
}
