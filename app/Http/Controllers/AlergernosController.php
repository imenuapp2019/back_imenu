<?php

namespace App\Http\Controllers;

use App\alergenos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlergernosController extends Controller
{
    public function create(Request $request) {
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info' );
        $alergeno = new alergenos;

        if(!$request->name) {
            $response['error_msg'] = 'Name is required';

        }elseif(!$request->URL){
           $response['error_msg'] = 'URL is required';

        }else{
            try{
                $alergeno->name = ucfirst(strtolower($request->name));
                $alergeno->URL = $request->URL;
                $alergeno->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Alergeno '.$alergeno->name.' creado');

            }catch (\Exception $e) {
                Log::alert('Function: Create Alergeno, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }

    public function delete($id) {
        $response = array('error_code' => 404, 'error_msg' => 'Alergeno '.$id.' not found');
        $alergeno = alergenos::find($id);
        if (!empty($alergeno)) {
            try {
                $alergeno->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Alergeno delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Alergeno, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);

    }

    public function update(Request $request, $id) {
        $response = array('error_code' => 404, 'error_msg' => 'Alergeno '.$id.' not found');
        $alergeno = alergenos::find($id);

        if (isset($request) && isset($id) && !empty($alergeno)) {
            try { $alergeno->name = $request->name ? ucfirst(strtolower($request->name)) : $alergeno->name;
                  $alergeno->URL = $request->URL ? $request->URL : $alergeno->URL;
                  $alergeno->save();
                  $response = array('error_code' => 200, 'error_msg' => 'OK');
                  Log::info('Alergeno '.$alergeno->name.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update Alergeno, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        return response()->json($response);
    }
}
