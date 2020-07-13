@extends('layouts.plantilla')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.List of models') }}</h1>
        <p>
            <a href="{{ route('modelos.create') }}" class="btn btn-primary">{{ trans('aplicacion.New models') }}</a>
        </p>
    </div>



    @if ($modelos->isNotEmpty())
    
    <table id="tabla_modelos" class="display table table-striped table-bordered " cellspacing="0" width="100%">
        
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('autenticacion.Name') }}</th>
            <th scope="col">{{ trans('aplicacion.Edit') }}</th>
            <th scope="col">{{ trans('aplicacion.Remove') }}</th>            
        </tr>
        </thead>
      
        
    </table>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection
