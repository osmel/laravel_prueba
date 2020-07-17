<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token para todo el sistema--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Autos') }}</title>
    <link rel="icon" href="{{ asset( '/images/logo.png' ) }}" sizes="32x32">

    {{-- Scripts sistema
    <script src="{{ asset('js/app.js') }}" defer></script>
    --}}

    {{-- Fonts sistema
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    --}}

    {{-- Styles sistema
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    --}}
    



    {{--propio mio --}}
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">



    {{--iconos
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
    https://fontawesome.com/v4.7.0/icon/shopping-cart
    https://fontawesome.com/icons/shopping-cart?style=solid
    --}}

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">

    {{-- CSS only bootstrap--}}
     <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4.5.0/dist/css/bootstrap.min.css') }}">
    
    {{--seleccion cajas largas intuitiva --}}
    <link rel="stylesheet" href="{{ asset('plugins/chosen/css/chosen.css') }}">
    
    {{--nose... para agregar un complemento --}}
    <link rel="stylesheet" href="{{ asset('plugins/trumbowyg/ui/trumbowyg.css') }}">

    {{-- CSS datatables--}}
    <link rel="stylesheet" href="{{ asset('plugins/dataTables-1.10.21/DataTables-1.10.21/css/jquery.dataTables.min.css') }}">

    {{--bootstrap-select selectpicker 
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">        
    
     --}}


    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}">        




</head>
<body>
    <div id="app">
       @include('layouts.nav_bar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>



    {{--jquery --}}
    <script type="text/javascript" src="{{ asset('plugins/jquery/jquery-2.1.4.js') }}"></script>


    {{--popper esto es para q funcione bien bootstrap --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

    {{--version bootstrap-4.5.0--}}
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-4.5.0/dist/js/bootstrap.js') }}"></script>
    {{--seleccion intuitiva --}}
    <script type="text/javascript" src="{{ asset('plugins/chosen/js/chosen.jquery.js')}}" ></script>

    {{--Un editor ligero WYSIWYG --}}
    <script type="text/javascript" src="{{ asset('plugins/trumbowyg/trumbowyg.js')}}"></script>

    {{-- datatables--}}
    <script type="text/javascript" src="{{ asset('plugins/dataTables-1.10.21/DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>


       {{-- Personal--}}
    <script type="text/javascript" src="{{ URL::to('js/sistema.js') }}"></script>

    

{{-- plugins de lupa--}}
<script type="text/javascript" src="{{ URL::to('plugins/lupa/jquery.mlens-1.7.min.js') }}"></script>




    {{--busqueda sensitiva
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/bootstrap-3.3.1/dist/css/typeahead.js-bootstrap.css">

    --}}

    <script type="text/javascript" src="{{ asset('plugins/typeahead/dist/typeahead.jquery.min.js')}}"></script>  
    <script type="text/javascript" src="{{ asset('plugins/typeahead/dist/typeahead.bundle.js')}}"></script>    

    {{--bootstrap-select selectpicker 
        https://developer.snapappointments.com/bootstrap-select/
    --}}

    <script type="text/javascript" src="{{ asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>


</body>
</html>
