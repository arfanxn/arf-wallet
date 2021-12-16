<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoadIncomeAndExpenseThisMonthFromAuthWalletController extends Controller
{
    public function __invoke()
    {
        $wallet = app("AuthWallet");
        $income = $wallet->receivedTransactions()->where("created_at", ">=", now()->startOfMonth()->toDateTimeString())->sum("amount");
        $expense = $wallet->transferedTransactions()->where("created_at", ">=", now()->startOfMonth()->toDateTimeString())->sum("amount");

        return response()->json(["income" => $income, "expense" => $expense]);
    }
}
