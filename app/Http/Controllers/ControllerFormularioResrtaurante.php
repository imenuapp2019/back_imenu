<?php

namespace App\Http\Controllers;

use App\Tipo;

class ControllerFormularioResrtaurante extends Controller
{
   public function callController() {
    $foodtype = Tipo::all();

    return view('formularioMakeRestaurante', ['type'=>$foodtype]);
   }
}
