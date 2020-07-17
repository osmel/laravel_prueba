@extends('layouts.plantilla')

@section('title', 'Usuarios')

@section('content')

<style>

/* estilo del buscador*/

.typeahead, .tt-query, .tt-hint {
    border: 2px solid #CCCCCC;
    border-radius: 8px;
    font-size: 14px;
    height: 30px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 100%;
}
.typeahead {
    background-color: #FFFFFF;
}
.typeahead:focus {
    border: 2px solid #0097CF;
}
.tt-query {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
    color: #999999;
}
.tt-dropdown-menu {
    background-color: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    margin-top: 12px;
    padding: 8px 0;
    width: 422px;
}
.tt-suggestion {
    font-size: 14px;
    /*line-height: 24px;*/
    padding: 3px 20px;
    cursor: pointer;
}
.tt-suggestion.tt-is-under-cursor {
    background-color: #0097CF;
    color: #FFFFFF;
}
.tt-suggestion p {
    margin: 0;
}


</style>    
    
 <div class="row-fluid" id="wrapper">   
    <div class="container" style="border-radius: 9px 9px 9px 9px;border: 1px solid #337ab7;">  


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
            



    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h4>Registro de Entradas </h4>
            <hr>
        </div>
    </div>

    <form method="POST" action="{{ route('inventario.crear') }}"> 
        {{ csrf_field() }}

    <div class="row">        

        <div class="col-xs-6 col-sm-3 col-md-2">
            <fieldset disabled>
                <div class="form-group">
                    <label for="fecha" class="col-sm-12 col-md-12 ttip" title="Campo informativo, no editable.">Fecha</label>
                    <div class="col-sm-12 col-md-12">
                        <input value="{{ date('j-m-Y') }}"  type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha">

                    </div>
                </div>
            </fieldset> 
        </div>        

       {{-- producto--}}
         <div class="form-group">

            
            <div class="col-sm-12">
                <label for="cantidad">{{ trans('aplicacion.codigo') }}:</label>
               
                <div class="form-group">
                    <input  type="text" name="editando_productos" idusuario="1" class="form-control buscar_elemento ttip" title="Campo predictivo. Escriba y seleccione el codigo del producto." autocomplete="off" spellcheck="false" placeholder="Buscar producto...">
                </div>                


            </div>    
        </div> 


       {{-- cantidad--}}
         <div class="form-group">
            <div class="col-sm-12">
                <label for="cantidad">{{ trans('aplicacion.cantidad') }}:</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="#" value="{{ old('cantidad') }}">
            </div>    
        </div> 


        {{-- precio--}}
         <div class="form-group">
            <div class="col-sm-12">
                <label for="precio">{{ trans('aplicacion.precio') }}:</label>
                <input type="number" class="form-control" name="precio" id="precio" placeholder="#.##" value="{{ old('precio') }}">
            </div>    
        </div> 


      {{-- almacen--}}
         <div class="form-group">

            
            <div class="col-sm-12">
                <label for="precio">{{ trans('aplicacion.warehouse') }}:</label>
                {{-- <input type="text" class="form-control" name="precio" id="precio" placeholder="#.##" value="{{ old('precio') }}"> --}}

                    
                
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
        </div> 



    </div>



        <div class="col-sm-4 col-md-4">
            <input type="submit" class="btn btn-success btn-block" value="Agregar">
        </div>


</form>

        <div class="col-md-12">
                        
                        <h4>Listado de productos seleccionados para Entrada</h4>    
                        <br>            
        </div>
        {{-- Listado de productos recepcionados--}}
        @if ($recepcionados->isNotEmpty())
                <table id="tabla_recepcion" class="display table table-striped table-bordered " cellspacing="0" width="100%">
                    
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ trans('aplicacion.codigo') }}</th>
                        <th scope="col">{{ trans('aplicacion.precio') }}</th>
                        <th scope="col">{{ trans('aplicacion.cantidad') }}</th>
                        <th scope="col">{{ trans('aplicacion.warehouse') }}</th>
                        <th scope="col">{{ trans('aplicacion.Remove') }}</th>
                    </tr>
                    </thead>
                    
                </table>
        @else
                <p>No hay productos registrados.</p>
        @endif
    </div>    

</div>

  <form method="POST" action="{{ route('inventario.entrada_existencia') }}"> 
        {{ csrf_field() }}
        <button  class="btn btn-primary">Crear Entrada</button>
        <a href="{{ route('almacens.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to warehouse list') }}</a>
  </form>
   
@endsection

@section('sidebar')
    @parent
@endsection

