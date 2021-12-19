<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Nette\Utils\Image;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountSettingController extends Controller
{
    public function index()
    {
        return view("accounts.settings");
    }

    public function showChangeFullname()
    {
        return view("accounts.change-fullname");
    }

    public function showChangeEmail()
    {
        return view("accounts.change-email");
    }

    public function showChangePin()
    {
        return view("accounts.change-pin");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login.show");
    }

    public function changeProfilePicture(Request $request)
    {
        $request->validate([
            "profile_picture" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imgName = strtoupper(Str::random(34)) . preg_replace("/[^0-9]+/",  "", now()->toDateTimeString()) . "." . $request->file("profile_picture")->extension();


        $request->file("profile_picture")
            ->storeAs("/public/accounts/profile_pictures",  $imgName);

        User::where("id", Auth::id())->update(['profile_picture' => $imgName]);

        return redirect()->route("account.settings.index")->with(["success" => "Foto Profil berhasil di ubah"]);
    }
}
