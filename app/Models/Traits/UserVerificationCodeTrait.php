<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\DB;

//  trait used for User model with VerificationCode model configuration //

trait UserVerificationCodeTrait
{
  private function verificationCodeExpireTime()
  {
    return 30;
  }

  public function getVerificationCode()
  {
    return $this->hasOne(VerificationCode::class)->whereDate(
      "expire_at",
      ">=",
      Carbon::now()->toDateString()
    )->whereTime("expire_at", ">", Carbon::now()->toTimeString())
      ->first();
  }

  public function makeVerificationCode()
  {
    $code = rand(100000, 999999);
    VerificationCode::updateOrInsert(
      ["user_id" => $this->id, "email" => $this->email],
      [
        "code" => $code,
        "expire_at" => Carbon::now()->addMinutes(
          $this->verificationCodeExpireTime()
        )->toDateTimeString()
      ]
    );
    return $code;
  }
}
