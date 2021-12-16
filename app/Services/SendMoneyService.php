<?php

namespace App\Services;

use App\Exceptions\TransferException;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Responses\ErrorMessageResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SendMoneyService
{
    private $amount, $charge, $description,  $fromWallet, $forWallet;

    public function setAmount(float|int|string $amount)
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

    public function setFromWallet(Wallet|string|null $fromWallet = null) //wallet object or address
    {
        if (is_null($fromWallet)) $this->fromWallet = (app("AuthWallet"))->address;
        elseif ($fromWallet instanceof Wallet) $this->fromWallet = $fromWallet->address;
        elseif ($fromWallet) $this->fromWallet = $fromWallet;

        return $this;
    }

    public function setToWallet(string $toWallet) //wallet object or address
    {
        $this->forWallet = $toWallet;

        return $this;
    }

    public function transfer()
    {
        try {
            DB::beginTransaction();
            $amount = $this->amount;
            $charge = $this->charge ?? 0;
            $amountAndCharge = intval($amount) + intval($charge);
            $description = $this->description ?? "";
            $toWallet = $this->forWallet;
            $fromWallet = $this->fromWallet;

            // if the user send to the same wallet, let say wallet-id-1 send to wallet-id-1 ,throw an error.
            if ($fromWallet ==  $toWallet)
                throw new TransferException("Tidak dapat mengirim ke Wallet yang sama!");
            // end

            // minumum transfer must be at least "IDR 10.000"
            if ($amount < 10000) throw new TransferException("Minimal transfer adalah IDR 10.000");
            // end

            $fromWalletData = Wallet::where("address", $fromWallet)
                ->where("balance", ">=", strval($amountAndCharge))->first();

            // check is fromWallet valid/exist and balance enough for doing this transfer process
            // if exist -> subtract the fromWallet balance
            if ($fromWalletData) {
                $fromWalletData->decrement("balance", strval($amountAndCharge));
                $fromWalletData->save();
            } else throw new TransferException("Saldo Wallet kamu tidak cukup!");
            // end

            $toWalletData = Wallet::where("address", $toWallet)->first();
            // check is toWallet exist and valid
            // if valid and also exist , add the toWallet balance 
            if ($toWalletData) {
                $toWalletData->increment("balance", strval($amount));
                $toWalletData->save();
            } else throw new TransferException("Alamat Wallet tujuan tidak ditemukan atau tidak valid!");
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
            return [
                "status" => false,
                "message" => $e->getMessage(),
            ];
            // return $e->report();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return [
                "status" => false,
                "message" => ErrorMessageResponse::serverError(),
            ];
        }
    }
}
