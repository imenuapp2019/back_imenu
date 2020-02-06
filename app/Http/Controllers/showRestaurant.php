<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use App\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class showRestaurant extends Controller
{
    public function showRestaurant($id) {

        $response = array('error_code' => 404, 'error_msg' => 'Restaurant' .$id. 'not found');
        $restaurante = Restaurante::find($id);
        $fotorestaurante = DB::table('imagen_restaurantes')->select('restaurante_id', 'URL')->where('restaurante_id', $id)->get();





        if( $restaurante) {
            return view('vistaRestaurante',['restaurante'=>$restaurante,"fotos" => $fotorestaurante]);
        }


    }
}
