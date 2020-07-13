	<div class="modal-header">	
          <h5 class="card-title">
		    {{{ (!(isset($producto->descripcion[0]->nombre))) ? '-' : $producto->descripcion[0]->nombre}}}
          </h5>
    </div>  
	<div class="modal-header">		
				<div class="card-deck">
		        	@foreach($producto->foto as $indice =>$foto) 
						<div class="card">
							<button class="cambio_imagen_modal"  title="click para cambiar" data-remoto="/cambio_imagen_modal/{{{ (!(isset($foto->producto_id))) ? 0 : $foto->producto_id}}}"
							id_imagen="{{{ (!(isset($foto->id))) ? 0 : $foto->id}}}"	
							 >

				           		<img  src="images/piezas/{{{ (!(isset($foto->url))) ? 'sinimagen.png' : $foto->url}}}" width="40" height="40" >

				           	</button>

				        </div>
		        	@endforeach 
		        </div>
	</div>

	<div class="modal-header">		

				<div class="container">
					<h5 style="font-weight: bold;" class="text-center">Modelos Compatibles</h5>
				  	<div class="row" style="font-weight: bold;background-color: rgba(86,61,124,.15);">
					    <div class="col-md-4 ml-auto">Marca</div>
					    <div class="col-md-4 ml-auto">Modelo</div>
					    <div class="col-md-4">Variación</div>
					    
					   
					 </div>
				    @foreach($producto->variacions as $indice =>$variacion) 
				    	<div class="row">
						    <div class="col">{{{ (!(isset($variacion->modelo->marca->nombre))) ? '' : $variacion->modelo->marca->nombre}}}
						    	 </div>
						    	<div class="col">{{{ (!(isset($variacion->modelo))) ? '' : $variacion->modelo->nombre}}}</div>
						    	<div class="col">{{{ (!(isset($variacion->nombre))) ? '' : $variacion->nombre}}}</div>
						    
				    	</div> 
				    @endforeach 	
				   
				  
				</div>

				
	</div>



	<div class="modal-body" style="padding-left: 30px; padding-right: 30px;">
			<div class="card-group">
			        <div class="marco_foto">
			           <a class="modal_imagen" id="modal_imagen" title="Detalle" data-remoto="/modal_imagen/{{$producto->id}}" data-toggle="modal" data-target="#modalMessage" >
					        	   <img  src="images/piezas/{{{ (!(isset($producto->foto[0]->url))) ? 'sinimagen.png' : $producto->foto[0]->url}}}" id="imageTOzoom" alt="imagen con zoom" data-overlay="" >
			           </a>
			        </div>   
			        <div class="card-footer">
			          <small class="text-muted">Fabricante: {{$producto->fabricante->nombre}}</small>
			        </div>
	      </div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-success" data-dismiss="modal">Cancelar</button>
	</div>