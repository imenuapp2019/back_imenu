<?php

namespace App\Http\Controllers;

use App\FotoPlato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PlatePicture extends Controller
{
    public function create($menu_id = null,$image = null) {
       $response = array('error_code' => 400, 'error_msg' => 'Error inserting info' );
       $foto = new FotoPlato();

        if(!$image) {
            $response['error_msg'] = 'Image is required';

        }elseif(!$menu_id) {
            $response['error_msg'] = 'Menu_id is requiered';

        }else{
            try{
                $path = $image->store('ImgRestaurantes');
                $foto->restaurante_id = $menu_id;
                $foto->URL = $path;
                $foto->save();
                $response = array('error_code'=>200, 'error_msg'=> 'OK');
                Log::info('Picture '.$foto->URL.' created');

            } catch (\Exception $e) {
                Log::alert('Function: Create Picture, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Create FotoPlato, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return response()->json ($response);
    }

    public function delete($id) {
        $response = array('error_code'=>404, 'error_msg'=> 'Picture '.$id.' not found');
        $foto = FotoPlato::find($id);

        if (!empty($foto)) {
            try {
                Storage::delete($foto->URL);
                $foto->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Picture delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Picture, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Delete FotoPlato, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return response()->json($response);
    }
}
