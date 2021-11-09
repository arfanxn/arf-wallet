<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function show()
    {
        return view("auth.login");
    }

    public function handlePhoneNumber(Request $request)
    {
        $request->validate([
            "phone_number" => ["required",  "numeric", "digits_between:10,14"],
        ]);

        if (!User::where("phone_number", intval($request->phone_number))->first()) {
            return redirect(route("register.create"))->with(["phone_number" => $request->phone_number]);
        }
    }
}
