 

{{-- cesta--}}
    

<div id="mi_galeria">
  @include('presentacion.cesta2')
    <div class="xycard" >
        @foreach($producto as $indice =>$prod) 
          <div class="marco_producto" >
              <div class="EtiDescuento">
                  10%
              </div>
              <div class="precViej">
                  {{$prod->precio}}
                </div>
                <div class="precio">
                  {{$prod->precio}}
                </div>
                <div class="marco_foto">
                   <a class="modal_imagen marco_foto"  title="Detalle" data-remoto="/modal_imagen/{{$prod->id}}" data-toggle="modal" data-target="#modalMessage" >
                     <img  src="images/piezas/{{{ (!(isset($prod->foto[0]->url))) ? 'sinimagen.png' : $prod->foto[0]->url}}}" class="NOimageTOzoom" alt="imagen" data-overlay=""  >
                   </a>
                </div>   
                <div class="card-body">
                    <h5 class="card-title">
                      {{{ (!(isset($prod->descripcion[0]->nombre))) ? '-' : $prod->descripcion[0]->nombre}}}
                      {{--     $prod->descripcion->nombre --}}
                    </h5>
                </div>
                <div class="card-footer">
                  <div class="infoExtra">Fabricante: {{$prod->fabricante->nombre}}</div>
                  <div class="infoExtra">Código: 087868756464576745</div>
                </div>

                  <button class="agregar_cesta fas fa-shopping-cart" id_producto="{{$prod->id}}" >
                              <div class="TextAgr">Agregar</div>
                              <div class="cantCarProd"><input  value="1" type="text" placeholder="cantidad"> </div>
                  </button>



          </div>
          <?php //if (isset($prod->foto[0]->url)) die; ?>
          @endforeach  
    </div>

 
    {{-- Paginacion--}}

    <div class="row">
      <div class="mx-auto">
          {{ $producto->links( 'pagination::personalizado_pagina' ) }}
      </div>
    </div>  


</div>




<div class="modal fade bs-example-modal-lg" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>



{{-- 

UPDATE `fotos` SET `url` = concat('variacion ',id)
UPDATE `variacions` SET `nombre` = concat('variacion ',id)

  foreach ($prod->variacions as $vari) {
            return json_encode($vari ); //->variacion;
        }



   <img  src="images/piezas/{{ $prod->foto[0]->url }}" class="NOimageTOzoom" alt="imagen con zoom" data-overlay="" width="160" height="120" >

  <img   data-big="images/piezas/{{$prod->foto->url}}"  src="images/piezas/{{$prod->foto->url}}" class="imageTOzoom" alt="imagen con zoom" data-overlay="" >

  
  --}}
