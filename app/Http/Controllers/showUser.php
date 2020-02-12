<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class showUser extends Controller
{
    public function showUser(Request $request, $id) {

        $response = array('error_code' => 404, 'error_msg' => 'User' .$id. 'not found');
        $user = User::where('id', $id)
        ->get() [0];

        if ($user) {
            return view('vistaUsuario',['users'=>$user]);

        }






        }


    }

