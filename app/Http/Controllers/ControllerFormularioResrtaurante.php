<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerFormularioResrtaurante extends Controller
{
   public function callController() {

    return view('Restaurante/formularioMakeRestaurante');


   }

   public function sendData() {



   }
}
