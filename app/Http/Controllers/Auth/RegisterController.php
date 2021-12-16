<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create()
    {
        return Session::has("email") ?
            view("auth.register", ["email" => Session::get('email')]) :

            redirect()->to(route("login.show"));
    }

    public function handleCreate(Request $request)
    {
        $attribute = $request->validate([
            "phone_number" => [
                "required",  "numeric", "digits_between:10,14", "unique:users,phone_number",
            ],
            "fullname" =>  ["required", "string", "min:2", "max:30"],
            "email" => ["required", "unique:users,email", "email"],
            "pin_number" => ["required", "numeric", "digits_between:6,8",],
        ]);
        if (Session::get("email") != $attribute["email"]) {
            return redirect()->to(route("register.create"))->withErrors(["email" => "Detected : Email Edited!"]);
        };

        $request->session()->put($attribute);
        return redirect()->to(route("register.showConfirmPin"));
    }

    public function showConfirmPin()
    {
        return Session::has("pin_number") ?
            view("auth.register-confirm-pin")

            : redirect()->to("register.create");
    }

    public function storeAndLogin(Request $request)
    {
        $request->merge(["pin_number" => $request->session()->get("pin_number")]);
        $request->validate([
            "confirm_pin_number" => ["required", "digits_between:6,8",  "same:pin_number"]
        ]);

        User::create([
            "name" => $request->session()->pull("fullname"),
            "email" => $request->session()->get("email"),
            "phone_number" => $request->session()->pull("phone_number"),
            "password" => bcrypt($request->pin_number)
        ]);

        $isLoginSuccess =  Auth::attempt([
            "email" => $request->session()->pull("email"),
            "password" => $request->pin_number,
        ], remember: 1);

        return $isLoginSuccess ? redirect()->to(RouteServiceProvider::HOME())
            ->with(["success" =>
            "Akun anda telah teregistrasi, kini anda dapat login dengan Email."])
            :  redirect()->route("register.create");
    }
}
