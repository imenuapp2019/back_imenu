@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href=" {{asset('css/menu.css')}}" type="text/css">
    <script src="{{asset('js/menus.js')}}"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    @php
        // foreach ($menus as $menu){
      //   print($menu);
   //  }

     var_dump($menus);

    @endphp
    @csrf
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
                                                        <div class="col-md-3 justify-content-center"><p class="pricePlate">{{$plato['precio']}}€</p></div>
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
                            <input class="form-control" type="text" placeholder="Pon un nombre para la categoria" id="cat_name" name="cat_name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pruebamodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class = "modal-body">

                    <div class = "container">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#plato" data-toggle = "tab">Plato</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#galeria" data-toggle = "tab">Menús asignados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#alergenos" data-toggle = "tab">Alergenos</a>
                            </li>
                        </ul>

                        <div class = "tab-content">
                            <div id="plato" class="container tab-pane active"><br>

                                <form id="desc_plate">
                                    <div class="form-group">
                                        <label for="plato">Nombre del plato:</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid"
                                                 alt="example placeholder">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn btn-mdb-color btn-rounded float-left">

                                                <input type="file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="plato">Descripción del plato:</label>
                                        <textarea class="form-control" name="message" rows="10"></textarea>
                                    </div>

                                    <div class = "form-group">
                                        <label for="quantity">Precio (Entre 1 y 700€):</label>
                                        <input type="number"  id="quantity" name="quantity" min="1" max="700" >€
                                    </div>






                                    <button type="submit" class="btn btn-primary">Guardar plato</button>
                                </form>



                            </div>
                            <div id="galeria" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Asignar Menús
                                        </a>
                                    </div>
                                </div>
                                <div class="row collapse" id="collapseExample">
                                    <div class="col-md-12 form-group">
                                        <select class="form-control" name="menuPlate">
                                            <option value="">Selecciona categoría</option>
                                            {{--Imprimir los menus del restaurante--}}
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-group list-group-flush" id="menus">
                                            <li class="list-group-item">
                                                Menú 1
                                                <button class="btn btn-light"><img src="{{asset('images/minus.png')}}"></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class = "row">
                                    <button type="submit" class="btn btn-primary">Guardar Menú</button>
                                </div>
                            </div>
                            <div id="alergenos" class="container tab-pane fade"><br>
                                <h3>Alergenos</h3>

                                <div class="row">
                                    <div class="col-md-12">

                                        <p>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Alergenos
                                            </a>

                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <select class="selectpicker">
                                                <option>Mustard</option>
                                                <option>Ketchup</option>
                                                <option>Barbecue</option>
                                            </select>

                                        </div>



                                        <button class="btn-save btn btn-primary btn-sm" style="margin-left: 60px">Guardar</button>

                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
