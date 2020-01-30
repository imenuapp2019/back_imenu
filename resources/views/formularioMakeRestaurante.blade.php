<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario Restaurante</title>
</head>
<body>

<form method="POST" action = "{{action('RestauranteController@create')}} ">
  @csrf
   <p>Nombre: <input type = "text" id = "nombre" name = "name" required/>  </p>
   <p>Dirección: <input type = "text" id = "direccion" name = "adress" required/>  </p>
   <p>Latitud: <input type = "text" id = "latitud" name = "latitude" required/>  </p>
   <p>Longitud: <input type = "text" id="longitud" name = "longitude" required/>  </p>
   <p>Número de teléfono: <input type = "number" id = "phone" name = "phone_number" required/> </p>

    <p>Tipo de comida:</p>
   <select name="tipo_id">
    <option value="Mexicano">Mexicano</option>
    <option value="Chino">Chino</option>
    <option value="vegetariano">Vegetariano</option>
    <option value="Arabe">Arabe</option>
  </select>
  <br><br>

  <input type="submit" id = "enviar ">





</form>


</body>
</html>
