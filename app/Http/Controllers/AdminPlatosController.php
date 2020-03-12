<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPlatosController extends Controller
{
    public function showPlate() {
        return view('adminPlato');
    }
}
