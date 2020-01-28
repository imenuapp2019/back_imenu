<?php

namespace App\Http\Controllers;

use App\Restaurante;
use Illuminate\Http\Request;

class RestUpdateViewController extends Controller
{
    public function index(){
        $data = Restaurante::all();
        return view('restaurantupdate', ['restaurants'=>$data]);
    }
}
