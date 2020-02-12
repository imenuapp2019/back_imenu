<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Usuario</title>
</head>
<body>

    <div class = 'container'>
        <div class="alert alert-primary" role="alert">
            <a href="#" class="alert-link"> </a>.
              </div>

        <p class="h1 text-center"  ><strong> Nombre de Usuario: </strong>{{$users->name}} </p>
    </div>

    <div class="alert alert-primary" role="alert">
    <a href="#" class="alert-link"> </a>.
      </div>
      <p class="h1 text-center"  ><strong> Apellido de Usuario: </strong>{{$users->lastName}} </p>

      <div class="alert alert-primary" role="alert">
        <a href="#" class="alert-link"> </a>.
          </div>
        <p class="h1 text-center"  ><strong> Email de Usuario: </strong>{{$users->email}} </p>
        <div class="alert alert-primary" role="alert">
            <a href="#" class="alert-link"> </a>.
              </div>

</body>
</html>
