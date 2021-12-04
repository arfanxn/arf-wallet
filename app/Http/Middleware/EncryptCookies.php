<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        // 'XSRF-TOKEN',
    ];

    // protected function decryptCookie($name, $cookie)
    // {
    //     return is_array($cookie)
    //         ? $this->decryptArray($cookie)
    //         : $this->encrypter->decrypt(urldecode($cookie), static::serialized($name));
    // }
}
