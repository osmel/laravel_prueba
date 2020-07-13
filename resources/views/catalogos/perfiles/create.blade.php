@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.Create role') }}</h4>
        <div class="card-body">

           {{-- Esto es para mostrar listado de errores al comienzo --}}
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
            

            <form method="POST" action="{{ route('perfiles.crear') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nombre_rol">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="nombre_rol" id="nombre_rol" placeholder="Pedro Perez" value="{{ old('nombre_rol') }}">
                </div>

               

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.Create role') }}</button>
                <a href="{{ route('perfiles.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to role list') }}</a>
            </form>
        </div>
    </div>
@endsection