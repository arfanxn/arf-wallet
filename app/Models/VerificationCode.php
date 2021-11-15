<?php

namespace App\Models;

use App\Notifications\VerificationCodeNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class VerificationCode extends Model
{
    use HasFactory;

    const UPDATED_AT = null     ;

    protected $table = "verification_codes";

    protected $fillable = ['user_id', "email", "code", "expire_at"];

    public static function send(User $user)
    {
        $email = $user->email;

        $verificationCode =  $user->getVerificationCode();
        $code = !is_null($verificationCode->code) ? $verificationCode->code : null;

        if (is_null($verificationCode)) {
            $code = $user->makeVerificationCode();
        }

        if (
            !is_null($verificationCode) &&
            (Carbon::createFromFormat(
                "Y-m-d H:i:s",
                $verificationCode->expire_at
            ))->lessThanOrEqualTo((now()->toDateTimeString())) //check is the code expire or not
        ) {
            $code =  $user->updateVerificationCode(); // if expire update the code and returning the code  
        }

        Notification::route('mail', $email)
            ->notify(new VerificationCodeNotification($code));
    }
}
