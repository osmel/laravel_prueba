@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.Create user') }}</h4>
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
            

            <form method="POST" action="{{ route('users.crear') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">{{ trans('autenticacion.Name') }}:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">{{ trans('autenticacion.E-Mail Address') }}:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">

                    {{-- mostrar el primer error de email. --}}
                    @if ($errors->has('email'))
					    <p>{{ $errors->first('email') }}</p>
					@endif
                </div>


                  {{-- almacen--}}
                     <div class="form-group">
                            <label for="almacen_id">{{ trans('aplicacion.warehouse') }}:</label>
                                <select name="almacen_id" id="almacen_id"  tipo="entrada"  class="form-control">
                                        @foreach ($almacenes as $key => $valor)
                                            <option value="{{ $valor->id }}"
                                            
                                                @if ($key == old('almacen_id', $valor->id))
                                                    selected="selected"
                                                @endif
                                            >{{ $valor->nombre  }}</option>
                                        @endforeach
                                </select>
                    </div> 



                    {{-- Perfiles o roles--}}
                     <div class="form-group">
                            <label for="role_id">{{ trans('aplicacion.roles') }}:</label>
                                <select name="role_id" id="role_id"  tipo="entrada"  class="form-control">
                                        @foreach ($perfiles as $key => $valor)
                                            <option value="{{ $valor->id }}"
                                            
                                                @if ($key == old('role_id', $valor->id))
                                                    selected="selected"
                                                @endif
                                            >{{ $valor->nombre_rol  }}</option>
                                        @endforeach
                                </select>
                    </div> 



                <div class="form-group">
                    <label for="password">{{ trans('autenticacion.Password') }}:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">
                </div>

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.Create user') }}</button>
                <a href="{{ route('users.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to user list') }}</a>
            </form>
        </div>
    </div>
@endsection