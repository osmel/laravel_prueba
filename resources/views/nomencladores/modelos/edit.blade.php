@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.Edit models') }}</h1>

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

    <form method="POST" action="{{ url("modelos/{$modelo->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">{{ trans('autenticacion.Name') }}:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro Perez" value="{{ old('nombre', $modelo->nombre) }}">
        </div>

       

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.Update models') }}</button>
        <a href="{{ route('modelos.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to models list') }}</a>
        
        
    </form>

@endsection