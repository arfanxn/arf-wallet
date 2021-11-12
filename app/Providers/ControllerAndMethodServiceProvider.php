<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ControllerAndMethodServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    private $controllerName, $methodName;

    public static function removePreviousControllerAndMethod()
    {
        Session::forget("previous_controller_and_method");
    }

    public static function setPreviousControllerAndMethod(array $contNameAndMethName)
    {
        Session::put(["previous_controller_and_method" => $contNameAndMethName]);
    }

    public static function getPreviousControllerAndMethod()
    {
        return Session::get("previous_controller_and_method");
    }

    public static function matchPreviousControllerAndMethod(array $currentContAndMeth)
    {
        $prevContAndMeth = Session::get("previous_controller_and_method");

        if ($prevContAndMeth == null) return false;

        $isControllerMatch = in_array($prevContAndMeth[0], $currentContAndMeth);
        $isMethodMatch =  in_array($prevContAndMeth[1], $currentContAndMeth);

        return  $isControllerMatch && $isMethodMatch;
    }
}
