<?php

namespace App\Http\Controllers;

use App\Restaurante;
use App\Tipo;
use Illuminate\Http\Request;

class RestUpdateViewController extends Controller
{
    public function index(Request $request, $id){
        $change = false;
        $data = Restaurante::find($id);
        $foodtype = Tipo::all();
        if (isset($request->change)) {
            $change = $request->change;
        }
        return view('restaurantupdate', ['restaurants'=>$data, 'type'=>$foodtype, 'change'=>$change]);
    }
}
