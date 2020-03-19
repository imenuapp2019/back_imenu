<?php

namespace App\Http\Controllers;
use App\Menu;
use App\Plate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class MenuController extends Controller
{
        public function create(Request $request) {
            $response = array('error_code' =>400, 'error_msg' => 'Error inserting info');
            $menu = new Menu();

            if(!$request->name) {
                $response['error_msg'] = 'name is required';

            }elseif(!$request->restaurante_id) {
                $response['error_msg'] = 'Restaurante_id is requiered';

            }else{
                try{
                    $menu->restaurante_id = $request->restaurante_id;
                    $menu->name = ucfirst(strtolower($request->name));
                    $menu->save();
                    $response = array('error_code'=>200, 'error_msg' => 'OK');
                    Log::info('Menu '.$menu->name.' from restaurant '.$menu->restaurante_id.' create');

                } catch (\Exception $e) {
                    Log::alert('Function: Create Menu, Message: '.$e);
                    $response = array('error_code' => 500, 'error_msg' => "Server connection error");

                }
            }
            return response()->json ($response);
        }

        public function update(Request $request, $id){
            $response = array('error_code'=> 404, 'error_msg'=> 'Menu '.$id.' not found');
            $menu = Menu::find($id);

            if (isset($request) && isset($id) && !empty($menu)) {
                try {
                    $menu->name = $request->name ? ucfirst(strtolower($request->name)) : $menu->name;
                    $menu->restaurante_id = $request->restaurante_id ? $request->restaurante_id : $menu->restaurante_id ;
                    $menu->save();
                    $response = array('error_code'=>200, 'error_msg'=> 'OK');
                    Log::info('Menu '.$menu->name.' from restaurant '.$menu->restaurante_id.' update');

                } catch (\Exception $e) {
                    Log::alert('Function: Update Menu, Message: '.$e);
                    $response = array('error_code' => 500, 'error_msg' => "Server connection error");

                }
            }
            return response()->json($response);
        }

        public function delete($id) {
            $response = array('error_code'=>404, 'error_msg' => 'Menu '.$id.' not found');
            $menu = Menu::find($id);

            if (!empty($menu)) {
                try {
                    $menu->delete();
                    $response = array('error_code' => 200, 'error_msg' => 'OK');
                    Log::info('Menu delete');

                } catch (\Exception $e) {
                    Log::alert('Function: Delete Menu, Message: '.$e);
                    $response = array('error_code' => 500, 'error_msg' => "Server connection error");

                }
            }
            return response()->json($response);
        }

    /**
     * Vista menus de restarurante con sus platos.
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
        public function index($slug){
            $result = DB::table('menu_platos as mp')->
            leftJoin('plate as p','mp.plato_id','p.id')->
            rightJoin('menu as m','m.id','mp.menu_id')->
                leftJoin('foto_plato as fp','fp.plate_id','p.id')->
            select('m.id as menu_id' ,'m.name as menu_name','p.id as plato_id','p.name as plato_name','p.price','fp.id as id_photo','fp.url')->
            where('m.restaurante_id',$slug)->get();

            $menus = [];

            foreach ($result as $item){
                if(isset($menus[$item->menu_id])){
                    $menus[$item->menu_id]['platos'][$item->plato_id] = ['nombre'=>$item->plato_name,'precio' =>$item->price,'photo_id'=>$item->id_photo,'url_photo'=>$item->url];
                }else{
                    $menus[$item->menu_id] = [
                        'nombre' => $item->menu_name,
                        'platos' => []
                    ];
                    if($item->plato_id){
                        $menus[$item->menu_id]['platos'][$item->plato_id] = ['nombre'=>$item->plato_name,'precio' =>$item->price,'photo_id'=>$item->id_photo,'url_photo'=>$item->url];
                    }
                }
            }
            return view('menuView',['menus'=> $menus]);
        }
        public function newMenu(Request $request){
                try{
                    $menu = new Menu();
                    $menu->name = $request->name;
                    $menu->restaurante_id = $request->local;
                    $menu->save();
                    return response()->json("ok",200);
                }catch (Exception $e){
                    return response()->json($e->getMessage(),500);
                }

        }
        public function editMenu(Request $request){
            try{
                Menu::where('id',$request->id)->update(['name'=>$request->name]);
                return response()->json("ok",200);
            }catch (\Exception $e){
                return response()->json($e->getMessage(),500);
            }
        }

        public function quitPlatefromMenu(Request $request){
            try{
                $borrados = DB::table('menu_platos')->where('menu_id',$request->menu_id)->where('plato_id',$request->plate_id)->delete();
                return response()->json($borrados,200);
            }catch(\Exception $e){
                return response()->json($e->getMessage(),500);
            }
        }

        public function getMenusAssign(Request $r){
            try{
                $menus = DB::table('menu_platos as mp')->
                join('menu as m','mp.menu_id','m.id')->
                    where('plato_id',$r->id)->
                select('m.id','m.name')->
                get();
                return response()->json($menus,200);
            }catch (\Exception $e){
                return response()->json($e->getMessage(),200);
            }
        }

}
