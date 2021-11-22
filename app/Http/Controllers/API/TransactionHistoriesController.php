<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\WalletResource;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoriesController extends Controller
{
    public  function sortByAsc()
    {
        // return response()->json(["data" => (User::where("id", Auth::user()->id)->first())]);
        // return (new WalletResource(
        //     Wallet::where("id", 2)->get()
        //         ->loadMissing("receivedTransactions")
        // ))->response();

        $json =  new WalletResource(Wallet::where("user_id", 1)
            ->get()->loadMissing([
                "transferedTransactions" => function ($query) {
                    return $query->with("toWallet.owner")->orderBy("created_at", "desc")->get();
                }, "receivedTransactions.fromWallet.owner" => function () {
                }
            ]));
        return $json;
    }

    public function sortByDesc()
    {
        // 
    }

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
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionHistory $transactionHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionHistory $transactionHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionHistory $transactionHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionHistory $transactionHistory)
    {
        //
    }
}
