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

    const UPDATED_AT = null, CREATED_AT = null;

    protected $table = "verification_codes";

    protected $fillable = ['user_id', "email", "code", "expire_at"];

    public static function send(User $user)
    {
        $email = $user->email;

        $code = $user->getVerificationCode()->code  ??
            $user->makeVerificationCode();

        Notification::route('mail', $email)
            ->notify(new VerificationCodeNotification($code));
    }

    public static function verify(User $user, int $code)
    {
        $userVerifiedCode = $user->getVerificationCode()->code ??
            $user->makeVerificationCode();

        return $code  == $userVerifiedCode;
    }
}
