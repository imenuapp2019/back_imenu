<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    protected function sendResetResponse(Request $request, $response)
    {
        die("estoy aqui2");
        if (request()->header('Content-Type') == 'application/json') {
        return response()->json(['success' => '200']);
        }
    }


    protected function sendResetFailedResponse(Request $request, $response)
    {
        if (request()->header('Content-Type') == 'application/json') {
            return response()->json(['Failured' => '422']);
        }
    }



}
