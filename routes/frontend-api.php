<?php

// frontend-api as fe-api ^^

use App\Http\Controllers\FrontendAPI\LoadIncomeAndExpenseThisMonthFromAuthWalletController;
use App\Http\Controllers\FrontendAPI\SearchWalletsController;
use App\Http\Controllers\FrontendAPI\TransactionHistoriesController;
use App\Http\Controllers\FrontendAPI\PinConfirmationController;
use App\Http\Controllers\FrontendAPI\ProcessChangeEmailController;
use App\Http\Controllers\FrontendAPI\ProcessChangeFullnameController;
use App\Http\Controllers\FrontendAPI\ProcessChangePINController;
use App\Http\Controllers\FrontendAPI\VerificationCodeController;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
});

Route::post("verify-verification-code-by-email", [VerificationCodeController::class, "verifyByEmail"]);

Route::post("send-verification-code-by-email", [VerificationCodeController::class, "sendByEmail"])->middleware("throttle:1,1");

Route::middleware("auth")->group(function () {

    Route::post("pin-confirmation", PinConfirmationController::class)->name("confirm-pin.handle");


    Route::post("transaction/history/filter", [TransactionHistoriesController::class, "filterByDateAndTransactionType"]);


    Route::post("wallet/search-by-address", [SearchWalletsController::class, "searchByAddressExceptSelf"]);


    Route::post("account/load-income-and-expense-this-month-from-auth-wallet", LoadIncomeAndExpenseThisMonthFromAuthWalletController::class);


    Route::post("account/setting/process-change-pin", ProcessChangePINController::class);
    Route::post("account/setting/validateEmail", [ProcessChangeEmailController::class, "validateEmail"]);
    Route::put("account/setting/process-change-email", [ProcessChangeEmailController::class, "handle"]);
    Route::put("account/setting/process-change-fullname", ProcessChangeFullnameController::class);
});
