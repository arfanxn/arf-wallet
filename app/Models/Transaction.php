<?php

namespace App\Models;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function toWallet()
    {
        return $this->belongsTo(Wallet::class, "to_wallet_id", "id");
    }

    public function fromWallet()
    {
        return $this->belongsTo(Wallet::class, "from_wallet_id", "id");
    }

    public function type()
    {
        return $this->belongsTo(TransactionType::class, "transaction_type_id", "id");
    }
}
