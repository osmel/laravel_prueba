@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.Edit variations') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corrige los errores debajo:</h6>
            <ul>
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url("variacions/{$variacion->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">{{ trans('autenticacion.Name') }}:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre', $variacion->nombre) }}">
        </div>

       

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.Update variations') }}</button>
        <a href="{{ route('variacions.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to variations list') }}</a>
        
        
    </form>

@endsection