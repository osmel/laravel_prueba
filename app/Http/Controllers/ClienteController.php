<?php

namespace App\Http\Controllers;

use App\User; //modelo User del ORM eloquent
use App\Producto;
use Illuminate\Support\Facades\DB;  //para usar DB, para consultas nativas y constructor laravel

use App\Http\Servicios\NotificacionesInterface as NotificacionesInterface;

use Illuminate\Http\Request;
use App\Almacen_Producto; 

use Illuminate\Support\Facades\Auth;


class ClienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //Sin importar cómo se resuelva esta inyección de dependencias, $miclase debe ser capaz de usar los métodos que dicta la interfaz.
    public function __construct(NotificacionesInterface $miclase){
        $this->middleware('auth');  
    }

     public function dashboard(Request $request) { //index

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

        //$producto= Producto::paginate(10); //paginate(2); //simplePaginate//all(); //->take(10);   

          $producto = Almacen_Producto::with([
           'producto' => function($query)  {
               $query->select('*');
               //->withPivot('almacen_id','inventario_id');
           },   
           ])->paginate(9);  

            

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


 
        return view('inicio',['title'=>'Listado de usuarios','carrito'=>$carrito,'importe'=>$importe,'producto'=>$producto]); 


        
         //$producto= Producto::all(); //->take(10); 
         //return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
        
        //return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
    }

   



}
