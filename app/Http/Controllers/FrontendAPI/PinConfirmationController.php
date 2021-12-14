<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PinConfirmationController extends Controller
{
    public function __invoke(Request $request)
    {
        $attribute = $request->validate([
            "pin_number" => ["required",  "numeric", "digits_between:6,8"]
        ]);
        $isPinMatch = Hash::check($attribute['pin_number'], Auth::user()->password);

        return $isPinMatch ? response()->json([
            "status" => true, "success" => true, "pin_matched" => true
        ]) : response()->json([
            "status" => false,
            "errors" => ["pin_number" => ['Nomor PIN yang anda masukan salah!']]
        ]);
    }
}
