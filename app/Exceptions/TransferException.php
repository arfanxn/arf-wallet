<?php

namespace App\Exceptions;

use Exception;

class TransferException extends Exception
{
    public function report()
    {
        return response()->json(["error" => true, "message" => $this->getMessage()]);
    }

    public function render()
    {
        return back()->withErrors(["amount" => $this->getMessage()]);
    }

    //     public static function reportAsArray(...$arr)
    //     {
    //     }
}
