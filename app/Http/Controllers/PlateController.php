<?php

namespace App\Http\Controllers;

use App\Plate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlateController extends Controller
{
    public function getAll() {
        $plates = Plate::all(['name']);
        return response()->json($plates);
      }


      public function create(Request $request) {
          $response = array('error_code' => 400, 'error_msg' => 'Error inserting info' );
          $plate = new Plate;


          if(!$request->name) {
              $response['error_msg'] = 'Name is required';

          }elseif(!$request->price){
             $response['error_msg'] = 'Price is required';

          }else{
              try{

                  $plate->name = ucfirst(strtolower($request->name));
                  $plate->price = $request->price;
                  $plate->save();
                  $response = array('error_code' => 200, 'error_msg' => 'OK');
                  Log::info('Plato '.$plate->name.' creado');

                   }catch (\Exception $e) {

                      Log::alert('Function: Create Plate, Message: '.$e);
                      $response = array('error_code' => 500, 'error_msg' => "Server connection error");

                  }
              } return response()->json($response);


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
              try { $plate->name = $request->name ? ucfirst(strtolower($request->name)) : $plate->name;
                    $plate->price = $request->price ? $request->price : $plate->price;
                    $plate->save();
                    $response = array('error_code' => 200, 'error_msg' => 'OK');
                    Log::info('Type '.$plate->name.' update');

              } catch (\Exception $e) {
                  Log::alert('Function: Update Plate, Message: '.$e);
                  $response = array('error_code' => 500, 'error_msg' => "Server connection error");

              }
          }
          return response()->json($response);



      }

}
