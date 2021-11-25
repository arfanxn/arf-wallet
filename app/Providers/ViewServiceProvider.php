<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //  VIEW COMPOSER AUTH WALLET 
        View::composer(["components.navbar-top", "home", "transactions.index", "accounts.index", "components.modal.wallet-info"], function ($view) {
            $view->with("authWallet", Auth::user()->wallet);
        });
    }
}
