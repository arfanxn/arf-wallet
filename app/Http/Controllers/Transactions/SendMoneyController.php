<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendMoneyStoreRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SendMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recentWallets = (Auth::user())->recentTransferedWallets();
        return view("transactions.send-money", compact("recentWallets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,  $address)
    {
        $encryptedWalletAddress = $address;
        $address = decryptAndCatch($address, fn () => abort(404));

        $toWallet = Wallet::with("owner")->where("address", $address)->first();
        if (!$toWallet) return abort(404);

        $lastTransactionTo = Transaction::getLastTransactionTo($toWallet);
        return view(
            "transactions.send-money-to",
            compact("toWallet", "lastTransactionTo", "encryptedWalletAddress")
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SendMoneyStoreRequest $request, $address)
    {
        $address = decryptAndCatch($address, fn () => abort(404));

        $charge = $request->charge ?? 0;
        $walletTransaction = Wallet::transfer($address, $request->amount, $charge, $request->description ?? "");

        return isset($walletTransaction->original["success"]) ?
            redirect()->to(route("transaction.detail", $walletTransaction->original["tx_hash"]))->with(["success" => "Transaksi Berhasil"])
            : back()->with(["error" => $walletTransaction->original["message"] ?? $walletTransaction->message ?? $walletTransaction ?? "Error Occured"]);
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
