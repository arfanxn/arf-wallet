<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use App\Models\VerificationCode;

//  trait used for User model with VerificationCode model configuration //

trait UserVerificationCodeTrait
{
  public  function verificationCodeExpireTime()
  {
    return 30;
  }

  public function getVerificationCode()
  {
    return $this->hasOne(VerificationCode::class)->first();
  }

  public function makeVerificationCode()
  {
    $code = rand(100000, 999999);
    VerificationCode::insert([
      "user_id" => $this->id,
      "email" => $this->email,
      "code" => $code,
      "expire_at" => Carbon::now()->addMinutes(
        $this->verificationCodeExpireTime()
      )->toDateTimeString()
    ]);
    return $code;
  }

  public function updateVerificationCode()
  {
    $code = rand(100000, 999999);
    VerificationCode::where("user_id", $this->id)
      ->where("email", $this->email)->update([
        "code" => $code,
        "expire_at" => Carbon::now()->addMinutes(
          $this->verificationCodeExpireTime()
        )->toDateTimeString()
      ]);
    return $code;
  }
}
