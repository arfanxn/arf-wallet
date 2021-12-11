<?php

// frontend-api as fe-api ^^

use App\Http\Controllers\FrontendAPI\TransactionHistoriesController;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\WalletResource;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
});

Route::post("transaction/history/filter", [TransactionHistoriesController::class, "filterByDateAndTransactionType"]);
