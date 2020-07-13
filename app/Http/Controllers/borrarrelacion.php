<?php

namespace App\Http\Controllers;

Use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        $producto= Producto::paginate(10); //paginate(2); //simplePaginate//all(); //->take(10);         

        if ($request->ajax()){            //pregunta si el request es mediante ajax
               //vamos a enviar una respuesta de tipo json... vamos a responder con el partial q hemos creado
                // no seria la vista inicio, sino la vista inicio_ajax
                 //render : lo unico q se es que sin el no se envia todo el html al .js
              return response()->json(  view('presentacion.galeria',['title'=>'Listado de usuarios','producto'=>$producto])->render()  ) ;

        }    

        if (Auth::check()) { //si esta logueado


                $usuario = Auth::user();  //usuario logueado, no es lo mismo q la tabla de usuarios

                if ( $usuario->esAdministrador() ) { 
                      return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
                } else {
                      return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
                }

        }


 
        return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
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

        //return json_encode( Producto::first()->modelo[0]->marca );

        $busq='variacion8';

        //$month = 12; 
        /*
        $productos = Producto::with(['variacions' => function($query) use ($busq) {
          $query->where('nombre', $busq);
        }])->get();
        */

        /*
        $productos = Producto::with('variacions')->whereHas('nombre', function($query) use ($busq){
            $query->nombre($busq);

        })->get();
        */


        //https://omarbarbosa.com/posts/optimiza-consultas-eloquent-reducir-uso-memoria-laravel


         $busq=$request->get('busqueda'); //[0]; //'variacion';

         //Consultar todos los productos con modelos relacionados
        $productos = Producto::with([
 

           'variacions' => function($query) use ($busq) {
               $query->select('*')
                    ->withPivot('producto_id','variacion_id')  //tabla producto_variacion
                    //->whereIn('nombre', $busq); # Muchos a muchos //'nombre', 'inicio'
                    //->where('nombre','LIKE', '%'.$busq.'%'); # Muchos a muchos //'nombre', 'inicio'
                    //whereJsonContains

                    ->Where(function ($query) use($busq) {
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });



           },   

           'modelo' => function($query){
               $query->select('*'); # Uno a muchos  //'id', 'nombre', 'url'
           },  

          'marca' => function($query){
               $query->select('*'); # Uno a muchos  //'id', 'nombre', 'url'
           },             


           'foto' => function($query){
               $query->select(); # Uno a muchos  //'id', 'nombre', 'url'
           },    
           
           'fabricante' => function($query)  use ($busq) { 
               $query->select(); # Uno a muchos //'id', 'nombre'
           }, 
           
           'codigo' => function($query)  use ($busq) {
               $query->select(); # Uno a muchos //'id', 'nombre'
           },
         

        ])->get(['id']); //, 'title', 'content', 'user_id'

        return (""  );                  
        foreach ($productos as $llave => $valor) {
          return json_encode($valor  );                  
        }

         return json_encode($productos  );

         /*
         //$producto= Producto::all();
         return json_encode( Producto::variacions()  );
            //return json_encode($request->get('busqueda'));

           $producto= Producto::nombre($request->get('busqueda'))
                    //->type($request->get('type'))
                    ->orderBy('id', 'DESC')
                    ->paginate();

              //$producto= Producto::nombre($request->get('busqueda'));       
         return json_encode($producto  );

        $producto= Producto::name($request->get('name'))
                        ->type($request->get('type'))
                        ->orderBy('id', 'DESC')
                        ->paginate();

    //return view('usuarios.usuarios',compact('users')); 

        return json_encode('value');


        */

/*
        $producto= Producto::paginate(10); //paginate(2); //simplePaginate//all(); //->take(10);         

        if ($request->ajax()){            //pregunta si el request es mediante ajax
               //vamos a enviar una respuesta de tipo json... vamos a responder con el partial q hemos creado
                // no seria la vista inicio, sino la vista inicio_ajax
                 //render : lo unico q se es que sin el no se envia todo el html al .js
              return response()->json(  view('presentacion.galeria',['title'=>'Listado de usuarios','producto'=>$producto])->render()  ) ;

        }    

        if (Auth::check()) { //si esta logueado


                $usuario = Auth::user();  //usuario logueado, no es lo mismo q la tabla de usuarios

                if ( $usuario->esAdministrador() ) { 
                      return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
                } else {
                      return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
                }

        }


 
        return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home

*/        
    }




}
