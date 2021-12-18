<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Responses\ErrorMessageResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProcessChangeEmailController extends Controller
{
    public function handle(Request $request)
    {
        $authID = Auth::id();

        $isUpdateSucces = User::where("id", $authID)->update([
            "email" => $request->email
        ]);

        return $isUpdateSucces ? response()->json([
            "status" => true, "succes" => true, "message" => "Email Berhasil Diubah."
        ]) : response()->json([
            "status" => false, "error_message" => ErrorMessageResponse::serverError()
        ]);
    }

    public function validateEmail(Request $request)
    {
        $validator =  Validator::make(["email" => $request->email],  [
            "email" => ["required", "email"]
        ]);

        return $validator->fails() ? response()->json([
            "status" => false,
            "error_message" => "Masukan Email yang valid!"
        ]) : response()->json([
            "status" => true,
        ]);
    }
}
