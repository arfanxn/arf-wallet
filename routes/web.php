<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
});


































// SIGNED URL   
Route::get("signed", function () {
    return URL::signedRoute("session", ["user" => "arfan"]);
});

// SESSION VS CACHE 
Route::get("session", function () {
    dd(request()->all());
    return view("tests.session-input");
})->middleware("signed")->name("session");

Route::post("session-post", function () {
    $input = request()->input;
    session()->put(["input" => $input]);
    dd(session()->get("input"));
})->name("session.post");

Route::get("cache", function () {
    return view("tests.cache-input");
});
Route::post("cache-post", function () {
    cache()->has("input") ? dd(cache()->get("input"))  : "";
    $input = request()->input;
    cache()->put("input", $input);
    dd(cache()->get("input"));
})->name("cache.post");

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

// USER VERIFICATION 
Route::get("user-verification",  function () {
    $user = \App\Models\User::find(1);
    $event = event(new  \Illuminate\Auth\Events\Registered($user));
    dd($event);
});

// TEST NOTIFICATION 
Route::get("notification", function () {
    \Illuminate\Support\Facades\Notification
        ::route("mail", "arfan2173@gmail.com")
        ->notify(new \App\Notifications\Wallet\TransferSuccess());
});

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
