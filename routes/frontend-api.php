<?php

// frontend-api as fe-api ^^

use App\Http\Controllers\FrontendAPI\SearchWalletsController;
use App\Http\Controllers\FrontendAPI\TransactionHistoriesController;
use App\Http\Controllers\FrontendAPI\PinConfirmationController;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
});

Route::middleware("auth")->group(function () {
    
    Route::post("pin-confirmation", PinConfirmationController::class)->name("confirm-pin.handle");

    Route::post("transaction/history/filter", [TransactionHistoriesController::class, "filterByDateAndTransactionType"]);

    Route::post("wallet/search-by-address", [SearchWalletsController::class, "searchByAddressExceptSelf"]);
});
