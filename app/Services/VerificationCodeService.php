<?php

namespace App\Services;

use App\Models\User;
use App\Models\VerificationCode;
use App\Notifications\VerificationCodeNotification;
use Illuminate\Support\Facades\Notification;
use App\Repositories\VerificationCodeRepository;

//  trait used for User model with VerificationCode model configuration //

class VerificationCodeService
{
    public static function expireTime()
    {
        return VerificationCode::EXPIRE_TIME;
    }

    public static function send(User $user)
    {
        $email = $user->email;

        $code =
            VerificationCodeRepository::getByUserOrCreateIfExpireThenGet($user);

        Notification::route('mail', $email)
            ->notify(new VerificationCodeNotification($code));
    }

    public static function verify(User $user, int $code): bool
    {
        $verificationCode =
            VerificationCodeRepository::getByUserOrCreateIfExpireThenGet($user);
        return $code  == $verificationCode;
    }

    public static function sendByEmail($email)
    {
        $code =
            VerificationCodeRepository::getByEmailOrCreateIfExpireThenGet($email);

        Notification::route('mail', $email)
            ->notify(new VerificationCodeNotification($code));
    }

    public static function verifyByEmail(string $email, int $code): bool
    {
        $verificationCode =
            VerificationCodeRepository::getByEmailOrCreateIfExpireThenGet($email);
        return $code  == $verificationCode;
    }
}
