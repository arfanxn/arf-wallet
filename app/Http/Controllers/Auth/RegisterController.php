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
        return  url()->previous() == route("login.show")
            || url()->previous() == route("register.create")
            || url()->previous() == route("register.confirmPin") ?
            view("auth.register", ["phone_number" => session()->get('phone_number')]) :

            redirect()->to(RouteServiceProvider::HOME);
    }

    public function confirmPin(Request $request)
    {
        if (url()->previous() != route("register.create")) {
            return redirect()->to(RouteServiceProvider::HOME);
        }

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

    public function store(Request $request)
    {
        foreach (Session::all() as $key => $value) {
            if ($key[0] != '_') {
                $request->merge([$key => $value]);
            }
        }
        $request->validate([
            "confirm_pin_number" => ["required", "digits_between:6,8",  "same:pin_number"]
        ]);
        User::create([
            "name" => $request->fullname, "email" => $request->email,
            "phone_number" => $request->phone_number, "password" => bcrypt($request->pin_number)
        ]);
        Session::flush();

        Auth::attempt([
            "phone_number" => $request->phone_number,
            "password" => $request->pin_number,
        ]);

        return redirect()->to(RouteServiceProvider::HOME);
    }
}
