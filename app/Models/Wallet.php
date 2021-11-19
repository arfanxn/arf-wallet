<?php

namespace App\Models;

use App\Exceptions\WalletException;
use App\Models\Transaction;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ["balance"];

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
                WalletException("Alamat wallet tidak ditemukan atau tidak valid!");

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

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function transferedTransaction()
    {
        return $this->hasMany(Transaction::class, "from_wallet_id", "id");
    }

    public function receivedTransaction()
    {
        return $this->hasMany(Transaction::class, "to_wallet_id", "id");
    }
}
