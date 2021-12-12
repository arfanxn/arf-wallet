<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\Wallet;

class WalletRepository
{
    public static function getRecentTransferedWalletsByWallet(Wallet|int $walletOrID)
    {
        if ($walletOrID instanceof Wallet) $wallet = $walletOrID->id;
        $transferedTransactions = Transaction::with("toWallet.owner")
            ->where("from_wallet_id", $wallet)
            ->orderBy("created_at", "desc")
            ->limit(15)->get()->unique("to_wallet_id");

        $index = 0;
        $recentWallets = [];
        foreach ($transferedTransactions as  $transferedTransaction) {
            if ($index == 5) break;
            array_push($recentWallets, $transferedTransaction->toWallet);
            $index += 1;
        };
        return $recentWallets;
    }
}
