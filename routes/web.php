<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Transactions\SendMoneyController;
use App\Http\Controllers\Transactions\TransactionHistoryController;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("guest")->group(function () {

    Route::group(["prefix" => "register", "as" => "register.",], function () {
        Route::get("", [
            "uses" => RegisterController::class . "@create", "as" => "create"
        ]);
        Route::post("handle-create", [
            "uses" => RegisterController::class . "@handleCreate", "as" => "handleCreate"
        ]);
        Route::get("confirm-pin", [
            "uses" => RegisterController::class . "@showConfirmPin",
            "as" => "showConfirmPin"
        ]);
        Route::post("", [
            "uses" => RegisterController::class . "@store",
            "as" => "store"
        ]);
    });

    Route::group(["prefix" => "login", "as" => "login.",], function () {
        Route::get("", ["uses"  => LoginController::class . "@show", "as" => "show"]);
        Route::post("", [
            "uses" => LoginController::class . "@handlePhoneNumber", "as" => "handlePhoneNumber"
        ]);
        Route::get("insert-pin", [
            "uses" => LoginController::class . "@showInsertPin", "as" =>  "showInsertPin"
        ]);
        Route::post("handle", [
            "uses" => LoginController::class . "@handle", "as" => "handle"
        ]);
    });
});

Route::middleware("auth")->group(function () {
    Route::get('/', [HomeController::class, "index"])->name("home");

    Route::group(["prefix" => "transaction", "as" => "transaction."], function () {
        Route::get("send-money", ["uses" => SendMoneyController::class  . "@index", "as" => "send-money"]);
        Route::get("send-money/to/{address}", ["uses" => SendMoneyController::class . "@create", "as" =>  "send-money-to"]);
        Route::get("history", [
            "uses" => TransactionHistoryController::class .  "@index", "as" => "history"
        ]);
        Route::get("detail/{transaction:tx_hash}", [
            "uses" => TransactionHistoryController::class . "@show", "as" => "detail"
        ]);
    });

    Route::group(["prefix" => "account", "as" => "account."], function () {
        Route::get("", [
            "uses" => AccountController::class . "@index", "as" => "index"
        ]);
    });
});












// Test Recent Transfer Wallets
Route::get("recent-wallets", function () {
    dd(Transaction::where("from_wallet_id", 1)->get()->unique("to_wallet_id"));
});


// TEST TRANSFER 
Route::get("transfer", function () {
    dd(Wallet::transfer("LGFY0HNQ9409Z7XN", 999999, 0, "hello world"));
});

// TEST RENDER 
Route::view("test-view", "accounts.index");

// TEST MAIL 
Route::get(
    'send-mail',
    function () {
        $details = [
            'title' => "Mail from ARF-WALLET",
            'body' => 'This is for testing email using smtp'
        ];
        //  for see the html of the emails
        // return new \App\Mail\TestMail($details);
        \Illuminate\Support\Facades\Mail::to('arfan2173@gmail.com')->send(new \App\Mail\TestMail($details));
        dd("Email is Sent.");
    }
);

//  USER ONLINE 
Route::group(["prefix" => "auth"],  function () {
    Route::get("", function () {
        $users = \App\Models\User::all();
        return view("tests.user-online", compact("users"));
    });
    Route::get("logout", fn () => Auth::logout());
    Route::get("info", fn () => dd(Auth::user(), Auth::check()));
    Route::get("login", function () {
        Auth::attempt(["phone_number" => "089506089254", "password" => "111222"]);
        // dd(Auth::check());
    });
});
