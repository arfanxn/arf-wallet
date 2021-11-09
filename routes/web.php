<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
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

Route::get("register", [RegisterController::class, "create"])->name("register.create");
Route::post("register/confirm_pin", [RegisterController::class, "confirmPin"])
    ->name("register.confirmPin");
Route::post("register", [RegisterController::class, "store"])->name("register.store");

Route::get("login", [LoginController::class, "show"])->name("login.show");
Route::post("login", [LoginController::class, "handlePhoneNumber"])->name("login.handlePhoneNumber");

Route::get('/home', function () {
    return view('home');
});

Route::get("user_online", [UserController::class, "index"]);
