@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href=" {{asset('css/menu.css')}}" type="text/css">
    <script src="{{asset('js/menus.js')}}"></script>


    <div class="container">
        <div class="card">
            <div class="card-body">
                @php
   var_dump($platos);

@endphp
                @if(isset($platos))
                    <div class="container">
                        @foreach ($platos as $key => $platos)
                            <div class="row border-2 plate" id="{{$key}}">
                                <div class="col-md-3">
                                    <img class="plate_img" src="{{$platos['url_photo']}}">
                                </div>
                                <div class="col-md-3 justify-content-center"><p class="name_plate">{{$platos['nombre']}}</p></div>
                                <div class="col-md-3 justify-content-center"><p>{{$platos['precio']}}€</p></div>
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
@endsection



