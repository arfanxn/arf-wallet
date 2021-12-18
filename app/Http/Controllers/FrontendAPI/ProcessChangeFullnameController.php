<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Responses\ErrorMessageResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProcessChangeFullnameController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make(["fullname" => $request->fullname], [
            "fullname" => "required|string"
        ]);

        $isSuccess = false;
        if ($validator->fails()) {
            $isSuccess = false;
        } else {
            $isSuccess = User::where("id", Auth::id())->update(["name" => $request->fullname]);
        }




        return $isSuccess ? response()->json([
            "status" => true,  "message" => "Nama telah berhasil diubah."
        ]) : response()->json([
            "status" => false, "error_message" =>  ErrorMessageResponse::serverError()
        ]);
    }
}
