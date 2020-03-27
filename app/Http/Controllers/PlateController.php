<?php

namespace App\Http\Controllers;

use App\Plate;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlateController extends Controller
{
    public function create(Request $request) {
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info' );
        $plate = new Plate;


        if(!$request->name) {
            $response['error_msg'] = 'Name is required';

        }elseif(!$request->price){
            $response['error_msg'] = 'Price is required';

        }elseif(!$request->menu_id){
            $response['error_msg'] = 'Menu is required';

        }else{
            try{
                $plate->name = ucfirst(strtolower($request->name));
                $plate->price = $request->price;
                $plate->menu_id = $request->menu_id;
                $plate->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Plato '.$plate->name.' creado');

            }catch (\Exception $e) {
                Log::alert('Function: Create Plate, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

      public function delete($id) {
        $response = array('error_code' => 404, 'error_msg' => 'Plate '.$id.' not found');
        $plate = Plate::find($id);
        if (!empty($plate)) {
            try {
                $plate->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Plate delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Plate, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);

      }

      public function update(Request $request, $id) {
        $response = array('error_code' => 404, 'error_msg' => 'Plate '.$id.' not found');
        $plate = Plate::find($id);

        if (isset($request) && isset($id) && !empty($plate)) {
            try {
                $plate->name = $request->name ? ucfirst(strtolower($request->name)) : $plate->name;
                $plate->price = $request->price ? $request->price : $plate->price;
                $plate->menu_id = $request->menu_id ? $request->menu_id : $plate->menu_id;
                $plate->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Plate '.$plate->name.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update Plate, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }



    //Seccion para peticiones ajax via web//
    public function getAlergenos(Request $r){
        try{
            $alergenos =  DB::table('plato_contiene_alergenos as pa')
                ->join('alergenos as a', 'a.id','=','pa.alergenos_id')
                ->where('pa.plate_id',$r->plate_id)
                ->select(['pa.id','a.name','a.url'])
                ->get();
            return response()->json($alergenos,200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

    }

     public function savePlate(Request $r){
        /* var_dump($r->plate_id);
         var_dump($r->image_plate);
         var_dump($r->message);
         var_dump($r->alergenos);*/

        try{
           $plate = Plate::find($r->plate_id);
            $plate->price = $r->quantity;
            $plate->save();
            //Asign menu to plate
            if(!empty($r->menus)){
                DB::table('menu_platos')->where('plato_id',$r->plate_id)->updateOrInsert(['menu_id' =>$r->menus]);
            }
            if(!empty($alergenos)){
                //Asign alergenos to plate
                $alergenos = explode(',',$r->alergenos);
                foreach ($alergenos as $al){
                    DB::table('plato_contiene_alergenos')->insertOrIgnore(['alergenos_id' =>$al,'plate_id'=>$r->plate_id]);
                }
            }
            if(!is_null($r->image_plate)){
              // print($r->image_plate->getClientOriginalName());
                DB::table('foto_plato')->where('plate_id',$r->plate_id)->update(['URL'=>$r->image_plate->getClientOriginalName()]);
            }
            if(!empty($r->menus)){
                $menus = explode(',',$r->menus);
                foreach ($menus as $menu) {
                    DB::table('menu_platos')->insertOrIgnore(['menu_id' => $menu,'plato_id'=>$r->plate_id]);
                }
            }
            return response()->json("ok",200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

     }
}
