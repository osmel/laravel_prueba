@extends('layouts.plantilla')
@section('title', "Editar usuario")

@section('content')
    <h1>{{ trans('aplicacion.Edit user') }}</h1>

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

    <form method="POST" action="{{ url("usuarios/{$user->id}") }}"> 
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">{{ trans('autenticacion.Name') }}:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $user->name) }}">
        </div>

        <div class="form-group">
            <label for="email">{{ trans('autenticacion.E-Mail Address') }}:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email', $user->email) }}">
        </div>


        <div class="form-group">
            <label for="password">{{ trans('autenticacion.Password') }}:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">

        </div>

        
        <button type="submit"  class="btn btn-primary">{{ trans('aplicacion.Update user') }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to user list') }}</a>
        
        
    </form>

@endsection