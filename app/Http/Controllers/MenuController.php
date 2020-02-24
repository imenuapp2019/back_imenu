<?php

namespace App\Http\Controllers;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                $menu->name = $request->name;
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
                    $menu->name = $request->name ? $request->name : $menu->name;
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
}
