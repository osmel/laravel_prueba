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

Use App\Almacen;

Use App\Movimiento;
Use App\Inventario;

Use App\Almacen_Producto;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder; 


class InventarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  
        $this->middleware('EsAdmin'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        

      $lista_almacenes = Almacen::select('id', 'nombre')->get();
      //dd($lista_almacenes);
      //return view('edit')->compact(''worktypes_list');

        $recepcionados=Producto::get(); 
        return view('inventarios.recepcion.recepcion',['title'=>'Listado de usuarios',
                                                        'almacenes'=>$lista_almacenes,
                                                       'recepcionados'=>$recepcionados,

                                                       ]);  //dashboard.home
    }





    public function busqueda_productos(Request $request)
    {


       $data['key']=$request->get('key'); 
       $data['nombre']=$request->get('nombre'); 

       $result=[];
      switch ($data['nombre']) {
        case 'editando_productos':
            $result=Producto::where('surtido', 'LIKE', "%{$data['key']}%")->get();
            return $result;
          break;
        default:
             $result=Producto::where('surtido', 'LIKE', "%{$data['key']}%")->get();
          break;
       }
        return response()->json($result);

    }      




     //validacion creacion de nueva entrada
    public function store_entrada() { //procesar el formulario


      //dd(Auth::user()->id);
       //if (Auth::check()) { //si esta logueado
                //$usuario = Auth::user();
      //if ($request->isMethod('post')) {}      
  
          $codigo = request()->post('editando_productos');

          $producto_id =Producto::where('surtido',$codigo)->first();

        //$data['producto_id'] = ($carrito); // ? $carrito->id : 
        //return json_encode($carrito);

       //Pasar errores a la sesión. Utilizando el método withErrors
        if (empty($producto_id)) {  //si el campo esta vacio, que redireccione
            return redirect('inventario')->withErrors([
                'name' => 'El campo Codigo debe ser correcto'
            ]);
        }



        $data = request()->validate([
            'editando_productos' => 'required',
                      'cantidad' => 'required',
                        'precio' => 'required',
                    'almacen_id' => 'required',
                    'producto_id'=>'',
        ], [
            'editando_productos.required' => 'El campo Código es obligatorio',
            'cantidad.required' => 'El campo cantidad es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            'almacen_id.required' => 'El campo almacén es obligatorio',
        ]);


        //return json_encode($producto_id);

        //return json_encode($data);
        Movimiento::create([  //creando o insertando un registro en perfil
            'cantidad'   => $data['cantidad'],
            'precio'     => $data['precio'],
            'almacen_id' => $data['almacen_id'],
            'producto_id' => $producto_id->id, //$data['producto_id'],
            'surtido'=> $data['editando_productos'],
            'user_id'=> (Auth::user()->id),
            

        ]);
        return redirect()->route('inventario.index'); //redirigiendo a 
    }




    function eliminar_recepcion(Movimiento $movimiento){
        $movimiento->delete();
        return redirect()->route('inventario.index'); 
    }


    public function entrada_existencia() { //proceso final para entrar los datos al stock

      $movimientos = Movimiento::where('user_id', (Auth::user()->id)  )->get();


      foreach ($movimientos as $valor){ 
        //print_r($valor->id);
            /*
            $inventario = Inventario::updateOrCreate(
                ['producto_id' => $valor->producto_id ],
                ['user_id' => (Auth::user()->id)]
            );
            */


            $anterior = Almacen_Producto::where('producto_id',$valor->producto_id)
                                            ->where('almacen_id', $valor->almacen_id)
                                            ->where( 'precio' ,$valor->precio)
                                            ->first();

             //dd($valor->cantidad+$anterior->cantidad);
             $new_cantidad = (isset($anterior->cantidad)) ? $valor->cantidad+$anterior->cantidad : $valor->cantidad;

           $pivot = Almacen_Producto::updateOrCreate(
                ['producto_id' => $valor->producto_id,'almacen_id' => $valor->almacen_id,'precio' => $valor->precio  ],
                ['cantidad' => $new_cantidad ]
            );

           Movimiento::where('user_id' , (Auth::user()->id) )->delete();

            //print_r($inventario->id);
      }  


     // `inventario_id`, `almacen_id`, `precio`, `cantidad`

      return redirect()->route('inicio'); //redirigiendo a 

      //return $movimientos;

      /*
        $flight = Inventario::updateOrCreate(
            ['producto_id' => $prod ],
            ['user_id' => (Auth::user()->id)]
        );
        */


    
    }




}
