<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Responses\ErrorMessageResponse;
use App\Services\VerificationCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function create(Request $request)
    {
        return view("auth.email-verification");
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            "verification_code" => "required|numeric|digits_between:6,6"
        ]);

        $isCodeMatch = VerificationCodeService::verifyByEmail(
            Auth::user()->email,
            intval($validated["verification_code"])
        );

        if ($isCodeMatch) {
            User::where("id", Auth::id())
                ->update(["email_verified_at" => now()->toDateTimeString()]);
            return redirect()->to(RouteServiceProvider::HOME())
                ->with(["success" => "Verifikasi Email berhasil!"]);
        } else {
            return redirect()->to(route("email-verification.create"))->withErrors([
                "verification_code" => ErrorMessageResponse::verificationCode()
            ]);
        }
    }
}
