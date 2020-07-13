@extends('layouts.plantilla')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">{{ trans('aplicacion.List of brands') }}</h1>
        <p>
            <a href="{{ route('marcas.create') }}" class="btn btn-primary">{{ trans('aplicacion.New brands') }}</a>
        </p>
    </div>



    @if ($marcas->isNotEmpty())
    
    <table id="tabla_marcas" class="display table table-striped table-bordered " cellspacing="0" width="100%">
        
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
