<?php

namespace App\Http\Controllers;

use App\Restaurante;
use App\Tipo;
use Illuminate\Http\Request;

class RestUpdateViewController extends Controller
{
    public function index($id){
        $data = Restaurante::find($id);
        $foodtype = Tipo::all();
        return view('restaurantupdate', ['restaurants'=>$data, 'type'=>$foodtype]);
    }
}
