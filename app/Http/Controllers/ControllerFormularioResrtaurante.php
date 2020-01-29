<?php

namespace App\Http\Controllers;

use App\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ControllerFormularioResrtaurante extends Controller


{
   public function callController() {

    return view('Restaurante/formularioMakeRestaurante');


   }




}
