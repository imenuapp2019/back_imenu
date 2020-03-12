@extends('layouts.app')

@section('content')
<div class="container">
    @if ($change)
        <div class="alert alert-success">
            <strong>Info!</strong> Changes saved.
        </div>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ action('RestauranteController@update', ['id' => $restaurants->id]) }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <div class="form-check">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Ej: La pequeña plza" name="name" value="{{$restaurants->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="add">Address:</label>
                            <input type="text" class="form-control" id="add" placeholder="Ej: Calle spagueto" name="address" value="{{$restaurants->address}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="desc">Description:</label>
                            <input type="text" class="form-control" id="desc" placeholder="Ej: Un restaurante que ..." name="description" value="{{$restaurants->description}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="ltt">Latitude:</label>
                            <input type="text" class="form-control" id="ltt" placeholder="Ej: -123.4567" name="latitude" pattern="\-?[0-9]{1,3}\.[0-9]{1,4}" value="{{$restaurants->latitude}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="lgt">Longitude:</label>
                            <input type="text" class="form-control" id="lgt" placeholder="Ej: 123.4567" name="longitude" pattern="\-?[0-9]{1,3}\.[0-9]{1,4}" value="{{$restaurants->longitude}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="pn">Phone number:</label>
                            <input type="text" class="form-control" id="pn" placeholder="Ej: 684305799" name="phone_number" pattern="[0-9]{9}" value="{{$restaurants->phone_number}}">
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <label for="banner">Banner:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept=".jpg,.png,.jpeg" class="custom-file-input" name="images[]" id="banner" multiple>
                                    <label class="custom-file-label" for="banner">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="ft">Food type:</label>
                            <select class="form-control" id="ft" name="tipo_id">
                                @foreach ($type as $item)
                                    @if ($item->id == $restaurants->tipo_id)
                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            @forelse ($images as $image)
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        {{--La parte del src q pone /TFG/Imenu es el nombre de tu carpeta del proyecto cambiar en el caso de cada uno si se quiere utilizar--}}
                                        <img class="mt-4" src="/TFG/Imenu/public/storage/{{$image->URL}}" alt="" style="width:100%">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="deleteImages[]" value="{{$image->id}}"> Select to delete</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="alert alert-primary" role="alert">
                                    No images aviable.
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Sent</button>
                    <button type="reset" value="reset" class="btn btn-primary">Reset</button>
                    <button type="button" class="btn btn-primary"><a style="text-decoration:none" class="text-white" href="{{ url("home")}}">Home</a></button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/input-file.js') }}" defer></script>
@endsection
