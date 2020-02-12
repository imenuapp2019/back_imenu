<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use App\Restaurante;
use App\Tipo;
use Illuminate\Http\Request;

class RestUpdateViewController extends Controller
{
    public function index(Request $request, $id){
        $change = false;
        $rest = Restaurante::find($id);
        $foodtype = Tipo::all();
        $images = ImagenRestaurante::all()
            ->where('restaurante_id', $id);
        if (isset($request->change)) {
            $change = $request->change;
        }
        return view('restaurantupdate', ['restaurants'=>$rest, 'type'=>$foodtype, 'change'=>$change, 'images'=>$images]);
    }
}
