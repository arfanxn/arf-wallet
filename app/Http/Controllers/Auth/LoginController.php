<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\ControllerAndMethodServiceProvider as ControllerAndMethod;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function show()
    {
        Session::forget("phone_number");
        return view("auth.login");
    }

    public function handlePhoneNumber(Request $request)
    {
        $request->validate([
            "phone_number" => ["required",  "numeric", "digits_between:10,14"],
        ]);

        Session::put(["phone_number" => $request->phone_number]);

        if (!User::where("phone_number", intval($request->phone_number))->first()) {
            return redirect()->to(route("register.create"));
        }

        return redirect()->to(route("login.showInsertPin"));
    }

    public function showInsertPin()
    {
        return Session::has("phone_number") ?
            view("auth.login-insert-pin", ["phone_number" => Session::get("phone_number")])

            : redirect()->to(route("login.show"));
    }

    public function handle(Request $request)
    {
        $request->validate([
            "pin_number" => ["required", "numeric", "digits_between:6,8"]
        ]);

        $credentials = [
            "phone_number" => Session::get("phone_number"),
            "password" => $request->phone_number
        ];

        if (Auth::attempt($credentials)) {
            Session::forget("phone_number");
            return redirect()->to(RouteServiceProvider::HOME());
        }

        return redirect()->to(route("login.showInsertPin"))
            ->withErrors(["pin_number" => "Nomor PIN yang anda masukan salah!"]);
    }
}
