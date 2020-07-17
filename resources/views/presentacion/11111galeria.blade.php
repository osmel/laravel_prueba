<style>
  .agregar_cesta { margin: 0 auto;
           width: 90%;
           height: 45px;
           font-size: 1.2em; 
           display: block; 

          }

  .agregar_cesta:hover  {background: #dde6ff;border-color: #a0a7b9;}      

 

  .cantCarProd {
          display: none;
          float: left;
          width: 64px;
      }

   .agregar_cesta:hover >.cantCarProd{
          display: block;
      }

</style>  

{{-- cesta--}}
    

<div id="mi_galeria">
  @include('presentacion.cesta2')
    <div class="card-columns" >
        @foreach($producto as $indice =>$prod) 
          <div class="card">
                <div class="card-header text-right">
                  {{$prod->precio}}
                </div>
                <div class="marco_foto">
                   <a class="modal_imagen"  title="Detalle" data-remoto="/modal_imagen/{{$prod->id}}" data-toggle="modal" data-target="#modalMessage" >
                     <img  src="images/piezas/{{{ (!(isset($prod->foto[0]->url))) ? 'sinimagen.png' : $prod->foto[0]->url}}}" class="NOimageTOzoom" alt="imagen con zoom" data-overlay="" width="160" height="120" >
                   </a>
                </div>   
                <div class="card-body">
                    <h5 class="card-title">
                      {{{ (!(isset($prod->descripcion[0]->nombre))) ? '-' : $prod->descripcion[0]->nombre}}}
                      {{--     $prod->descripcion->nombre --}}
                    </h5>
                    <p class="card-text">   </p>
                </div>
                <div class="card-footer">
                      <small class="text-muted">Fabricante: {{$prod->fabricante->nombre}}</small>
                </div>




                  <button class="agregar_cesta fas fa-shopping-cart" id_producto="{{$prod->id}}" >
                              <input class="cantCarProd" value="1" type="text" placeholder="cantidad"> 
                              <div class="TextAgr">Agregar</div>
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