@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white d-flex flex-row justify-content-between">
                    <h3>Lista de Restaurantes:</h3>
                    <button type="button" class="btn btn-default btn-success"><a href="{{ route("create_restaurante")}}"><img src="{{asset('images/plus.png')}}" alt="Error"></a></button>
                </div>
            </div>
            <div class="list-group">
                @foreach($restaurants as $rest)
                    <div class="list-group-item list-group-item-action list-group-item-secondary d-flex flex-row justify-content-between">
                        <h4>{{$rest->name}}</h4>
                        <div class="btn-group ">
                            <button type="button" class="btn btn-default bg-primary"><a href="{{ route('ver_restaurante',['id'=>$rest->id])}}"><img src="{{asset('images/eye.png')}}" alt="Error"></a></button>
                            <button type="button" class="btn btn-default bg-info"><a href="{{ route("editar_restaurante",['id'=>$rest->id]) }}"><img src="{{asset('images/edit.png')}}" alt="Error"></a></button>
                            <button type="button" class="btn btn-default bg-danger"  onclick="return confirm('Are you sure to delete {{$rest->name}}?')"><a href="{{ route("delete_restaurante",['id'=>$rest->id])}}"><img src="{{asset('images/bin.png')}}" alt="Error"></a></button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
