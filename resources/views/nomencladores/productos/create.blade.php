@extends('layouts.plantilla')
@section('title', "Crear usuario")

@section('content')
      <div class="card">
        <h4 class="card-header"> {{ trans('aplicacion.Create products') }}</h4>
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
            

            <form method="POST" action="{{ route('productos.crear') }}">
                {{ csrf_field() }}

               


                 <div class="container">
                      <div class="row">
                        <div class="col">

                          

                              {{-- nombre --}}
                             <div class="form-group">

                                <label for="surtido">{{ trans('autenticacion.Name') }}:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="surtido" id="surtido" placeholder="código" value="{{ old('surtido') }}">
                                </div>    
                            </div>

                            

                            {{-- precio--}}
                             <div class="form-group">

                                <label for="precio">{{ trans('aplicacion.precio') }}:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="precio" id="precio" placeholder="#.##" value="{{ old('precio') }}">
                                </div>    
                            </div>                            



                            {{-- fabricante--}}   
                            <div class="form-group">
                                 <label class="col-sm-12 control-label">Fabricante</label> 
                                <div class="col-sm-12">
                                    <select id="multiselect_fabricante" name="multiselect_fabricante"  required >
                                        
                                    </select>
                                </div>
                            </div>


                            {{-- Categoría--}}   
                            <div class="form-group">
                                 <label class="col-sm-12 control-label">Categoría</label> 
                                <div class="col-sm-12">
                                    <select id="multiselect_categoria" name="multiselect_categoria"  required>
                                        
                                    </select>
                                </div>
                            </div>

                                          

                </div>    

                <div class="col">
                            {{-- descripcion--}}   
                
                            <div class="form-group">
                                 <label class="col-sm-12 control-label">Descripción</label> 
                                <div class="col-sm-10">
                                    <select id="multiselect_descripcion" name="multiselect_descripcion[]" multiple="multiple" required>
                                        
                                    </select>
                                </div>
                            </div>

                         {{-- marca, modelo, variacion, motor--}}   
                        
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Marca</label> 
                                <div class="col-sm-10">
                                    <select id="multiselect_marca" name="multiselect_marca[]" multiple="multiple" required>
                                        
                                    </select>
                                </div>
                            </div>
                        
                            {{-- Codigos Adicionales--}}   
                        
                            <div class="form-group">
                                 <label class="col-sm-12 control-label">Código Adicionales</label> 
                                <div class="col-sm-10">
                                    <select id="multiselect_codigo" name="multiselect_codigo[]" multiple="multiple" required>
                                        
                                    </select>
                                </div>
                            </div>


                            {{-- Codigos Adicionales--}}   
                        
                            <div class="form-group">
                                 <label class="col-sm-12 control-label">Imagenes</label> 
                                <div class="col-sm-10">
                                    <select id="multiselect_imagen" name="multiselect_imagen[]" multiple="multiple" required>
                                        
                                    </select>
                                </div>
                            </div>                    

                    </div>     
                  </div>  
               </div>          

                <button type="submit" class="btn btn-primary">{{ trans('aplicacion.Create products') }}</button>
                <a href="{{ route('productos.index') }}" class="btn btn-danger">{{ trans('aplicacion.Return to products list') }}</a>
            </form>
        </div>
    </div>
@endsection