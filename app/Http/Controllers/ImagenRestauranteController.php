<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    public function delete($id) {
        $response = array('error_code'=>404, 'error_msg' => 'Image '.$id.' not found');
        $imagen = ImagenRestaurante::find($id);

        if (!empty($imagen)) {
            try {
                Storage::delete($imagen->URL);
                $imagen->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Image delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete ImagenRestaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Delete ImagenRestaurante, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return response()->json($response);
    }

}
