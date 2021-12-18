<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MoneySentSuccessNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $transaction;
    public $tries = 3;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;

        $this->delay(now()->addMinutes(3));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $transaction = $this->transaction->loadMissing("fromWallet.owner", "toWallet.owner");
        $fromWallet = $transaction->fromWallet;
        $toWallet =  $transaction->toWallet;
        return (new MailMessage)
            ->subject("Transaksi Berhasil | " . config("app.name"))
            ->view("notifications.money-sent-success", [
                "transaction" => $transaction,
                "toWallet" => $toWallet,
                "fromWallet" => $fromWallet
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
