<?php

namespace App\Models;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "tx_hash",
        "from_wallet_id",
        "to_wallet_id",
        "transaction_type_id",
        "amount",
        "charge",
        "description",
        "status"
    ];

    public static function getLastTransactionTo($wallet_or_walletId)
    {
        if ($wallet_or_walletId instanceof Wallet)
            $wallet_or_walletId = $wallet_or_walletId->id;

        $lastTransaction = static::where("from_wallet_id", (Auth::user())->wallet->id)
            ->where("to_wallet_id", $wallet_or_walletId)->orderBy("created_at", "desc")->first();
        return $lastTransaction ?? null;
    }

    public function toWallet()
    {
        return $this->belongsTo(Wallet::class, "to_wallet_id", "id");
    }

    public function fromWallet()
    {
        return $this->belongsTo(Wallet::class, "from_wallet_id", "id");
    }
}
