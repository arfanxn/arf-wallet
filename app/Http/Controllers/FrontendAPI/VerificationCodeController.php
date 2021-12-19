<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use App\Models\VerificationCode;
use App\Responses\ErrorMessageResponse;
use App\Services\VerificationCodeService;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{
    public function sendByEmail(Request $request)
    {
        $validated  = $request->validate(["email" => "email|required"]);
        VerificationCodeService::sendByEmail($validated["email"]);
        return response()->json([
            "status" => true, "message" => "Kode Verifkasi telah terkirim, cek email kamu."
        ]);
    }

    public function verifyByEmail(Request $request)
    {
        $validated = $request->validate([
            "email" => "required|email",
            "verification_code" => "required|numeric"
        ]);
        $isCodeMatch = VerificationCodeService::verifyByEmail($validated['email'], $validated["verification_code"]);

        return $isCodeMatch ? response()->json([
            "status" => true, "message" => "Code Verification match!"
        ]) : response()->json([
            "status" => false, "error_message" => ErrorMessageResponse::verificationCode()
        ]);
    }
}
