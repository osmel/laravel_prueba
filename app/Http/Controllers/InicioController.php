<?php

namespace App\Http\Controllers;

use App\User; //modelo User del ORM eloquent
use App\Role;
use App\Almacen; 
use App\Producto; 
use App\Almacen_Producto; 
use Illuminate\Support\Facades\DB;  //para usar DB, para consultas nativas y constructor laravel

use App\Http\Servicios\NotificacionesInterface as NotificacionesInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder; 


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

        //dd($carrito);

        //$producto= Producto::paginate(9); //paginate(2); //simplePaginate//all(); //->take(10);   

          $producto = Almacen_Producto::with([
           'producto' => function($query)  {
               $query->select('*');
           },   
           'almacen' => function($query)  {
               $query->select('*');
           },   
           

           ])->paginate(9);       


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


          //dd($producto);


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
        $almacenes = Almacen::select('id', 'nombre')->get();
        $perfiles = Role::select('id', 'nombre_rol')->get();
        return view('usuarios.create',['almacenes'=>$almacenes, 'perfiles'=>$perfiles]); 
    }

    
    //validacion creacion de nuevo usuario
    public function store() { //procesar el formulario

        //metodo validate para las reglas de validación
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
            'almacen_id' => 'required',
            'role_id' => 'required',
            
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El campo email es unico',
            'almacen_id.required' => 'El campo almacen es obligatorio',
            'role_id.required' => 'El campo perfil es obligatorio',
        ]);
        
        User::create([  //creando o insertando un registro en user
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'almacen_id' => $data['almacen_id'],
            'role_id' => $data['role_id'],
        ]);

        return redirect()->route('users.index'); //redirigiendo a 
    }


    //editar usuario
    public function edit(User $user) {
        

        $almacenes = Almacen::select('id', 'nombre')->get();
        $perfiles = Role::select('id', 'nombre_rol')->get();
        //dd($user->role_id); //$user->almacen_id
        return view('usuarios.edit', ['user' => $user, 'almacenes'=>$almacenes, 'perfiles'=>$perfiles]); 

    }

    //validacion de edicion de usuarios
    public function update(User $user){
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,'.$user->id ],
            'password' => '', //aqui no lo validamos
            'almacen_id' => 'required',
            'role_id' => 'required',
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
