@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href=" {{asset('css/menu.css')}}" type="text/css">
    <script src="{{asset('js/menus.js')}}"></script>

    @php
        // foreach ($menus as $menu){
      //   print($menu);
   //  }

     var_dump($menus);

    @endphp

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6"><h2>Categoria</h2></div>
                        <div class="col-md-6 align-items-end">
                            <button class="btn btn-success" name="newMenu" data-toggle="tooltip" data-placement="top" title="Añadir categoria">
                                <img src="{{asset('images/plus.png')}}"/>
                            </button></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="accordion col-md-12" id="accordion_menus">
                        @foreach($menus as $key=> $menu)
                            <div class="card">
                                <div class="card-header" id="heading_{{$key}}">
                                    <h2 class="mb-0">
                                        <div class="categoria_name">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapse_{{$key}}" aria-expanded="true"
                                                    aria-controls="collapse_{{$key}}" name="name_menu">
                                                {{$menu['nombre']}}
                                            </button>
                                        </div>

                                        <div class="d-none name_categoria" id="name_{{$key}}">
                                            <input type="text" placeholder="Nombre de la categoria"/>
                                            <button class="btn-dark btn-info btn-category" type="button" name="cat_{{$key}}">
                                                Cambiar
                                            </button>
                                        </div>
                                        <button class="btn btn-edit" name="{{$key}}" data-toggle="tooltip" data-placement="top" title="Editar categoría">
                                            <img src="{{asset('images/edit.png')}}"/>
                                        </button>
                                        <button class="btn btn-drop" name="{{$key}}" data-toggle="tooltip" data-placement="top" title="Eliminar esta categoría">
                                            <img src="{{asset('images/bin.png')}}"/>
                                        </button>
                                        <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Añadir plato">
                                            <img src="{{asset('images/plus.png')}}">
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse_{{$key}}" class="collapse show"
                                     aria-labelledby="heading_{{$key}}" data-parent="#accordion_menus">
                                    <div class="card-body">
                                        @if(isset($menu['platos']))
                                            <div class="container">
                                                    @foreach($menu['platos'] as $key => $plato)
                                                    <div class="row border-2 plate" id="{{$key}}">
                                                        <div class="col-md-3">
                                                            <img class="plate_img" src="{{$plato['url_photo']}}">
                                                        </div>
                                                        <div class="col-md-3 justify-content-center"><p class="name_plate">{{$plato['nombre']}}</p></div>
                                                        <div class="col-md-3 justify-content-center"><p>{{$plato['precio']}}€</p></div>
                                                        <div class="col-md-3 justify-content-center">
                                                            <button class="btn edit_plate" id="plate_{{$key}}">
                                                                <img src="{{asset('images/edit.png')}}">
                                                            </button>
                                                            <button class="btn quit_plate" id="plato_{{$key}}">
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
@endsection
