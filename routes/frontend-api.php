<?php

// frontend-api as fe-api ^^

use App\Http\Controllers\FrontendAPI\TransactionHistoriesController;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
});

Route::post("transaction/history/filter", [TransactionHistoriesController::class, "filterByDateAndTransactionType"]);
