<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function show()
    {
        Session::forget("phone_number");
        return view("auth.login");
    }

    public function handleEmail(Request $request)
    {
        $request->validate([
            "email" => ["required", "email"],
        ]);

        Session::put(["email" => $request->email]);

        if (!User::where("email", $request->email)->exists()) {
            return redirect()->to(route("register.create"));
        }

        return redirect()->to(route("login.showInsertPin"));
    }

    public function showInsertPin()
    {
        return Session::has("email") ?
            view("auth.login-insert-pin", ["email" => Session::get("email")])

            : redirect()->to(route("login.show"));
    }

    public function handle(Request $request)
    {
        $request->validate([
            "pin_number" => ["required", "numeric", "digits_between:6,8"]
        ]);

        $credentials = [
            "email" => Session::get("email"),
            "password" => $request->pin_number
        ];

        if (Auth::attempt($credentials, remember: true)) {
            Session::forget("phone_number");
            return redirect()->to(RouteServiceProvider::HOME());
        }

        return redirect()->to(route("login.showInsertPin"))
            ->withErrors(["pin_number" => "Nomor PIN yang anda masukan salah!"]);
    }
}
