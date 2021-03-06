@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href=" {{asset('css/menu.css')}}" type="text/css">
    @php
        use App\Helpers\BackMenu;
        $options = BackMenu::getAlergenos();
    @endphp
    @csrf
    <input class="d-none" type="text" id="restaurant_id" value="{{$restaurant_id}}">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6"><h2>Menús</h2></div>
                        <div class="col-md-6 align-items-end">
                            <button class="btn btn-success" name="newMenu" data-toggle="tooltip" data-placement="top"
                                    title="Añadir categoria">
                                <img src="{{asset('images/plus.png')}}"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="accordion col-md-12" id="accordion_menus">
                        @foreach($menus as $menu_key=> $menu)
                            <div class="card" id="{{$menu_key}}">
                                <div class="card-header" id="heading_{{$menu_key}}">
                                    <h2 class="mb-0">
                                        <div class="categoria_name">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapse_{{$menu_key}}" aria-expanded="true"
                                                    aria-controls="collapse_{{$menu_key}}" name="name_menu_{{$menu_key}}">
                                                {{$menu['nombre']}}
                                            </button>
                                        </div>

                                        <div class="d-none name_categoria" id="name_{{$menu_key}}">
                                            <input type="text" placeholder="Nombre de la categoria" name="cat_name_{{$menu_key}}"/>
                                            <button class="editar_categoria btn-dark btn-info btn-category" type="button"
                                                    name="cat_{{$menu_key}}">
                                                Cambiar
                                            </button>
                                        </div>
                                        <button class="btn btn-edit" name="{{$menu_key}}" data-toggle="tooltip"
                                                data-placement="top" title="Editar categoría">
                                            <img src="{{asset('images/edit.png')}}"/>
                                        </button>
                                        <button class="btn btn-drop" name="{{$menu_key}}" data-toggle="tooltip"
                                                data-placement="top" title="Eliminar esta categoría">
                                            <img src="{{asset('images/bin.png')}}"/>
                                        </button>
                                        <button class="addPlate btn btn-warning" name="add-plate-menu_{{$menu_key}}" data-toggle="tooltip"
                                                data-placement="top" title="Añadir plato">
                                            <img src="{{asset('images/plus.png')}}">
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse_{{$menu_key}}" class="collapse show"
                                     aria-labelledby="heading_{{$menu_key}}" data-parent="#accordion_menus">
                                    <div class="card-body">
                                        @if(isset($menu['platos']))
                                            <div class="container">
                                                @foreach($menu['platos'] as $key => $plato)
                                                    <div class="row border-2 plate" id="{{$key}}" name="mp_{{$plato['menu_plate_id']}}">
                                                        <div class="col-md-3">
                                                            <img class="plate_img" src="{{$plato['url_photo']}}">
                                                        </div>
                                                        <div class="col-md-3 justify-content-center"><p
                                                                class="name_plate">{{$plato['nombre']}}</p></div>
                                                        <div class="col-md-3 justify-content-center"><p
                                                                class="pricePlate">{{$plato['precio']}}€</p></div>
                                                        <div class="col-md-3 justify-content-center">
                                                            <button class="btn edit_plate" id="plate_{{$key}}">
                                                                <img src="{{asset('images/edit.png')}}">
                                                            </button>
                                                            <button class="btn quit_plate" id="mp_{{$plato['menu_plate_id']}}" name="plate_{{$key}}">
                                                                <img src="{{asset('images/minus.png')}}">
                                                            </button>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    0
    {{--Modal para crear un menu--}}
    <div class="modal fade" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="newMenulLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenulLabel">Nueva categoría</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="cat_name">Nombre:</label>
                            <input class="form-control" type="text" placeholder="Pon un nombre al menú"
                                   id="cat_name" name="cat_name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="saveMenu">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{--Modal editar plato y asignar menus y alergenos al plato --}}
    <div class="modal fade" id="pruebamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <input id="plate_id" type="text" class="d-none">
                    <div class="container">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#plato" data-toggle="tab">Plato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#galeria" data-toggle="tab">Menús asignados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#alergenos" data-toggle="tab">Alergenos</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="plato" class="container tab-pane active"><br>
                                <input type="text" class="d-none" name="op">
                                <form id="desc_plate">
                                    <div class="form-group">
                                        <label for="plato">Nombre del plato:</label>
                                        <input type="text" class="form-control" id="name" name="name" disabled>
                                    </div>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4">
                                            <img id="image_plate"
                                                 src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                                                 class="img-fluid"
                                                 alt="example placeholder">
                                        </div>
                                        <div class="custom-file d-flex justify-content-center">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            <input type="file" name="image_plate" class="custom-file-input">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="plato">Descripción del plato:</label>
                                        <textarea class="form-control" name="message" rows="10"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity">Precio (Entre 1 y 700€):</label>
                                        <input type="number" id="quantity" name="quantity" min="1" max="700">€
                                    </div>
                                </form>

                            </div>
                            <div id="galeria" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample"
                                           role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Asignar Menús
                                        </a>

                                    </div>
                                </div>
                                <div class="row collapse" id="collapseExample">
                                    <div class="col-md-12 form-group">
                                        <select id="menu" class="js-example-basic-multiple" style="width: 100%" name="menu[]" multiple="multiple">
                                            @foreach($menuplato as $id => $menu)
                                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                                                  @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush" id="menus">
                                            {{--<li class="list-group-item">
                                                Menú 1
                                                <button class="btn btn-light"><img src="{{asset('images/minus.png')}}"></button>
                                            </li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="alergenos" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col-md-12">

                                        <p>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample"
                                               role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Añadir alérgeno
                                            </a>

                                        </p>


                                        <div class="collapse" id="collapseExample">
                                            <select id="alergenos" class="js-example-basic-multiple" style="width: 100%"
                                                    name="alergenos[]" multiple="multiple">
                                                @foreach($options as $id => $alergeno)
                                                    <option value="{{$alergeno->id}}">{{$alergeno->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-group list-group-flush" id="alergenos_list">

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="save" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="asign_plate" tabindex="-1" role="dialog" aria-labelledby="asign_plate"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenulLabel">Añadir plato</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="text" class="d-none" id="add_plate_menu_id">
                            <ul class="list-group list-group-flush" id="alergenos_list">
                                @php
                                    $before = "";
                                        foreach ($plates as $plate) {
                                        if($before != ""){
                                        if($plate->plato_id != $before->plato_id){
                                            echo "<li class='list-group-item'>
                                            $plate->plato_name
                                            <button id='$plate->plato_id' class='add_plate btn btn-dark'><img src='../images/plus.png'></button>
                                        </li>";
                                           }
                                        }else{
                                        echo "<li class='list-group-item'>
                                            $plate->plato_name
                                            <button id='$plate->plato_id' class='add_plate btn btn-dark'><img src='../images/plus.png'></button>
                                        </li>";
                                             }
                                                $before = $plate;
                                        }
                                @endphp

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('js/menus.js')}}"></script>
@endsection
