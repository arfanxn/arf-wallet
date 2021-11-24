<?php

use App\Http\Resources\WalletResource;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
    return (new WalletResource(\App\Models\Wallet::find(1)
        ->loadMissing("owner",  "transferedTransactions.toWallet.owner", "receivedTransactions.fromWallet.owner")));
});
