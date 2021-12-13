<?php

namespace App\Http\Controllers\FrontendAPI;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\WalletResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoriesController extends Controller
{
    public function filterByDateAndTransactionType(Request $request)
    {
        // env(app_url) . /fe-api/controller?transaction-type=send-money&filter-date=today
        $transactions = Auth::user()->wallet;
        $transactionType =  $request->get("transaction-type") ?? "all";
        $transactionDate = $request->get("transaction-date") ?? "all";
        $sortBy = $request->get("sortby") ?? "desc";

        switch ($transactionType) {
            case "send-money":
                $transactions = $transactions->transferedTransactions();
                break;
            case "receive-money":
                $transactions = $transactions->receivedTransactions();
                break;
            default: // show all
                $transactions = $transactions->allTransactions();
                break;
        }

        switch ($transactionDate) {
            case "today":
                $transactions = $transactions->where("created_at", ">=", now()->startOfDay()->toDateTimeString());
                break;
            case "this-week":
                $transactions = $transactions
                    ->where("created_at", ">=", now()->startOfWeek()->toDateTimeString());
                break;
            case "this-month":
                $transactions = $transactions
                    ->where("created_at", ">=", now()->startOfMonth()->toDateTimeString());
                break;
            case "range-3-month":
                $transactions = $transactions
                    ->where("created_at", ">=", now()->subMonth(03)->toDateTimeString());
                break;
            case "this-year":
                $transactions = $transactions
                    ->where("created_at", ">=", now()->startOfYear()->toDateTimeString());
                break;
            default: // show all
                $transactions = $transactions;
                break;
        }

        switch ($sortBy) {
            case "desc":
            case "newest":
                $transactions =  $transactions->orderBy("created_at", "desc");
                break;
            case "asc":
            case "oldest":
                $transactions = $transactions->orderBy("created_at", "asc");
                break;
        }

        $transactions =  $transactions->simplePaginate(10);

        $transactions->appends([
            "sortby" => $sortBy,
            "transaction-date" => $transactionDate, "transaction-type" => $transactionType,
        ]);

        return  TransactionResource::collection($transactions)
            ->additional(["auth_wallet" => app("AuthWallet")->only("user_id")]);
    }
}
