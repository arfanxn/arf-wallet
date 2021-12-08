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
    // 
    public function filterByDateAndTransactionType(Request $request)
    {
        // arf-wallet.test/fe-api/controller?transaction-type=send-money&filter-date=today
        // dd($request->get("filter-date"), $request->get("transaction-type"));

        $transactions = Auth::user()->wallet;
        $transactionType =  $request->get("transaction-type") ?? "all";
        $filterDate = $request->get("filter-date") ?? "all";

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

        switch ($filterDate) {
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

        $transactions =  $transactions->simplePaginate(15);

        $transactions->withPath(url()->current() .
            "?transaction-type=" .  $transactionType .
            "&filter-date=" . $filterDate);

        return TransactionResource::collection($transactions);
    }

    // public function getByRangeOneMonthAndTypeSendMoney

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
