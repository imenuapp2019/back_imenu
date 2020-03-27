<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class BackMenu
{
public static function getAlergenos (){
     return DB::table('alergenos')->select(['id','name','url'])->get();
}

}
