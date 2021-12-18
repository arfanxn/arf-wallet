<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopupWalletBalanceController extends Controller
{
    // 
    public function create(Request $request)
    {
        return view("transactions.wallet-topup");
    }
}
