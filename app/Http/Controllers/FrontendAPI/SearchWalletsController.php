<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Request;

class SearchWalletsController extends Controller
{
    public function searchByAddressExceptSelf(Request $request)
    {
        $address = $request->get("search-wallet") ?? $request->get("keyword");

        if (preg_match("/$address/", app('AuthWallet')))
            return response()->json([]); // if address being search is same with self authwallet return array with no value  

        $wallets = Wallet::where("address", "LIKE", $address . "%")->get();

        $request->merge([
            "encryptAddress" => true,
        ]);
        return WalletResource::collection($wallets->load("owner"));
    }
}
