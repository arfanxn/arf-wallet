<?php

namespace App\Responses;

class ErrorMessageResponse
{
    public static function serverError()
    {
        return  "Something went wrong, please try again.";
    }
}
