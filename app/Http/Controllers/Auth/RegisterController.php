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
        return Session::has("phone_number") ?
            view("auth.register", ["phone_number" => Session::get('phone_number')]) :

            redirect()->to(route("login.show"));
    }

    public function confirmPin(Request $request)
    {
        $attribute = $request->validate([
            "phone_number" => [
                "required",  "numeric", "digits_between:10,14", "unique:users,phone_number",
            ],
            "fullname" =>  ["required", "string", "min:2", "max:30"],
            "email" => ["required", "unique:users,email", "email"],
            "pin_number" => ["required", "numeric", "digits_between:6,8",],
        ]);
        Session::put($attribute);
        return view("auth.register-confirm-pin");
    }

    // public function showConfirmPin()
    // {
    //     return view("auth.register-confirm-pin");
    // }

    public function store(Request $request)
    {
        $request->merge(["pin_number" => Session::pull("pin_number")]);
        $request->validate([
            "confirm_pin_number" => ["required", "digits_between:6,8",  "same:pin_number"]
        ]);

        User::create([
            "name" => Session::pull("fullname"),
            "email" => Session::pull("email"),
            "phone_number" => Session::get("phone_number"),
            "password" => bcrypt($request->pin_number)
        ]);

        // event()

        Auth::attempt([
            "phone_number" => Session::pull("phone_number"),
            "password" => $request->pin_number,
        ]);

        return redirect()->to(RouteServiceProvider::HOME())
            ->with(["success" => "Akun anda telah teregistrasi, kini anda dapat login dengan Nomor HP."]);
    }
}
