<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $user = User::find($request->email);
        if (Hash::check($request->password, $user->password)) {
            $loginUser = [
                'serverRequest'=> 200,
                'name'=>$user->name,
                'lastName'=>$user->lastName,
                'id'=>$user->id,
                'api_token'=>$user->api_token,
            ];
            return $loginUser;
        }else{
            $loginUser['serverRequest']= 403;
        }
            return response()->json($loginUser);
    }
}
