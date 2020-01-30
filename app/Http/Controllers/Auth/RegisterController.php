<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar_id' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return array
     */
    protected function create(Request $data, $api = true)
    {
        $status = array('error_code'=>400,'user'=>'');
        $user = User::find($data->email);
        if(!empty($user)){
            //En caso de que exista el usuario, no devolvera un usuario creado y cambiara el codigo de error a 304//
            $status['error_code'] = 304;
        }else{
            //Si no existe el usuario nuevo en base de datos, devolvera un usuario creado y ademas el codigo 200//
            $user =
            User::create([
                'name' => ucfirst(strtolower($data->name)),
                'lastName' => ucfirst(strtolower($data->lastName)),
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'api_token' => bcrypt(Str::random(25)),
                'avatar_id' => (int)$data->avatar_id,
            ]);
            $status['error_code'] = 200;
           $status['user']= $user;
        }
        if ($api) {
            return response()->json($status);
        }else {
            $foodtype = User::all();
            return view('login');
        }
    }
}
