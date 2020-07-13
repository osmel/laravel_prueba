@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.Edit role') }}</h1>

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

    <form method="POST" action="{{ url("perfiles/{$perfil->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">{{ trans('autenticacion.Name') }}:</label>
            <input type="text" class="form-control" name="nombre_rol" id="nombre_rol" placeholder="Pedro Perez" value="{{ old('nombre_rol', $perfil->nombre_rol) }}">
        </div>

       

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.Update role') }}</button>
        <a href="{{ route('perfiles.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to role list') }}</a>
        
        
    </form>

@endsection