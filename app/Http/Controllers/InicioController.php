<?php

namespace App\Http\Controllers;

use App\User; //modelo User del ORM eloquent
use App\Producto; 
use Illuminate\Support\Facades\DB;  //para usar DB, para consultas nativas y constructor laravel

use App\Http\Servicios\NotificacionesInterface as NotificacionesInterface;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;


class InicioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //Sin importar cómo se resuelva esta inyección de dependencias, $miclase debe ser capaz de usar los métodos que dicta la interfaz.
    public function __construct(NotificacionesInterface $miclase)
    {
        //dd( $miclase->mensaje('will') );

        //$miclase->index();
        //dd($miclase->index());

        //cuando trata de entrar en esta clase sino esta logueado lo redirecciona a login
        $this->middleware('auth');  
        $this->middleware('EsAdmin');  

    }



    public function condiciones(Request $request)
    {
        $name = $request->input('condiciones');
        return json_encode($name);

        //
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


 
        return view('inicio',['title'=>'Listado de usuarios','carrito'=>$carrito,'importe'=>$importe,'producto'=>$producto]); 


        
         //$producto= Producto::all(); //->take(10); 
         //return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
        
        //return view('inicio',['title'=>'Listado de usuarios','producto'=>$producto]);  //dashboard.home
    }

    //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de usuarios//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla usuarios
    public function index() { //index
        //dd( session('lang') ); 


        $users= User::all()->take(10); 
        return view('usuarios.usuarios',['title'=>'Listado de usuarios','users'=>$users]); 
    }

  
    //Crear un nuevo usuario
    public function create() { //motrar el formulario
        return view('usuarios.create');
    }

    
    //validacion creacion de nuevo usuario
    public function store() { //procesar el formulario

        //metodo validate para las reglas de validación
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El campo email es unico'
        ]);
        
        User::create([  //creando o insertando un registro en user
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => 1
        ]);

        return redirect()->route('users.index'); //redirigiendo a 
    }


    //editar usuario
    public function edit(User $user) {
        return view('usuarios.edit', ['user' => $user]);
    }

    //validacion de edicion de usuarios
    public function update(User $user){
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,'.$user->id ],
            'password' => '', //aqui no lo validamos
        ]);

        //pero luego de no haberlo validado, si viene con valor, lo tenemos en cuenta para el modelo
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {  //em casp contrario, no lo tenemos en cuenta para la actualizacion del modelo
            unset($data['password']);
        }

        $user->update($data);
        return redirect('/usuarios');  //return redirect()->route('users.index', ['user' => $user]);
    }

  
    function eliminar_usuario(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }




}
