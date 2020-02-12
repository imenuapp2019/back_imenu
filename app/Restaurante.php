<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    public function images(){
        return $this->hasMany('App\ImagenRestaurante');
    }
}
