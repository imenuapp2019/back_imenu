@extends('layouts.app')

@section('content')
<div class="container">
    @if ($change)
        <div class="alert alert-info">
            <strong>Info!</strong> Changes saved.
        </div>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ action('RestauranteController@update', ['id' => $restaurants->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                    <div class="form-group">
                        <div class="form-check">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$restaurants->name}}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="add">Address:</label>
                            <input type="text" class="form-control" id="add" placeholder="Enter address" name="address" value="{{$restaurants->address}}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="ltt">Latitude:</label>
                            <input type="text" class="form-control" id="ltt" placeholder="Enter latitude" name="latitude" value="{{$restaurants->latitude}}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="lgt">Longitude:</label>
                            <input type="text" class="form-control" id="lgt" placeholder="Enter longitude" name="longitude" value="{{$restaurants->longitude}}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label for="pn">Phone number:</label>
                            <input type="text" class="form-control" id="pn" placeholder="Enter Phone number" name="phone_number" value="{{$restaurants->phone_number}}">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
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
                    <button type="submit" value="submit" class="btn btn-primary">Sent</button>
                    <button type="reset" value="reset" class="btn btn-primary">Reset</button>
                    <button type="button" class="btn btn-primary"><a style="text-decoration:none" class="text-white" href="{{ url("home")}}">Home</a></button>
                </form>
            </div>
        </div>
    </div>
@endsection