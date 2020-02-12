@extends('layouts.app')

@section('content')
    <div class = 'container'>
        <p class="h1 text-center"  >{{$restaurante->name}} </p>
    </div>

    <div class = 'container'>
            @if (isset($fotos))
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                        @php $i = 0 @endphp
                        @foreach ($fotos as $image)
                            @if($i == 0)
                                <div class="carousel-item active">
                                    {{--La parte del src q pone /TFG/Imenu es el nombre de tu carpeta del proyecto cambiar en el caso de cada uno si se quiere utilizar--}}
                                    <img class="" src="/TFG/Imenu/public/storage/{{$image->URL}}" alt="" style="width:100%">
                                </div>
                            @else
                                <div class="carousel-item">
                                    {{--La parte del src q pone /TFG/Imenu es el nombre de tu carpeta del proyecto cambiar en el caso de cada uno si se quiere utilizar--}}
                                    <img class="" src="/TFG/Imenu/public/storage/{{$image->URL}}" alt="" style="width:100%">
                                </div>
                            @endif
                            @php $i = 1 @endphp
                        @endforeach
                    </div>

                    <!-- No funciona -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @else
                <div class="alert alert-primary" role="alert">
                    No images aviable.
               </div>
            @endif

        <div class="card">
            <div>   <address class= "text-center"> <strong>Dirección: </strong>{{$restaurante->address}} </address> </div>

            <div class="text-center">  <p> <strong>Número de teléfono: </strong>{{ $restaurante->phone_number}} </p> </div>

            <div class= "text-center"> <p> <strong>Latitud: </strong>{{$restaurante->latitude}} </p> </div>

            <div class= "text-center"> <p> <strong>Longitud: </strong>{{$restaurante->longitude}} </p> </div>

            <div class= "text-center"> <p> <strong>Tipo de comida: </strong>{{$restaurante->longitude}} </p> </div>
        </div>
    </div>
@endsection

