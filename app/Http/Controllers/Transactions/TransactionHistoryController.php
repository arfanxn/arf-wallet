<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TransactionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Auth::user()->wallet->allTransactions()
            ->orderBy("created_at", "desc")->simplePaginate(15);
        return view("transactions.histories", compact("transactions"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $authUser =  Auth::user()->load("wallet");
        if (Gate::denies("show-transaction-history", $transaction)) abort(403);

        $transaction = $authUser->wallet->id == $transaction->from_wallet_id ?
            $transaction->load("toWallet.owner") : $transaction->load("fromWallet.owner");
        return view("transactions.detail", compact("transaction"));
    }

    /**
     * Show filtered transactions .
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
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
            case "asc":
            case "oldest":
                $transactions = $transactions->orderBy("created_at", "asc");
                break;
            case "desc":
            case "newest":
            default:
                $transactions =  $transactions->orderBy("created_at", "desc");
                break;
        }

        $transactions = $transactions->simplePaginate(15);

        $transactions->appends([
            "sortby" => $sortBy,
            "transaction-date" => $transactionDate, "transaction-type" => $transactionType,
        ]);

        $request->session()->flashInput([
            "transactions-sorting" => $sortBy,
            "transactions-filter-type" => $transactionType,
            "transactions-filter-date" => $transactionDate,
        ]);
        return view("transactions.histories", compact("transactions"));
    }
}
