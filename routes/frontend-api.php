<?php

// frontend-api as fe-api ^^

use App\Http\Controllers\FrontendAPI\TransactionHistoriesController;
use App\Http\Resources\WalletResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
    return (new WalletResource(Auth::user()->wallet
        ->loadMissing("owner",  "transferedTransactions.toWallet.owner", "receivedTransactions.fromWallet.owner")));
});

Route::post("transactions/sorting/oldest", [TransactionHistoriesController::class, "oldest"]);
Route::post("transactions/sorting/newest", [TransactionHistoriesController::class, "newest"]);
