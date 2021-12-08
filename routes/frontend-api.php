<?php

// frontend-api as fe-api ^^

use App\Http\Controllers\FrontendAPI\TransactionHistoriesController;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\WalletResource;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
    // return (new WalletResource(Auth::user()->wallet
    //     ->loadMissing("owner",  "transferedTransactions.toWallet.owner", "receivedTransactions.fromWallet.owner")));

    return;

    return now()->subMonth(03)->format("M");

    return Transaction::where("from_wallet_id", 1)
        ->orWhere("to_wallet_id", 1)->simplePaginate(12);
});

Route::get("controller", [TransactionHistoriesController::class, "filterByDateAndTransactionType"]);

Route::post("transactions/sorting/oldest", [TransactionHistoriesController::class, "oldest"]);
Route::post("transactions/sorting/newest", [TransactionHistoriesController::class, "newest"]);
