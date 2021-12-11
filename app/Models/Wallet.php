<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Traits\WalletTransferMethodTrait;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ["balance"];

    public function owner()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function allTransactions()
    {
        $id =  $this->user_id;
        $transactions = Transaction::where(function ($query) use ($id) {
            $query->where("from_wallet_id", $id)->orWhere("to_wallet_id", $id);
        });

        return $transactions;
    }

    public function transferedTransactions()
    {
        return $this->hasMany(Transaction::class, "from_wallet_id", "id");
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, "to_wallet_id", "id");
    }
}
