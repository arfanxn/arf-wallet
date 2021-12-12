<?php

namespace App\Models;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        "tx_hash",
        "from_wallet_id",
        "to_wallet_id",
        "amount",
        "charge",
        "description",
    ];

    public function toWallet()
    {
        return $this->belongsTo(Wallet::class, "to_wallet_id", "id");
    }

    public function fromWallet()
    {
        return $this->belongsTo(Wallet::class, "from_wallet_id", "id");
    }
}
