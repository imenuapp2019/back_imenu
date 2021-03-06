<?php

namespace App\Http\Controllers;

use App\ImagenRestaurante;
use App\Restaurante;
use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

        }elseif (!$request->description) {
            $response['error_msg'] = 'Description is requiered';

        }else {
            try {
                $restaurante->name = ucfirst(strtolower($request->name));
                $restaurante->address = ucfirst(strtolower($request->address));
                $restaurante->latitude = $request->latitude;
                $restaurante->longitude = $request->longitude;
                $restaurante->phone_number = $request->phone_number;
                $restaurante->tipo_id = $request->tipo_id;
                $restaurante->description = $request->description;
                $restaurante->save();

                if (isset($request->images)) {
                    foreach ($request->images as $image) {
                        app(ImagenRestauranteController::class)->create($restaurante->id, $image);
                    }
                }else {
                    Log::info('Sin imagenes');
                }
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Restaurant '.$restaurante->name.' create');

            } catch (\Exception $e) {

                Log::alert('Function: Create Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }

        }
        Log::critical('Function: Create Restaurante, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        return redirect()->route('home');
    }

    public function delete($id){
        $response = array('error_code' => 404, 'error_msg' => 'Restaurant '.$id.' not found');
        $restaurante = Restaurante::find($id);

        if (!empty($restaurante)) {
            try {
                foreach ($restaurante->images as $image) {
                    app(ImagenRestauranteController::class)->delete($image->id);
                }
                $restaurante->delete();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Restaurant delete');

            } catch (\Exception $e) {
                Log::alert('Function: Delete Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Delete Restaurante, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
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
                $restaurante->description = $request->description ? $request->description : $restaurante->description;
                $restaurante->save();

                if (isset($request->deleteImages)) {
                    foreach ($request->deleteImages as $image) {
                        app(ImagenRestauranteController::class)->delete($image);
                    }
                } else {
                    Log::info('Sin imagenes');
                }

                if (isset($request->images)) {
                    foreach ($request->images as $imagen) {
                        app(ImagenRestauranteController::class)->create($restaurante->id, $imagen);
                    }
                }else {
                    Log::info('Sin imagenes');
                }

                $response = array('error_code' => 200, 'error_msg' => 'OK');
                Log::info('Restaurant '.$restaurante->name.' update');

            } catch (\Exception $e) {
                Log::alert('Function: Update Restaurante, Message: '.$e);
                $response = array('error_code' => 500, 'error_msg' => "Server connection error");

            }
        }
        Log::critical('Function: Update Restaurante, Code: '.$response['error_code'].' Message: '.$response['error_msg']);
        $foodtype = Tipo::all();
        $images = ImagenRestaurante::all()
            ->where('restaurante_id', $id);
        return redirect()->route('editar_restaurante', ['restaurants'=>$restaurante, 'type'=>$foodtype, 'change'=>true, 'images'=>$images]);
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
            ->select('r.id', 'r.name', 'r.description', 't.name as type', 'i.URL as image_URL', 'r.phone_number', 'r.address', 'r.latitude', 'r.longitude')
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

    public function tiposRestaurante(){
        $tipos = DB::table('tipos')
            ->select("*")
            ->get();
        return response()->json($tipos);
    }

    public function principal(){
        $restaurantes = DB::table('restaurantes as r')
            ->select(
                'r.id', 'r.name', 'r.description', 'r.address', 'r.latitude', 'r.longitude', 'r.phone_number',
                't.name as type',
                'i.id as image_id', 'i.URL as image_URL',
                'rs.id as rrss_id', 'rs.nombre as rrss_name', 'rs.URL as rrss_URL',
                'm.id as menu_id', 'm.name as menu_name',
                'p.id as plato_id', 'p.name as plato_name', 'p.price as plato_precio',
                'fp.id as fotoplato_id', 'fp.URL as fotoplato_URL',
                'a.id as alergenos_id', 'a.name as alergenos_name', 'a.URL as icono')
            ->join('tipos as t', 'r.tipo_id', '=', 't.id')
            ->leftJoin('imagen_restaurantes as i', 'r.id', '=', 'i.restaurante_id')
            ->leftJoin('redes_sociales as rs', 'r.id', '=', 'rs.restaurante_id')
            ->leftJoin('menu as m', 'r.id', '=', 'm.restaurante_id')
            ->leftJoin('menu_platos as mp', 'm.id', '=', 'mp.menu_id')
            ->leftJoin('plate as p', 'p.id', '=', 'mp.plato_id')
            ->leftJoin('foto_plato as fp', 'p.id', '=', 'fp.plate_id')
            ->leftJoin('plato_contiene_alergenos as pa', 'p.id', '=', 'pa.plate_id')
            ->leftJoin('alergenos as a', 'a.id', '=', 'pa.alergenos_id')
            ->get();

        $lista = [];
        foreach ($restaurantes as $restaurante) {
            if (!isset($lista[$restaurante->id])) {
                $lista[$restaurante->id] = [
                    'id' => $restaurante->id,
                    'nombre' => $restaurante->name,
                    'descripcion' => $restaurante->description,
                    'direccion' => $restaurante->address,
                    'latitud' => $restaurante->latitude,
                    'longitud' => $restaurante->longitude,
                    'telefono' => $restaurante->phone_number,
                    'tipo' => $restaurante->type,
                    'imagenes' => [],
                    'RRSS' =>[],
                    'Menu' =>[]
                ];
                if ($restaurante->image_id) {
                    $lista[$restaurante->id]['imagenes'][] =
                    ['id' => $restaurante->image_id,
                    'url' => $restaurante->image_URL];
                }
                if ($restaurante->rrss_id) {
                    $lista[$restaurante->id]['RRSS'][] =
                    ['id' => $restaurante->rrss_id,
                    'nombre' => $restaurante->rrss_name,
                    'url' => $restaurante->rrss_URL];
                }
                if ($restaurante->menu_id) {
                    $lista[$restaurante->id]['Menu'][] =
                    ['id' => $restaurante->menu_id,
                    'nombreCategoria' => $restaurante->menu_name,
                    'platos' =>[]
                    ];
                    if ($restaurante->plato_id) {
                        $lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'][] =
                        ['id' => $restaurante->plato_id,
                        'nombre' => $restaurante->plato_name,
                        'precio' => $restaurante->plato_precio,
                        'imagenes' => [],
                        'alergenos' =>[]
                        ];
                        if ($restaurante->fotoplato_id) {
                            $lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'][count($lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'])-1]['imagenes'][] =
                            ['id' => $restaurante->fotoplato_id,
                            'url' => $restaurante->fotoplato_URL];
                        }
                        if ($restaurante->alergenos_id) {
                            $lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'][count($lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'])-1]['alergenos'][] =
                            ['id' => $restaurante->alergenos_id,
                            'nombre' => $restaurante->alergenos_name,
                            'icono' => $restaurante->icono];
                        }
                    }
                }
            }else {
                if ($restaurante->image_id) {
                    $encontradoImage = false;
                    foreach ($lista[$restaurante->id]['imagenes'] as $image) {
                        if($image['id'] == $restaurante->image_id){
                            $encontradoImage = true;
                        }
                    }
                    if(!$encontradoImage){
                        $lista[$restaurante->id]['imagenes'][] =
                        ['id' => $restaurante->image_id,
                        'url' => $restaurante->image_URL];
                    }
                }

                if ($restaurante->rrss_id) {
                    $encontradoRRSS = false;
                    foreach ($lista[$restaurante->id]['RRSS'] as $rrss) {
                        if($rrss['id'] == $restaurante->rrss_id){
                            $encontradoRRSS = true;
                        }
                    }
                    if(!$encontradoRRSS){
                        $lista[$restaurante->id]['RRSS'][] =
                        ['id' => $restaurante->rrss_id,
                        'nombre' => $restaurante->rrss_name,
                        'url' => $restaurante->rrss_URL];
                    }
                }

                if ($restaurante->menu_id) {
                    $encontradoMenu = false;
                    foreach ($lista[$restaurante->id]['Menu'] as $menu) {
                        if($menu['id'] == $restaurante->menu_id){
                            $encontradoMenu = true;
                        }
                    }
                    if(!$encontradoMenu){
                        $lista[$restaurante->id]['Menu'][] =
                            ['id' => $restaurante->menu_id,
                            'nombreCategoria' => $restaurante->menu_name,
                            'platos' =>[]
                            ];
                        if ($restaurante->plato_id) {
                            $lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'][] =
                            ['id' => $restaurante->plato_id,
                            'nombre' => $restaurante->plato_name,
                            'precio' => $restaurante->plato_precio,
                            'imagenes' => [],
                            'alergenos' =>[]
                            ];
                            if ($restaurante->fotoplato_id) {
                                $lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'][count($lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'])-1]['imagenes'][] =
                                ['id' => $restaurante->fotoplato_id,
                                'url' => $restaurante->fotoplato_URL];
                            }
                            if ($restaurante->alergenos_id) {
                                $lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'][count($lista[$restaurante->id]['Menu'][count($lista[$restaurante->id]['Menu'])-1]['platos'])-1]['alergenos'][] =
                                ['id' => $restaurante->alergenos_id,
                                'nombre' => $restaurante->alergenos_name,
                                'icono' => $restaurante->icono];
                            }
                        }
                    }else if($restaurante->plato_id){
                        foreach ($lista[$restaurante->id]['Menu'] as $index => $menu) {
                            if ($menu['id'] == $restaurante->menu_id) {
                                $encontradoPlatos = false;
                                foreach ($menu['platos'] as $plato) {
                                    if ($plato['id'] == $restaurante->plato_id) {
                                        $encontradoPlatos = true;
                                    }
                                }
                                if (!$encontradoPlatos) {
                                    $menu['platos'][] =
                                    ['id' => $restaurante->plato_id,
                                        'nombre' => $restaurante->plato_name,
                                        'precio' => $restaurante->plato_precio,
                                        'imagenes' =>[
                                            ['id' => $restaurante->fotoplato_id,
                                            'url' => $restaurante->fotoplato_URL]
                                        ],
                                        'alergenos' =>[]
                                    ];
                                    if ($restaurante->alergenos_id) {
                                        $menu['platos'][count($menu['platos'])-1]['alergenos'][] =
                                        ['id' => $restaurante->alergenos_id,
                                        'nombre' => $restaurante->alergenos_name,
                                        'icono' => $restaurante->icono];
                                    }
                                    $lista[$restaurante->id]['Menu'][$index] = $menu;
                                }else if($restaurante->alergenos_id){
                                    foreach ($menu['platos'] as $posicion => $plato) {
                                        if($plato['id'] == $restaurante->plato_id){
                                            $encontradoAlergeno = false;
                                            foreach ($plato['alergenos'] as $key => $alergeno) {
                                                if ($alergeno['id'] == $restaurante->alergenos_id) {
                                                    $encontradoAlergeno = true;
                                                }
                                            }
                                            if(!$encontradoAlergeno){
                                                $plato['alergenos'][] =
                                                        ['id' => $restaurante->alergenos_id,
                                                        'nombre' => $restaurante->alergenos_name,
                                                        'icono' => $restaurante->icono];

                                                $menu['platos'][$posicion] = $plato;
                                                $lista[$restaurante->id]['Menu'][$index] = $menu;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $listaFinal = [];
        foreach ($lista as $key => $value) {
            array_push($listaFinal,$value);
        }
        return $listaFinal;
    }
}
