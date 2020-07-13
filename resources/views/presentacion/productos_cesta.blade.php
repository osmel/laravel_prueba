                <?php //$carrito = session('arreglo'); ?>
                @if ($carrito->isNotEmpty())
                    @foreach($carrito as $indice1 =>$prod_cesta) 
                        <?php //$cantidad=session('arreglo.'.$prod_cesta->id); ?>
                        
                      <li>
                        <span class="item">
                            <span class="item-left">
                                
                                <img height="50" width="50"  src="images/piezas/{{{ (!(isset($prod_cesta->foto[0]->url))) ? 'sinimagen.png' : $prod_cesta->foto[0]->url}}}"  alt="" />

                                <span class="item-info">
                                    <span><b style="color:blue;">{{{ (!(isset($prod_cesta->descripcion[0]->nombre))) ? '-' : $prod_cesta->descripcion[0]->nombre}}}</b></span>
                                    <span><b>Codigo:</b> {{{ (!(isset($prod_cesta->codigo[0]->nombre))) ? '-' : $prod_cesta->codigo[0]->nombre}}}</span>
                                    <span><b>Fabricante:</b> {{$prod_cesta->fabricante->nombre}}</span>
                                    <span><b>Precio:</b> {{$prod_cesta->precio}}$</span>
                                    <span><b>Cantidad:</b> <input id_producto="{{ $prod_cesta->id }}" class="cantidad" value="{{ session('arreglo.'.$prod_cesta->id) }}" type="text"> </span>
                                </span>
                                
                            </span>
                            <span class="item-right">
                                <button class="btn btn-danger btn_eliminar fas fa-trash-alt"  id_producto="{{ $prod_cesta->id }}" ></button>
                            </span>
                        </span>
                      </li>
                      
                    @endforeach  
                 @else   
                        <li>
                            <p class="text-center">Su cesta está vacía!</p>
                        </li>                  
                 @endif 