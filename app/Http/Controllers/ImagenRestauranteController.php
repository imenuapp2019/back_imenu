<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImagenRestauranteController extends Controller
{
  public function create($restaurante_id = null,$image = null) {
        $response = array('error_code' =>400, 'error_msg' => 'Error inserting info');
        $imagen = new ImagenRestaurante();

        if(!$image) {
            $response['error_msg'] = 'Image is required';

        }elseif(!$restaurante_id) {
            $response['error_msg'] = 'Restaurante_id is requiered';

        }else{
            try{
                $path = $image->store('ImgRestaurantes');
                $imagen->restaurante_id = $restaurante_id;
                $imagen->URL = $path;
                $imagen->save();
                $response = array('error_code'=>200, 'error_msg' => 'OK');
                Log::info('Image '.$imagen->URL.' from restaurant '.$imagen->restaurante_id.' create');

            } catch (\Exception $e) {
                Log::alert('Function: Create ImagenRestaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");
            }

        }
        Log::critical('Function: Create ImagenRestaurante, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return response()->json ($response);
    }
    //posible eliminacion del metodo update completo
    public function update(Request $request, $id){
        $response = array('error_code'=> 404, 'error_msg'=> 'Image '.$id.' not found');
        $imagen = ImagenRestaurante::find($id);

        if (isset($request) && isset($id) && !empty($imagen)) {
            try {
                $imagen->URL = $request->URL ? $request->URL : $imagen->URL;
                $imagen->restaurante_id = $request->restaurante_id ? $request->restaurante_id : $imagen->restaurante_id ;
                $imagen->save();
                $response = array('error_code'=>200, 'error_msg'=> 'OK');
                Log::info('Image '.$imagen->URL.' from restaurant '.$imagen->restaurante_id.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update ImagenRestaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

    public function delete($id) {
        $response = array('error_code'=>404, 'error_msg' => 'Image '.$id.' not found');
        $imagen = ImagenRestaurante::find($id);

        if (!empty($imagen)) {
            try {
                $imagen->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Image delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete ImagenRestaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

}
