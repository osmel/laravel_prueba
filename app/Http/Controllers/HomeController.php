<?php

namespace App\Http\Controllers;

Use App\Producto;

Use App\Fabricante;
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
        //dd ( $request->session()->all() );
        //$request->session()->forget('arreglo.1') ;
        //$request->session()->flush();
        //dd ( $request->session()->forget('arreglo') );
        //dd ( $request->session()->get('arreglo') );


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

        //dd($carrito);

        $producto= Producto::paginate(10); //paginate(2); //simplePaginate//all(); //->take(10);         

        if ($request->ajax()){            //pregunta si el request es mediante ajax
               //vamos a enviar una respuesta de tipo json... vamos a responder con el partial q hemos creado
                // no seria la vista inicio, sino la vista inicio_ajax
                 //render : lo unico q se es que sin el no se envia todo el html al .js
              return response()->json(  view('presentacion.galeria',['title'=>'Listado de usuarios',
                'carrito'=>$carrito,
                'importe'=>$importe,
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

            }, '>=', 1)->paginate(10);

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







}
