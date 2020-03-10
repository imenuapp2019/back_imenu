<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use App\Restaurante;
use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class showPlateController extends Controller
{
    public function index(Request $request, $id){
        $result = DB::table('plate as p')->
        join('menu_platos as mp','p.id','mp.plato_id')->
        rightJoin('menu as m','m.id','mp.menu_id')->
            leftJoin('foto_plato as fp','fp.plate_id','p.id')->
            leftjoin('plato_contiene_alergenos as pca', 'p.id', 'pca.plato_id')->
                leftjoin('alergenos as a','pca.alergenos_id','a.id')->
        select('m.id as menu_id' ,'m.name as menu_name','p.id as plato_id','p.name as plato_name','p.price','fp.id as id_photo','fp.url')->
        where('m.restaurante_id',$id)->get();
        $platos = [];
        foreach ($result as $item){
            if(isset($platos[$item->plato_id])){
                $platos[$item->plato_id]['platos'][$item->menu_id] = ['nombre'=>$item->plato_name,'precio' =>$item->price,'photo_id'=>$item->id_photo,'url_photo'=>$item->url,'alergenos'=>$item->alergenos];
            }else{
                $menus[$item->menu_id] = [
                    'nombre' => $item->plato_name,
                    'menus' => []
                ];
                if($item->plato_id){
                    $menus[$item->menu_id]['menus'][$item->menu_id] = ['nombre'=>$item->menu_name,'precio' =>$item->price,'photo_id'=>$item->id_photo,'url_photo'=>$item->url];
                }
            }
        }
        return view('platos', ['platos'=>$platos, 'menu'=>$menus]);
    }
}
