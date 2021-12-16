<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Wallet;

class WalletRepository
{
    public static function getRecentTransferedWalletsByWallet(Wallet|int $walletOrID, int $limit = 10)
    {
        if ($walletOrID instanceof Wallet) $wallet = $walletOrID->id;
        $transferedTransactions = Transaction::with("toWallet.owner")
            ->where("from_wallet_id", $wallet)
            ->orderBy("created_at", "desc")
            ->limit($limit)->get()->unique("to_wallet_id");

        $index = 0;
        $recentWallets = [];
        foreach ($transferedTransactions as  $transferedTransaction) {
            if ($index == 5) break;
            array_push($recentWallets, $transferedTransaction->toWallet);
            $index += 1;
        };
        return $recentWallets;
    }

    public static function getWalletByUserIDorCreateIfNotExist(User|string|int $user_or_id)
    {
        $user_id = ($user_or_id instanceof Wallet) ? $user_or_id = $user_or_id->id :
            $user_or_id;
        return  Wallet::where("user_id", $user_id)->first() ?? static::createByUserID($user_id);
    }

    public static function createByUserID(User|string|int $user_or_id)
    {
        $user_id = ($user_or_id instanceof Wallet) ? $user_or_id = $user_or_id->id :
            $user_or_id;

        return Wallet::create([
            "user_id" => $user_or_id,
            "address" => strtoupper(Str::random(16)),
            "amount" => 0,
        ]);
    }

    public static function createByUserIDandGetCreated(User|string|int $user_or_id)
    {
        $user_id = ($user_or_id instanceof Wallet) ? $user_or_id = $user_or_id->id :
            $user_or_id;
        static::createByUserID($user_id);
        return Wallet::where("user_id", $user_id)->first();
    }
}
