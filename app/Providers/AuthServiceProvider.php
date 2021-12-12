<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("show-transaction-detail", function (User $user, \App\Models\Transaction $transaction) {
            $userWalletId =  $user->wallet->id;
            return  $userWalletId == $transaction->from_wallet_id
                || $userWalletId == $transaction->to_wallet_id;
        });
        //
    }
}
