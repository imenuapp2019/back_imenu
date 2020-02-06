<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Restaurante</title>
</head>
<body>
<div class = 'container'>
    <p class="h1 text-center"  >{{$restaurante->name}} </p>
</div>

    <div class = 'container'>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
           @php $activa = true @endphp


            @for($i = 0; $i < count($fotos); $i++ )

          <div class="carousel-item <?php if($i ==0){ echo 'active';} ?>">
          <img src="{{$fotos[$i]->URL}}" class="d-block w-100" alt="...">
          </div>
          @endfor
        </div>
      </div>

      <div class="card">

      <div>   <address class= "text-center"> <strong>Dirección: </strong>{{$restaurante->address}} </address> </div>

      <div class="text-center">  <p> <strong>Número de teléfono: </strong>{{ $restaurante->phone_number}} </p> </div>

      <div class= "text-center"> <p> <strong>Latitud: </strong>{{$restaurante->latitude}} </p> </div>

      <div class= "text-center"> <p> <strong>Longitud: </strong>{{$restaurante->longitude}} </p> </div>

      </div>

    </div>





</body>
</html>
