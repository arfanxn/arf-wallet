<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Notifications\MoneyReceivedNotification;
use App\Notifications\MoneySentSuccessNotification;
use Illuminate\Support\Facades\Notification;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {   // disabled for now because my mailTrap have already limit

        // $transaction = $transaction->load("fromWallet.owner", "toWallet.owner");
        // $fromWallet = $transaction->fromWallet;
        // $toWallet = $transaction->toWallet;

        // Notification::route('mail', $fromWallet->owner->email)
        //     ->notify(new MoneySentSuccessNotification($transaction));
        // Notification::route('mail', $toWallet->owner->email)
        //     ->notify(new MoneyReceivedNotification($transaction));
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
