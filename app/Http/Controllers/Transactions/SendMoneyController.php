<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendMoneyRequest;
use App\Services\SendMoneyService;
use App\Models\Wallet;
use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recentWallets =
            WalletRepository::getRecentTransferedWalletsByWallet(app("AuthWallet"));
        return view("transactions.send-money", compact("recentWallets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,  $address)
    {
        $encryptedToWalletAddress = $address;
        $address = decryptAndCatch($address, fn () => abort(404));

        $toWallet = Wallet::with("owner")->where("address", $address)->first();
        if (!$toWallet) return abort(404);

        $lastTransactionTo = TransactionRepository::getLastTransactionTo($toWallet);
        return view(
            "transactions.send-money-to",
            compact("toWallet", "lastTransactionTo", "encryptedToWalletAddress")
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, SendMoneyService $service)
    {
        $address = decryptAndCatch(
            $request->get("encrypted_to_wallet_address"),
            fn () => false
        );
        if (!$address) {
            return response()->json([
                "status" => false, "error_message" => "Something Went Wrong"
            ]);
        }

        $amount = $request->amount;
        $charge = intval($request->charge ?? 0);
        $resultOfTransfer = $service->setFromWallet()->setToWallet($address)
            ->setAmount($amount)->setCharge($charge)
            ->setDescription($request->description ?? "")
            ->transfer();

        return $resultOfTransfer["status"] ?
            response()->json([
                "status" => true, "success" => true,
                "redirect" => route("transaction.detail", $resultOfTransfer["tx_hash"])
            ]) : response()->json([
                "status" => false,
                "error_message" => $resultOfTransfer["message"]
            ]);
    }

    public function verify(SendMoneyRequest $request)
    {
        $validator = $request->validatorMake();
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors(), "status" => false]);
        }
        if (intval(app('AuthWallet')->balance) < intval($request->amount))
            return response()->json([
                "status" => false,
                "errors" => ["amount" => ["Saldo Wallet kamu tidak cukup!"]]
            ]);

        return response()->json(["success" => true, "status" => true]);
    }
}
