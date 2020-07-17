  /*

https://www.itsolutionstuff.com/post/custom-filter-search-with-laravel-datatables-exampleexample.html

  Route::get('api/resultado_productos', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(producto::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
});





            $productos = Producto::whereHas('variacions.modelo.marca', 
                  function (Builder $query) use ($busq) {

                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('variacions.nombre', 'like',  '%' . $busq[$i] .'%');
                            $query->orwhere('modelos.nombre', 'like',  '%' . $busq[$i] .'%');
                            $query->orwhere('marcas.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)




  */


   Route::get('api/resultado_productos', function () {

            $busq=explode(' ', request('search.value'));





            $productos = App\Producto::with(
                [
                           'variacions' => function($query) use ($busq) {
                               $query
                                    ->where('variacions.nombre', 'like',  '%' . "v" .'%');
                           }, 
                ]           

            );

            //return $productos->get();
            return DataTables::eloquent($productos)->toJson();

            return DataTables::eloquent($productos)

                        ->filterColumn('variacions.nombre', function($query, $busq) {
                            dd($query);
                           //->filter(function ($query) use ($busq) {  
                            
                            //$sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
                                    $query->Where(function ($query) use($busq) { 
                                        dd($busq);
                                         for ($i = 0; $i < count($busq); $i++){
                                            dd($busq[$i]);
                                            $query->orwhere('nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });                            

                        })  
                                          


                //->addColumn('nombre', '{{variacions.id}}',4)
            /*                
                ->addColumn('nombre', function ( Eloquent(($productos->get()) )  $p ) use ($productos) {
                    dd($productos->get());
                    foreach ($productos->get() as $key => $value) {
                        //print_r($value->id);
                         return ( Producto::where('id', $value->id)->first()->id ) ;

                    };
                 })   
                 */
                    /*dd('dd');
                    
                            return $productos;
                            return $productos->variacions->map(function($marca) use ($producto) {
                                return $producto->id;
                                return $marca->nombre;
                            })->implode('<br>');
                        })
                        */

            ->toJson();





            

            $productos = Producto::whereHas('variacions.modelo.marca', 
                  function (Builder $query) use ($busq) {

                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            //dd('a');
                            $query->orwhere('variacions.nombre', 'like',  '%' . $busq[$i] .'%');
                            $query->orwhere('modelos.nombre', 'like',  '%' . $busq[$i] .'%');
                            $query->orwhere('marcas.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            })
            //->get() //['precio','variacions.nombre']
            ; //, '>=', 1
            //return DataTables::eloquent($productos);
            return DataTables::eloquent($productos)->toJson();
            dd('a');
            //return $productos->get();

            return DataTables::eloquent($productos)
                    /*
                    ->addColumn('nombre', function (Producto $producto) {
                        dd($producto);
                        return $producto->variacions->map(function($variacions) {
                            return $variacions->nombre;
                            //return str_limit($variacions->nombre, 30, '...');
                        })->implode('<br>');
                    })      
                    */      
                    //->addColumn('intro','{{variacion}}')
                    ->toJson();

            return DataTables::eloquent($productos)
                        ->addColumn('nombre', function (Producto $producto) {
                            return $producto->variacions->map(function($variacions) {
                                return $variacions->nombre;
                            })->implode('<br>');
                        })            
                   ->toJson(); 

                return DataTables::eloquent($productos)
                        /*->filterColumn('modelos.nombre', function($query, $busq) {
                           //->filter(function ($query) use ($busq) {  
                            
                            //$sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
                                    $query->Where(function ($query) use($busq) { 
                                        dd($busq);
                                         for ($i = 0; $i < count($busq); $i++){
                                            dd($busq[$i]);
                                            $query->orwhere('nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });                            

                        })  */          
                                          
                        ->toJson();



            $model = App\Producto::with(
                [
                           'variacions' => function($query) use ($busq) {
                               $query->select('variacions.nombre as nomb_variacion')
                                    ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                                         //dd("sad");
                                         for ($i = 0; $i < count($busq); $i++){
                                           // dd($busq[$i]);
                                            $query->orwhere('variacions.nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });
                           }, 


                          'modelo' => function($query) use ($busq) {
                               $query->select('modelos.nombre as nom_modelo')
                                    ->Where(function ($query) use($busq) { 

                                         for ($i = 0; $i < count($busq); $i++){
                                             //dd($busq[$i]);
                                            $query->orwhere('modelos.nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });
                           }, 


                ]           

            )
           ->select('*')
           ->get();
           return $model;
           dd($model);

            //return DataTables::eloquent($model)
            //->editColumn('nombre', '{!! str_limit($busq[0], 60) !!}')
            //->make(true);

            //https://datatables.yajrabox.com/eloquent/manual-count

            return DataTables::eloquent($model)
                        ->filterColumn('modelos.nombre', function($query, $busq) {
                           //->filter(function ($query) use ($busq) {  
                            
                            //$sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
                                    $query->Where(function ($query) use($busq) { 
                                        dd($busq);
                                         for ($i = 0; $i < count($busq); $i++){
                                            dd($busq[$i]);
                                            $query->orwhere('nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });                            

                        })            
                        /*->addColumn('nombre', function (Producto $producto) {
                            return $producto->variacions->map(function($marca) {
                                return $marca->nombre;
                                //str_limit($marca->nombre, 30, '...');
                            })->implode('<br>');
                        })
                        ->addColumn('nom_modelo', function (Producto $producto) {
                            return $producto->modelo->map(function($modelo) {
                                return $modelo->nombre;
                                //str_limit($marca->nombre, 30, '...');
                            })->implode('<br>');
                        }) */                       
                        ->toJson();


        });


        Route::get('api/resultado_productos1', function () {

            $busq=explode(' ', request('search.value'));
            //dd($busq);
            $model = App\Producto::with(
                [
                           'variacions' => function($query) use ($busq) {
                               $query->select('variacions.nombre as nomb_variacion')
                                    ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                                         //dd("sad");
                                         for ($i = 0; $i < count($busq); $i++){
                                           // dd($busq[$i]);
                                            $query->orwhere('variacions.nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });
                           }, 


                          'modelo' => function($query) use ($busq) {
                               $query->select('modelos.nombre as nom_modelo')
                                    ->Where(function ($query) use($busq) { 

                                         for ($i = 0; $i < count($busq); $i++){
                                             //dd($busq[$i]);
                                            $query->orwhere('modelos.nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });
                           }, 


                ]           

            )
           ->select('*')
           ->get();
           return $model;
           dd($model);

            //return DataTables::eloquent($model)
            //->editColumn('nombre', '{!! str_limit($busq[0], 60) !!}')
            //->make(true);

            //https://datatables.yajrabox.com/eloquent/manual-count

            return DataTables::eloquent($model)
                        ->filterColumn('modelos.nombre', function($query, $busq) {
                           //->filter(function ($query) use ($busq) {  
                            
                            //$sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
                                    $query->Where(function ($query) use($busq) { 
                                        dd($busq);
                                         for ($i = 0; $i < count($busq); $i++){
                                            dd($busq[$i]);
                                            $query->orwhere('nombre', 'like',  '%' . $busq[$i] .'%');
                                         }      
                                    });                            

                        })            
                        /*->addColumn('nombre', function (Producto $producto) {
                            return $producto->variacions->map(function($marca) {
                                return $marca->nombre;
                                //str_limit($marca->nombre, 30, '...');
                            })->implode('<br>');
                        })
                        ->addColumn('nom_modelo', function (Producto $producto) {
                            return $producto->modelo->map(function($modelo) {
                                return $modelo->nombre;
                                //str_limit($marca->nombre, 30, '...');
                            })->implode('<br>');
                        }) */                       
                        ->toJson();


        });

        /*

          'marca' => function($query)  use ($busq) {
               $query->select('*')
                   ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('marcas.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    }); 

           },  
    */




 //$busq="variacion8";  

        /*
       $productos = App\Producto::with(
                [
                           'variacions' => function($query) use ($busq) {
                               $query
                                    ->where('variacions.nombre', 'like',  '%' . "v" .'%');
                           }, 
                ]           

            )->get();
       */


       /*
                    ->filter(function ($instance) use ($busq) {
                        //if (!empty($request->get('email'))) 
                        {
                            $instance->collection = $instance->collection->filter(function ($row) use ($busq) {
                                //dd($row['variacions'][0]['nombre']);

                                foreach ($row['variacions'] as $key => $value) {
                                    return true; //$value['nombre'];    
                                }
                              
                            });
                        }
   
              
   
                    })
                    */



/*
 return DataTables::
        ->eloquent($this->query())
        ->filter(function ($query) use ($busq) {
            if (request()->has('sign')) {
                $query->whereHas('signs', function($q) use($sign){
                    $q->where('sign', $sign);
                });
            }
        }, true)

*/


/*
Route::get('/perfiles', 'CatalogosController@index_perfil')
    ->name('perfiles.index');
*/