<?php

namespace App\Http\Controllers;

use App\RedesSociales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RedesSocialesController extends Controller
{
    public function create (Request $request){
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $rrss = new RedesSociales();

        if (!$request->nombre) {
            $response['error_msg'] = 'Name is requiered';

        }elseif (!$request->URL) {
            $response['error_msg'] = 'URl is requiered';

        }elseif (!$request->restaurante_id) {
            $response['error_msg'] = 'Restaurant is requiered';

        }else {
            try {
                $rrss->nombre = ucfirst(strtolower($request->nombre));
                $rrss->URL = $request->URL;
                $rrss->restaurante_id = $request->restaurante_id;
                $rrss->save();

                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Social Media '.$rrss->nombre.' create of '.$rrss->nombre);

            } catch (\Exception $e) {

                Log::alert('Function: Create Social Media, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }

        }
        Log::critical('Function: Create Social Media, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return redirect()->route('home');
    }

    public function delete($id){
        $response = array('error_code' => 404, 'error_msg' => 'Restaurant '.$id.' not found');
        $rrss = RedesSociales::find($id);

        if (!empty($rrss)) {
            try {
                $rrss->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Social Media delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Social Media, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Delete Social Media, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return redirect()->route('home');
    }

    public function update(Request $request, $id){
        $response = array('error_code' => 404, 'error_msg' => 'Restaurant '.$id.' not found');
        $rrss = RedesSociales::find($id);

        if (isset($request) && isset($id) && !empty($rrss)) {
            try {
                $rrss->nombre = $request->nombre ? ucfirst(strtolower($request->nombre)) : $rrss->nombre;
                $rrss->URL = $request->URL ? $request->URL : $rrss->URL;
                $rrss->restaurante_id = $request->restaurante_id ? $request->restaurante_id : $rrss->restaurante_id;
                $rrss->save();

                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Social Media '.$rrss->nombre.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update Social Media, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Update Social Media, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return redirect()->route('home');
    }
}
