<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Responses\ErrorMessageResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcessChangePINController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate(["pin_number" => "numeric|required"]);

        $authID = Auth::id();

        $isUpdateSucces =  User::where("id", $authID)->update([
            "password" => bcrypt($validated["pin_number"])
        ]);

        return $isUpdateSucces ? response()->json([
            "status" => true, "succes" => true, "message" => "PIN Berhasil Diubah"
        ]) : response()->json([
            "status" => false, "error_message" => ErrorMessageResponse::serverError()
        ]);
    }
}
