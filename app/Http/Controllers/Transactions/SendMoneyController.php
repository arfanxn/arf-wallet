<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendMoneyStoreRequest;
use App\Services\SendMoneyService;
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

        $charge = intval($request->charge ?? 0);
        $resultOfTransfer = (new SendMoneyService)->setFromWallet()->setToWallet($address)
            ->setAmount(intval($request->amount))->setCharge($charge)
            ->setDescription($request->description ?? "")
            ->transfer();

        return $resultOfTransfer["status"] ?
            redirect()->to(route("transaction.detail", $resultOfTransfer["tx_hash"]))->with(["success" => "Transaksi Berhasil"])
            : back()->withErrors(["error" => $resultOfTransfer["message"]]);
    }
}
