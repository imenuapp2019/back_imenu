<?php

namespace App\Http\Controllers\Auth;

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

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {

        $this->validate($request, [
        'token' => 'required',
        'password' => 'required|confirmed|min:6',

    ]);

    // Here we will attempt to reset the user's password. If it is successful we
    // will update the password on an actual user model and persist it to the
    // database. Otherwise we will parse the error and return the response.
    $response = $this->broker()->reset(
        $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
    );

    // If the password was successfully reset, we will redirect the user back to
    // the application's home authenticated view. If there is an error we can
    // redirect them back to where they came from with their error message.
    if($response == Password::PASSWORD_RESET){
        return response()->json(['success'=>'true']);
    }
    else{
        return response()->json(['success'=>'false']);
    }
    // return $response == Password::PASSWORD_RESET
    //             ? $this->sendResetResponse($response)
    //             : $this->sendResetFailedResponse($request, $response);
    }

// public function postReset(Request $request)
//  {
//      return response()->json(['success'=>'true']);
//  }

}
