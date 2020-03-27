<?php


namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackMenu
{
public static function getAlergenos (){
     return DB::table('alergenos')->select(['id','name','url'])->get();
}

public static function getMenu($id) {
    return DB::table('menu')->select(['id', 'name', 'restaurante_id'])->
    where('restaurante_id',$id)->get();

}

}
