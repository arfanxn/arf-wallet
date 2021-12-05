<?php

namespace App\Models;

use App\Models\Traits\UserVerificationCodeTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Wallet;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, UserVerificationCodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        "phone_number",
        'email',
        'password',
        "active",
        "last_seen",
    ];

    // protected $with = ["wallet"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new \App\Notifications\EmailVerification($this));
    // }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, "user_id", "id");
    }

    public function recentTransferedWallets()
    {
        $transferedTransactions = ($this->load([
            "wallet.transferedTransactions" => function ($query) {
                return $query->orderBy("created_at", "desc");
            }
        ]))->wallet->transferedTransactions->unique("to_wallet_id");
        $transferedTransactions = $transferedTransactions->load("toWallet.owner");
        $recentWallets = [];
        foreach ($transferedTransactions as  $transferedTransaction) {
            array_push($recentWallets, $transferedTransaction->toWallet);
        };
        return $recentWallets;
    }
}
