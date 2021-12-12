<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\Wallet;

class TransactionRepository
{
    public static function getLastTransactionTo(Wallet|int $wallet_or_walletId)
    {
        if ($wallet_or_walletId instanceof Wallet)
            $wallet_or_walletId = $wallet_or_walletId->id;

        $lastTransaction = Transaction::where("from_wallet_id", app("AuthWallet")->id)
            ->where("to_wallet_id", $wallet_or_walletId)->orderBy("created_at", "desc")->first();
        return $lastTransaction ?? null;
    }
}
