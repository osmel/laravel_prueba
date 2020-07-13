<?php

namespace App\Http\Controllers;

Use App\Producto;
Use App\Fabricante;
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


         $busq=$request->get('busqueda'); 

         //Consultar todos los productos con modelos relacionados
        $productos = Producto::with([
 

           'variacions' => function($query) use ($busq) {
               $query->select('*')
                    ->withPivot('producto_id','variacion_id')  //tabla producto_variacion
                    ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });
           },   

           'modelo' => function($query)  use ($busq) {
               $query->select('*')
                    ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('modelos.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    });               
           },  

          'marca' => function($query)  use ($busq) {
               $query->select('*')
                   ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('marcas.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    }); 

           },             
           
           
           'codigo' => function($query)  use ($busq) {

                $query->select('*')
                   ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('codigos.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    }); 
               
           },
         
           'fabricante' => function($query)  use ($busq) {  //con este hay problemas porq es mucho a 1 a la inversa
               $query->select('*') # Uno a muchos //'id', 'nombre'
                   ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('fabricantes.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    }); 
           }, 

           'categoria' => function($query)  use ($busq) {  //con este hay problemas porq es mucho a 1 a la inversa
               $query->select('*') # Uno a muchos //'id', 'nombre'
                   ->Where(function ($query) use($busq) { //este simula un like con un whereIn
                         for ($i = 0; $i < count($busq); $i++){
                            $query->orwhere('categorias.nombre', 'like',  '%' . $busq[$i] .'%');
                         }      
                    }); 
           },            

           'foto' => function($query)  use ($busq) {
               $query->select(); # Uno a muchos  //'id', 'nombre', 'url'
            },    

        ])->get(); 


        $arreglo=[];
        foreach ($productos as $llave => $valor) {
            if 
             ((  


                (  (isset($valor->categoria)) || (!(is_null($valor->categoria)))  )  ||
                (  (isset($valor->fabricante)) || (!(is_null($valor->fabricante)))  )  ||

                ( !(empty($valor->variacions)) && (count($valor->variacions)>0) )  ||
                ( !(empty($valor->codigo)) && (count($valor->codigo)>0) )  ||

                
                ( !(empty($valor->modelo)) && (count($valor->modelo)>0) )  ||
                ( !(empty($valor->marca)) && (count($valor->marca)>0) )  

             )) {
                $arreglo[] =  $valor->id ;
             }
        }  



        $productos = Producto::whereIn('id', $arreglo)->paginate(10); //->whereNotIn('id', $not_ids)

        

        if ($request->ajax()){            //pregunta si el request es mediante ajax
               //vamos a enviar una respuesta de tipo json... vamos a responder con el partial q hemos creado
                // no seria la vista inicio, sino la vista inicio_ajax
                 //render : lo unico q se es que sin el no se envia todo el html al .js
              return response()->json(  view('presentacion.galeria',['title'=>'Listado de usuarios','producto'=>$productos])->render()  ) ;

        }  



    }



     // return json_encode($productos  );

        //recorrer todos 
        /*
        $arreglo=[];
        foreach ($productos as $llave => $valor) {
            if 
             ((  


                (  (isset($valor->categoria)) || (!(is_null($valor->categoria)))  )  ||
                (  (isset($valor->fabricante)) || (!(is_null($valor->fabricante)))  )  ||

                ( !(empty($valor->variacions)) && (count($valor->variacions)>0) )  ||
                ( !(empty($valor->codigo)) && (count($valor->codigo)>0) )  ||

                
                ( !(empty($valor->modelo)) && (count($valor->modelo)>0) )  ||
                ( !(empty($valor->marca)) && (count($valor->marca)>0) )  

             )) {
                // print_r (json_encode(  $valor ));  
                //echo '<br/><br/><br/>';
                //return json_encode($valor->id);
                
                //$arreglo[] =  $valor ;
                $arreglo = Producto::find($valor->id);

             }

              
        }   
        $miElocuent=$arreglo;
        */
           //$miElocuent= (Producto::first() ); 
        //dd($miElocuent);

        // convert json to array
        //$array = json_decode($arreglo, true);
        //  create a new collection instance from the array
        //$miElocuent= collect($arreglo); //::paginate(10);

        //dd($miElocuent);

    

        //$producto= Producto::paginate(10);
       // $productos = Producto::paginate(10);




}
