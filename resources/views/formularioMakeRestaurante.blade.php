@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action = "{{ action('RestauranteController@create')}}" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                    <div class="form-check">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Ej: La pequeña plza" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="add">Address:</label>
                        <input type="text" class="form-control" id="add" placeholder="Ej: Calle spagueto" name="address" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="desc">Description:</label>
                        <input type="text" class="form-control" id="desc" placeholder="Ej: Un restaurante que ..." name="description" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="ltt">Latitude:</label>
                        <input type="text" class="form-control coordenadas" id="ltt" placeholder="Ej: -123.4567" name="latitude" pattern="\-?[0-9]{1,3}\.[0-9]{1,4}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="lgt">Longitude:</label>
                        <input type="text" class="form-control coordenadas" id="lgt" placeholder="Ej: 123.4567" name="longitude" pattern="\-?[0-9]{1,3}\.[0-9]{1,4}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="pn">Phone number:</label>
                        <input type="text" class="form-control" id="pn" placeholder="Ej: 684305799" name="phone_number" pattern="[0-9]{9}" required>
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
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" value="submit" class="btn btn-primary">Sent</button>
                <button type="button" class="btn btn-primary"><a style="text-decoration:none" class="text-white" href="{{ url("home")}}">Home</a></button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/input-file.js') }}" defer></script>
@endsection

