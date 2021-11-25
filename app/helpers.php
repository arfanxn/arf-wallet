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
