@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action = "{{action('RestauranteController@create')}} ">
            @csrf
                <p>Nombre: <input type = "text" id = "nombre" name = "name" required/>  </p>
                <p>Dirección: <input type = "text" id = "direccion" name = "adress" required/>  </p>
                <p>Latitud: <input type = "text" id = "latitud" name = "latitude" required/>  </p>
                <p>Longitud: <input type = "text" id="longitud" name = "longitude" required/>  </p>
                <p>Número de teléfono: <input type = "number" id = "phone" name = "phone_number" required/> </p>

                <p>Tipo de comida:</p>
                <select name="tipo_id">
                    <option value="1">Japonesa</option>
                    <option value="2">Chino</option>
                    <option value="3">Italiana</option>
                    <option value="4">Vegana</option>
                    <option value="5">Arabe</option>
                </select>
                <br><br>

                <input type="submit" id = "enviar ">
            </form>
        </div>
    </div>
</div>
@endsection
