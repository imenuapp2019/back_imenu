<?php

namespace App\Http\Controllers;

use App\Restaurante;
use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestauranteController extends Controller
{
    public function create (Request $request){
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $restaurante = new Restaurante();

        if (!$request->name) {
            $response['error_msg'] = 'Name is requiered';

        }elseif (!$request->address) {
            $response['error_msg'] = 'Address is requiered';

        }elseif (!$request->latitude) {
            $response['error_msg'] = 'Latitude is requiered';

        }elseif (!$request->longitude) {
            $response['error_msg'] = 'Longitude is requiered';

        }elseif (!$request->phone_number) {
            $response['error_msg'] = 'Phone number is requiered';

        }elseif (strlen((string)$request->phone_number) != 9) {
            $response['error_msg'] = 'Phone number must have 9 characters';

        }elseif (!$request->tipo_id) {
            $response['error_msg'] = 'Type is requiered';

        }else {
            try {
                $restaurante->name = ucfirst(strtolower($request->name));
                $restaurante->address = ucfirst(strtolower($request->address));
                $restaurante->latitude = $request->latitude;
                $restaurante->longitude = $request->longitude;
                $restaurante->phone_number = $request->phone_number;
                $restaurante->tipo_id = $request->tipo_id;
                $restaurante->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Restaurant '.$restaurante->name.' create');

            } catch (\Exception $e) {

                Log::alert('Function: Create Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }

        }
        Log::critical('Function: Create Restaurante, Code: '.$response['error_code'].'Message: '.$response['error_msg']);
        return redirect()->route('home');
    }

    public function delete($id){
        $response = array('error_code' => 404, 'error_msg' => 'Restaurant '.$id.' not found');
        $restaurante = Restaurante::find($id);

        if (!empty($restaurante)) {
            try {
                $restaurante->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Restaurant delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Delete Restaurante, Code: '.$response['error_code'].'Message: '.$response['error_msg']);
        return redirect()->route('home');
    }

    public function update(Request $request, $id){
        $response = array('error_code' => 404, 'error_msg' => 'Restaurant '.$id.' not found');
        $restaurante = Restaurante::find($id);

        if (isset($request) && isset($id) && !empty($restaurante)) {
            try {
                $restaurante->name = $request->name ? ucfirst(strtolower($request->name)) : $restaurante->name;
                $restaurante->address = $request->address ? ucfirst(strtolower($request->address)) : $restaurante->address;
                $restaurante->latitude = $request->latitude ? $request->latitude : $restaurante->latitude;
                $restaurante->longitude = $request->longitude ? $request->longitude : $restaurante->longitude;
                $restaurante->phone_number = $request->phone_number ? $request->phone_number : $restaurante->phone_number;
                $restaurante->tipo_id = $request->tipo_id ? $request->tipo_id : $restaurante->tipo_id;
                $restaurante->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Restaurant '.$restaurante->name.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Update Restaurante, Code: '.$response['error_code'].'Message: '.$response['error_msg']);
        $foodtype = Tipo::all();
        return redirect()->route('update', ['restaurants'=>$restaurante, 'type'=>$foodtype, 'change'=>true]);
    }

    public function home(){
        $restaurante = DB::table('restaurantes as r')
            ->select('r.name', 't.name as type', 'i.URL as image_URL', 'r.latitude', 'r.longitude')
            ->join('tipos as t', 'r.tipo_id', '=', 't.id')
            ->leftJoin('imagen_restaurantes as i', 'i.restaurante_id', '=', 'r.id')
            ->get();

        return response()->json($restaurante);
    }

    public function returnAll(){
        $restaurante = DB::table('restaurantes as r')
            ->select('r.id', 'r.name', 't.name as type', 'i.URL as image_URL', 'r.phone_number', 'r.address', 'r.latitude', 'r.longitude')
            ->join('tipos as t', 'r.tipo_id', '=', 't.id')
            ->leftJoin('imagen_restaurantes as i', 'r.id', '=', 'i.restaurante_id')
            ->get();

        return response()->json($restaurante);
    }

    public function search(Request $request){
        $restaurante = DB::table('restaurantes as r')
            ->select('r.name', 't.name as type', 'i.URL as image_URL', 'r.latitude', 'r.longitude')
            ->join('tipos as t', 'r.tipo_id', '=', 't.id')
            ->leftJoin('imagen_restaurantes as i', 'i.restaurante_id', '=', 'r.id')
            ->where('r.name', 'LIKE', '%'.$request->name.'%')
            ->get();

        return response()->json($restaurante);
    }

   public function showRestaurant( Request $request, $id) {

    $response = array('error_code' => 404, 'error_msg' => 'Restaurant' .$id. 'not found');
    $restaurante = Restaurante::find($id);

    if( $restaurante) {
        return view('vistaRestaurante');
    }


   }

}
