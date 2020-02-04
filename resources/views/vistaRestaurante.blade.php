<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Restaurante</title>
</head>
<body>
    <div id= "{{ $id ?? 'carousel'}}"  class="carousel slide {{ $class ?? ' '}} " data-ride="carousel">

        @istrue( $indicators)

        <ol class = "carousel-indicators">
                    @isset($items)
                    @foreach($items as $item)
                    <li data-target = " # {{ $id ?? 'carousel'}}" data-slide-to = "{{ $loop->index}}"></li>
        @endforeach

        @else
        {!! $indicators !!}

        @endisset

        </ol>

        @endistrue

        <div class="carousel-inner" role="listbox">
            @isset($items)
                @foreach($items as $item)
                    <div class="carousel-item @istrue($loop->first, 'active')">{{ $item }}</div>
                @endforeach
            @endisset

            {{ $slot }}
        </div>

        @istrue($controls)
            <a class="carousel-control-prev" href="#{{ $id ?? 'carousel' }}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#{{ $id ?? 'carousel' }}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endistrue
    </div>







</body>
</html>
