<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists("toIDR")) {
    function toIDR($number)
    {
        $money = number_format($number, 2);
        $money = str_replace(",", ".", preg_replace("/[.].*/", "", $money));

        return "Rp$money";
    }
}

if (!function_exists("toCurrency")) {
    function toCurrency($number, $withDecimal = false)
    {
        $money = number_format($number, 2);

        if (!$withDecimal) {
            $money = str_replace(",", ".", preg_replace("/[.].*/", "", $money));
        }

        return $money;
    }
}

if (!function_exists("stringCensor")) {
    function stringCensor($string)
    {
        $length = strlen($string) - floor(strlen($string) / 2);
        $start = floor($length / 2);
        $replacement = str_repeat('*', $length);
        return substr_replace($string, $replacement, $start, $length);
    }
}

if (!function_exists("decryptAndCatch")) {
    function decryptAndCatch(
        string $encryptedStringToDecrypt,
        $catchCallback = null,
    ) {
        try {
            $decrypted = \Illuminate\Support\Facades\Crypt::decryptString($encryptedStringToDecrypt);
            if (!$decrypted) throw new \Illuminate\Contracts\Encryption\DecryptException();

            return $decrypted;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return $catchCallback ? $catchCallback($e)
                // Show the error message if not production 
                : (env("APP_ENV") != "production" ? dd($e->getMessage()) : null);
        }
    }
}
