<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
        Route::get("", ["uses" => RegisterController::class . "@create", "as" => "create"]);
        Route::post("confirm_pin", ["uses" => RegisterController::class . "@confirmPin", "as" => "confirmPin"]);
        Route::post("", ["uses" => RegisterController::class . "@store", "as" => "store"]);
    });

    Route::group(["prefix" => "login", "as" => "login.",], function () {
        Route::get("", ["uses"  => LoginController::class . "@show", "as" => "show"]);
        Route::post("", ["uses" => LoginController::class . "@handlePhoneNumber", "as" => "handlePhoneNumber"]);
        Route::get("insert_pin", ["uses" => LoginController::class . "@showInsertPin", "as" => "showInsertPin"]);
        Route::post("handle", ["uses" => LoginController::class . "@handle", "as" => "handle"]);
    });
});

Route::middleware("auth")->group(function () {
    Route::get('/', [HomeController::class, "index"])->name("home");
});












// TEST MAIL 
Route::get(
    'send-mail',
    function () {
        $details = [
            'title' => "Mail from ARF-WALLET",
            'body' => 'This is for testing email using smtp'
        ];
        
        \Illuminate\Support\Facades\Mail::to('arfan2173@gmail.com')->send(new \App\Mail\TestMail($details));
        dd("Email is Sent.");
    }
);

//  USER ONLINE 
Route::group(["prefix" => "auth"],  function () {
    Route::get("", function () {
        $users = \App\Models\User::all();
        return view("user-online", compact("users"));
    });
    Route::get("logout", fn () => Auth::logout());
    Route::get("info", fn () => dd(Auth::user(), Auth::check()));
    Route::get("login", function () {
        Auth::attempt(["phone_number" => "089506089254", "password" => "111222"]);
        // dd(Auth::check());
    });
});
