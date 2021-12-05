<?php

namespace App\Models\Traits;

use App\Exceptions\WalletException;
use App\Models\Transaction;
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

            !$fromWallet ? throw new WalletException("Saldo Wallet kamu tidak cukup!")
                : $fromWallet->update(["balance" => DB::raw("balance - " . ($amount + $charge))]);

            // if the user send to the same wallet, let say wallet-id-1 send to wallet-id-1 ,throw an error.
            if ($address == $fromWallet->first()->address)
                throw new WalletException("Tidak dapat mengirim ke Wallet yang sama!");

            $toWallet = static::where("address", $address);
            !$toWallet->exists() ? throw new
                WalletException("Alamat Wallet tujuan tidak ditemukan atau tidak valid!")
                : $toWallet->update(["balance" => DB::raw("balance + " . $amount)]);

            $tx_hash = strtoupper(Str::random(10)) . preg_replace("/[^0-9]+/",  "", now()->toDateTimeString());

            Transaction::create([
                "tx_hash" => $tx_hash,
                "from_wallet_id" => $fromWallet->first()->id,
                "to_wallet_id" => $toWallet->first()->id,
                "amount" => $amount,
                "charge" => $charge,
                "description" => $description,
                "status" => 1
            ]);

            DB::commit();

            return true;
        } catch (WalletException $e) {
            DB::rollBack();
            return $e->getMessage();

            // dd($e->report());
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return $e->getMessage();


            // dd($e->getMessage());
        }
    }
}
