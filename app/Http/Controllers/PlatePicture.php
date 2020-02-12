<?php

namespace App\Http\Controllers;

use App\FotoPlato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlatePicture extends Controller
{
    public function getAll() {
        $fotos = FotoPlato::all(['URL']);
        return response()->json($fotos);

    }

    public function create( Request $request) {
       $response = array('error_code' => 400, 'error_msg' => 'Error inserting info' );
       $foto = new FotoPlato;

        if (!$request->URL){
            $response['error_msg'] = 'URL is requiered';

        }else{
            try{
                $foto->URL = ($request->URL);
                $foto->save();
                $response = array('error_code'=>200, 'error_msg'=> 'OK');
                Log::info('Type '.$foto->URL.' created');

            } catch (\Exception $e) {
                Log::alert('Function: Create Foto, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }


    public function update(Request $request, $id ) {
        $response = array('error_code'=> 404, 'error_msg'=> 'Type '.$id.' not found');
        $foto = FotoPlato::find($id);

        if (isset($request) && isset($id) && !empty($foto)) {
            try {
                $foto->URL = $request->URL ? ($request->name) : $foto->name;
                $foto->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Type '.$foto->URL.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update Foto, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

    public function delete($id) {
        $response = array('error_code'=>404, 'error_msg'=> 'Type '.$id.' not found');
        $foto = FotoPlato::find($id);

        if (!empty($foto)) {
            try {
                $foto->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Picture delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Photo, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }
}
