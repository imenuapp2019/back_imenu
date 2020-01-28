@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/action_page.php" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$restaurants->name}}">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="add">Address:</label>
                        <input type="text" class="form-control" id="add" placeholder="Enter address" name="add" value="{{$restaurants->address}}">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="ltt">Latitude:</label>
                        <input type="text" class="form-control" id="ltt" placeholder="Enter latitude" name="ltt" value="{{$restaurants->latitude}}">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="lgt">Longitude:</label>
                        <input type="text" class="form-control" id="lgt" placeholder="Enter longitude" name="lgt" value="{{$restaurants->longitude}}">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="pn">Phone number:</label>
                        <input type="text" class="form-control" id="pn" placeholder="Enter Phone number" name="pn" value="{{$restaurants->phone_number}}">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="ft">Food type:</label>
                        <select class="form-control" id="ft" name="ft">
                            @foreach ($type as $item)
                                @if ($item->id == $restaurants->tipo_id)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Sent</button>
                    <button type="reset" value="reset" class="btn btn-primary">Reset</button>
                    <button type="button" class="btn btn-primary" onclick="history.back()">Volver atras</button>
                </form>
            </div>
        </div>
    </div>
@endsection
