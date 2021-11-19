<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\WalletTransferMethodTrait;

class Wallet extends Model
{
    use HasFactory, WalletTransferMethodTrait;

    protected $fillable = ["balance"];

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
