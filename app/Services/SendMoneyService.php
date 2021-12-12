<?php

namespace App\Services;

use App\Exceptions\TransferException;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SendMoneyService
{
    private $amount, $charge, $description,  $fromWallet, $forWallet;

    public function setAmount(float|int $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setCharge(int $charge)
    {
        $this->charge = $charge;
        return $this;
    }

    public function setDescription(string $description = "")
    {
        $this->description = $description;
        return $this;
    }

    public function setFromWallet(Wallet|string $fromWallet = null) //wallet object or address
    {
        if (is_null($fromWallet)) $this->fromWallet = (app()->make("AuthWallet"))->address;
        elseif ($fromWallet instanceof Wallet) $this->fromWallet = $fromWallet->address;
        elseif ($fromWallet) $this->fromWallet = $fromWallet;

        return $this;
    }

    public function setToWallet(Wallet|string $toWallet) //wallet object or address
    {
        $this->forWallet = $toWallet instanceof Wallet ?  $toWallet->address
            : $toWallet;

        return $this;
    }

    public function transfer()
    {
        DB::beginTransaction();
        try {
            $amount = $this->amount;
            $charge = $this->charge ?? 0;
            $description = $this->description ?? "";
            $toWallet = $this->forWallet;
            $fromWallet = $this->fromWallet;

            // minumum transfer must be at least "IDR 10.000"
            if ($amount < 10000) throw new TransferException("Minimal transfer adalah IDR 10.000");
            // end

            // check is fromWallet valid/exist and balance enough for doing this transfer proccess
            $fromWallet = Wallet::where(function ($q) use ($fromWallet) {
                $q->where("address", $fromWallet);
            })->where("balance", ">=", ($amount + $charge));
            !$fromWallet->exists() ? throw new TransferException("Saldo Wallet kamu tidak cukup!")
                // if exist -> subtract the fromWallet balance
                : $fromWallet->update(["balance" => DB::raw("balance - " . ($amount + $charge))]);
            // end


            // if the user send to the same wallet, let say wallet-id-1 send to wallet-id-1 ,throw an error.
            $fromWalletData = $fromWallet->first(); //get the fromWallet data
            if ($fromWalletData->address ==  $toWallet)
                throw new TransferException("Tidak dapat mengirim ke Wallet yang sama!");
            // end

            // check is toWallet exist and valid
            $toWallet = Wallet::where(function ($q) use ($toWallet) {
                $q->where("address", $toWallet);
            });
            !$toWallet->exists() ? throw new
                TransferException("Alamat Wallet tujuan tidak ditemukan atau tidak valid!")
                // if valid and also exist , add the toWallet balance 
                : $toWallet->update(["balance" => DB::raw("balance + " . $amount)]);
            // after check get the toWallet data
            $toWalletData = $toWallet->first();
            // end 


            // make the transaction history / transaction invoice 
            // tx_hash is the transaction uniq_id
            $tx_hash = strtoupper(Str::random(10)) . preg_replace("/[^0-9]+/",  "", now()->toDateTimeString());
            Transaction::create([
                "tx_hash" => $tx_hash,
                "from_wallet_id" => $fromWalletData->id,
                "to_wallet_id" => $toWalletData->id,
                "amount" => $amount,
                "charge" => $charge,
                "description" => $description,
            ]); // end 


            DB::commit();
            return [
                "status" => true,
                "message" => "success",
                "tx_hash" => $tx_hash,
            ];
        } catch (TransferException $e) {
            DB::rollBack();
            return $e->report();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
