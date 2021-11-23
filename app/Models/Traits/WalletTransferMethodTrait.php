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
        DB::beginTransaction();
        try {
            if ($amount < 10000) return throw new WalletException("Minimal transfer adalah 10.000");

            $fromWallet = Auth::user()->wallet()
                ->where("balance", ">=", ($amount + $charge));

            if ($address == $fromWallet->first()->address)
                throw new WalletException("Tidak dapat mengirim ke Wallet yang sama!");

            !$fromWallet ? throw new WalletException("Saldo Wallet kamu tidak cukup!")
                : $fromWallet->update(["balance" => DB::raw("balance - " . ($amount + $charge))]);

            $toWallet = static::where("address", $address);
            !$toWallet->exists() ? throw new
                WalletException("Alamat Wallet tujuan tidak ditemukan atau tidak valid!")
                : $toWallet->update(["balance" => DB::raw("balance + " . $amount)]);

            $tx_hash = strtoupper(Str::random(10)) . preg_replace("/[^0-9]+/",  "", now()->toDateTimeString());

            DB::table("transactions")->insert([
                "tx_hash" => $tx_hash,
                "from_wallet_id" => $fromWallet->first()->id,
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
