<?php

namespace App\Http\Controllers;

Use App\Producto;

Use App\Categoria;
Use App\Fabricante;

Use App\Marca;
Use App\Modelo;
Use App\Variacion;

Use App\Descripcion;
Use App\Foto;

Use App\Codigo;


Use App\Movimiento;
Use App\Inventario;

Use App\Almacen_Producto;
Use App\Promocion;
Use App\Condicion;

/*
Use App\Marca;
Use App\Codigo;
Use App\Categoria;
//variacions.modelo.marca.codigo.fabricante.categoria
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
              

       $fecha='"2020-07-18"';

      $sql="select max(promocion_id) promocion_id, max(descuento) descuento, max(id_almacen) id_almacen, max(id_fabricante) id_fabricante,max(id_variacion) id_variacion  from                            
          (

                select promocion_id,descuento,

                CASE
                    WHEN campo = 'almacen' THEN id
                END id_almacen,

                CASE
                    WHEN campo = 'fabricante' THEN id
                END id_fabricante,


                CASE
                    WHEN campo = 'variacion' THEN id
                END id_variacion          


                FROM
                  (
                      SELECT c.promocion_id,c.campo,GROUP_CONCAT(c.campo_id) id, p.descuento FROM condicions c
                      inner join ( select * from promocions where  ( promocions.fecha_inicio <=".$fecha." and  promocions.fecha_fin >= ".$fecha."   )     ) p ON p.id=c.promocion_id
                      GROUP BY promocion_id, campo
                  )    aaa
          )   bb 
          group by promocion_id ";
    
          $info = \DB::select(\DB::raw($sql));
              //dd( $info );

           $promocion=[];
              foreach ($info as $key => $value) {
                        $productos = Almacen_Producto::whereHas('almacen', 
                            function (Builder $query)  use ($value) {
                              $query->Where(function ($query)  use ($value) {
                                  if ($value->id_almacen) {
                                      $v = explode(",",   $value->id_almacen);
                                      $query->whereIn("almacens.id", $v );
                                  }  else {
                                    $query->whereNotIn("almacens.id", [] );
                                  }
                              });
                              }, '>=', 1)
                           ->whereHas('producto', 
                            function (Builder $query) use ($value) {
                                  $query->whereHas('fabricante', 
                                            function (Builder $query) use ($value) {
                                              $query->Where(function ($query)  use ($value) {
                                                       if ($value->id_fabricante) {
                                                            $v = explode(",",   $value->id_fabricante);
                                                            $query->whereIn("fabricantes.id", $v );
                                                        }  else {
                                                          $query->whereNotIn("fabricantes.id", [] );
                                                        }

                                              });
                                      }, '>=', 1);
                                   $query->whereHas('variacions',   //marca, modelo, variacion
                                            function (Builder $query)  use ($value) {
                                              
                                              $query->Where(function ($query)   use ($value) {
                                                       
                                                       if ($value->id_variacion) {
                                                           $v = explode(",",   $value->id_variacion);
                                                            $query->whereIn("variacions.id", $v );
                                                        }  else {
                                                          $query->whereNotIn("variacions.id", [] );
                                                        }                                                      
                                              });

                                      }, '>=', 1);
                              }, '>=', 1)->get();
                       
                        $productos->map(function($item) use ($value) {
                            $item['descuento'] = $value->descuento;
                            return $item;
                        });

                          $promocion[] = $productos;

              } //fin del foreach   



        if ($request->session()->has('arreglo')) { 
            $arr =  [] ;
            foreach ($request->session()->get('arreglo') as $llave => $valor) {
                $arr[] =  $llave ;
            }

            $carrito = Producto::whereIn('id', $arr)->get(); 
        }  else {
            $carrito =Producto::where('id',0)->get();
        }      

            $importe=$carrito->sum(function ($producto) {
                  return $producto['precio']* (session('arreglo.'.$producto['id']) ) ;
            });            

 

           $producto = Almacen_Producto::with([
           'producto' => function($query)  {
               $query->select('*');
           },   
           ])
           ->paginate(9);

            $producto->map(function($item) use ($promocion) { 
                  $acumulado =0;
                  foreach ($promocion as $key => $value) {
                       if ( $value->where('id',$item['id'] )->first() ) { //
                           $acumulado = $acumulado+$value->where('id',$item['id'] )->first()->descuento;

                       }

                  }
                      $item['descuento'] =$acumulado; //$value->descuento;
                      return $item;
                  });



        if ($request->ajax()){            //pregunta si el request es mediante ajax
               //vamos a enviar una respuesta de tipo json... vamos a responder con el partial q hemos creado
                // no seria la vista inicio, sino la vista inicio_ajax
                 //render : lo unico q se es que sin el no se envia todo el html al .js
              return response()->json(  view('presentacion.galeria',['title'=>'Listado de usuarios',
                'carrito'=>$carrito,
                'importe'=>$importe,
              //  'promocion'=>$promocion,
                'producto'=>$producto])->render()  ) ;

        }    

        if (Auth::check()) { //si esta logueado


                $usuario = Auth::user();  //usuario logueado, no es lo mismo q la tabla de usuarios

                if ( $usuario->esAdministrador() ) { 
                      return view('inicio',['title'=>'Listado de usuarios','carrito'=>$carrito,'importe'=>$importe,'producto'=>$producto]);  //dashboard.home
                } else {
                      return view('inicio',['title'=>'Listado de usuarios','carrito'=>$carrito,'importe'=>$importe,'producto'=>$producto]);  //dashboard.home
                }

        }


 
        return view('inicio',['title'=>'Listado de usuarios','carrito'=>$carrito,'importe'=>$importe,'producto'=>$producto]);  //dashboard.home
    }


    
    public function session_producto(Request $request)
    {


        $data = request()->all(); //recibiendo los datos de la petición

        if ($request->session()->has( 'arreglo.'.$data['id_producto']  )) {  //si existe sumarlo

            $suma=((int)$request->session()->get('arreglo.'.$data['id_producto']))+((int)$data['cantidad'] );
            $request->session()->put('arreglo.'.$data['id_producto'],     $suma  );
        } else {    //crearlo nuevo
            $request->session()->put('arreglo.'.$data['id_producto'], (int)$data['cantidad']);
        }

        if ( isset($data['cambio']) ) {
            $request->session()->put('arreglo.'.$data['id_producto'], (int)$data['cantidad']);
        }

        //eliminar elemento si esta en cero
         if ($request->session()->has( 'arreglo.'.$data['id_producto']  )) { 
              if ((session( 'arreglo.'.$data['id_producto']))==0) {

                $request->session()->forget( 'arreglo.'.$data['id_producto']);
              }
         }   


       if ($request->session()->has('arreglo')) { 
            $arr =  [] ;
            foreach ($request->session()->get('arreglo') as $llave => $valor) {
                $arr[] =  $llave ;
            }

            $carrito = Producto::whereIn('id', $arr)->get(); 
        }  else {
            $carrito =Producto::where('id',0)->get();
        }            
        

            $importe=$carrito->sum(function ($producto) {
                  return $producto['precio']* (session('arreglo.'.$producto['id']) ) ;
            });
            //return json_encode($importe);



        $total_prod_carrito=count(session('arreglo'));

        if ($request->ajax()){            //pregunta si el request es mediante ajax
               //vamos a enviar una respuesta de tipo json... vamos a responder con el partial q hemos creado
                // no seria la vista inicio, sino la vista inicio_ajax
                 //render : lo unico q se es que sin el no se envia todo el html al .js
              return response()->json( [
                        'total_prod_carrito' => $total_prod_carrito,
                        'importe'=>$importe,
                        'vista'=>view('presentacion.productos_cesta',['carrito'=>$carrito])->render()  
                        ]
                 ) ;

        }   

              return response()->json( [
                      'total_prod_carrito' => $total_prod_carrito,
                      'importe'=>$importe,
                      'vista'=>view('presentacion.productos_cesta',['carrito'=>$carrito])->render()  
                      ]
                 ) ;
        
        //return json_encode(  $data  );

    }

    public function modal_imagen(Producto $producto){
           
        //return json_encode($producto->variacions);
        //return json_encode($producto->variacions[0]->modelo);
       return view( 'presentacion.modal_imagen',['producto'=>$producto]);
    }   

    public function cambio_imagen_modal(Producto $producto, Request $request){
       $id_imagen = $request->input('id_imagen');
       return json_encode($producto->foto->find($id_imagen));
    }  




    public function buscar(Request $request)
    {


         $busq=$request->get('busqueda'); 

          //.codigo.fabricante.categoria
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



            ->orWhereHas('descripcion', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('descripcions.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)


            ->orWhereHas('codigo', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('codigos.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)

            ->orWhereHas( 'fabricante', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('fabricantes.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)

            ->orWhereHas('categoria', 
                  function (Builder $query) use ($busq) {
                    $query->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('categorias.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });

            }, '>=', 1)->paginate(9);

            //dd($productos); 


            //carrito

            if ($request->session()->has('arreglo')) { 
                $arr =  [] ;
                foreach ($request->session()->get('arreglo') as $llave => $valor) {
                    $arr[] =  $llave ;
                }

                $carrito = Producto::whereIn('id', $arr)->get(); 
            }  else {
                $carrito =Producto::where('id',0)->get();
            }      

            $importe=$carrito->sum(function ($producto) {
                  return $producto['precio']* (session('arreglo.'.$producto['id']) ) ;
            });              
            //fin del carrito


        

        if ($request->ajax()){            //pregunta si el request es mediante ajax
               //vamos a enviar una respuesta de tipo json... vamos a responder con el partial q hemos creado
                // no seria la vista inicio, sino la vista inicio_ajax
                 //render : lo unico q se es que sin el no se envia todo el html al .js
              return response()->json(  view('presentacion.galeria',['title'=>'Listado de usuarios','carrito'=>$carrito,'importe'=>$importe,'producto'=>$productos])->render()  ) ;

        }  



    }


 public function resultado(Request $request)
    {


       $data['key']=$request->get('key'); 
       $data['nombre']=$request->get('nombre'); 
        /*
       if ( isset($request->get('idusuario')) ) { 
        $data['idusuario']=$request->get('idusuario');
       } 
       */

       $result=[];
      switch ($data['nombre']) {
        case 'editando_proyectos':
            $result=Fabricante::where('nombre', 'LIKE', "%{$data['key']}%")->get();
            return $result;
          break;
        default:
             $result=Fabricante::where('nombre', 'LIKE', "%{$data['key']}%")->get();
          break;
       }
        return response()->json($result);

    }      






 public function get_elementos_productos(Request $request)
    {



         $resultado['categoria']= Categoria::get(); 
         $resultado['fabricante']= Fabricante::get(); 

          $resultado['variacion'] = Marca::with([
           'modelo' => function($query)   {
               $query->select('*')
               ->with([
                   'variacion' => function($query)   {
                       $query->select('*')
                       ->with([
                           'motor' => function($query)   {
                               $query->select('*');
                           },  
                        ]);
                   },  
                ]);  
            },  
        ])
          ->get(); 



         $resultado['descripcion']= Descripcion::get();  
         $resultado['codigo']= Codigo::get(); 
         $resultado['foto']= Foto::get(); 
         

        return response()->json( $resultado);

   }      


 






}

