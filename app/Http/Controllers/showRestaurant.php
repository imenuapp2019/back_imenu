<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use App\Restaurante;
use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class showRestaurant extends Controller
{
    public function showRestaurant($id) {
        $rest = Restaurante::find($id);
        $foodtype = Tipo::all();
        $images = ImagenRestaurante::all()
            ->where('restaurante_id', $id);

        if( $rest) {
            return view('vistaRestaurante',['restaurante'=>$rest, 'fotos' => $images, 'tipo'=>$foodtype]);
        }
    }
}
