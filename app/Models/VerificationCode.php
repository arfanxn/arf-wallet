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

    const EXPIRE_TIME = 30;
}
