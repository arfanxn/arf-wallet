<?php

namespace App\Models\Traits;

use App\Exceptions\WalletException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait WalletTransferMethodTrait
{
    public static function transfer(
        string $address,
        float $amount,
        float $charge = 0,
        string $description = ""
    ) {
        $tx_hash = strtoupper(uniqid() . Str::random(11));
        $toWallet = static::where("address", $address);

        DB::beginTransaction();
        try {
            $fromWallet = static::where("user_id", 1)
                ->where("balance", ">=", ($amount + $charge))
                ->update(["balance" => DB::raw("balance - " . ($amount + $charge))]);
            if (!$fromWallet) throw new
                WalletException("Saldo Wallet kamu tidak cukup!");

            if (!$toWallet->exists()) throw new
                WalletException("Alamat Wallet tidak ditemukan atau tidak valid!");

            $toWallet->update(["balance" => DB::raw("balance + " . $amount)]);

            DB::table("transactions")->create([
                "tx_hash" => $tx_hash,
                "from_wallet_id" => 1,
                "to_wallet_id" => $toWallet->first()->id,
                "amount" => $amount,
                "charge" => $charge,
                "description" => $description,
                "status" => 1
            ]);

            DB::commit();
        } catch (WalletException $e) {
            DB::rollBack();
            dd($e->report());
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
