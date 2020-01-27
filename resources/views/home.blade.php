@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="list-group">
                <div class="list-group-item list-group-item-action list-group-item-secondary d-flex flex-row justify-content-between ">
                    <div style="overflow-x:auto">asfasa</div>
                    <div class="btn-group ">
                        <button type="button" class="btn btn-default bg-primary"><img src="{{asset('images/eye.png')}}" alt=""></button>
                        <button type="button" class="btn btn-default bg-info"><img src="{{asset('images/edit.png')}}" alt=""></button>
                        <button type="button" class="btn btn-default bg-danger"><img src="{{asset('images/bin.png')}}" alt=""></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
