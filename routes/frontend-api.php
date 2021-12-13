<?php

// frontend-api as fe-api ^^

use App\Http\Controllers\FrontendAPI\SearchWalletsController;
use App\Http\Controllers\FrontendAPI\TransactionHistoriesController;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
});

Route::post("transaction/history/filter", [TransactionHistoriesController::class, "filterByDateAndTransactionType"]);

Route::post("wallet/search-by-address", [SearchWalletsController::class, "searchByAddressExceptSelf"]);
