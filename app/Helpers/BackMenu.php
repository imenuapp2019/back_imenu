<?php


namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackMenu
{
public static function getAlergenos (){
     return DB::table('alergenos')->select(['id','name','url'])->get();
}
public static function getPlatesFromRestaurant($id){
    $result = DB::table('plate as p')->
    join('menu_platos as mp','p.id','mp.plato_id')->
    rightJoin('menu as m','m.id','mp.menu_id')->
    leftJoin('foto_plato as fp','fp.plate_id','p.id')->
    select('m.id as menu_id' ,'m.name as menu_name','p.id as plato_id','p.name as plato_name','p.price','fp.id as id_photo','fp.url')->
        distinct()->
    where('m.restaurante_id',$id)->get();
    if(!is_null($result)){
        return $result;
    }else{
        return "";
    }
}

public static function getMenu($id) {
    return DB::table('menu')->select(['id', 'name', 'restaurante_id'])->
    where('restaurante_id',$id)->get();

}

}
