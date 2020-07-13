<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Role as Perfil;

use App\Marca;
use App\Modelo;

use App\Almacen;
use App\Variacion;
use App\Categoria;

use App\Fabricante;
use App\Motor;

use App\Producto;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//aqui adentro pongo todas las rutas
Route::group(['middleware' => ['idiomas']], function () {

	Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([ //Limito el valor del parámetro {lang} solo a «en» o «es» para evitar que se asigne a la variable de sesión un idioma que no exista.
        'lang' => 'en|es'  //
    ]);


    Route::get('/', 'HomeController@index')
    ->name('home');

	
	Route::get('/home', 'InicioController@dashboard')
    ->name('inicio');
    

    Route::get('/estudiante', 'ClienteController@dashboard');

    Route::POST('/pagina',  'InicioController@condiciones');


/////////////////////////////////gestion de Usuarios//////////////////
    Route::get('/usuarios', 'InicioController@index')
    ->name('users.index');

       //nuevo
    Route::get('/usuarios/nuevo', 'InicioController@create') //crear nuevo usuario
        ->name('users.create');
    Route::POST('/usuarios/crear', 'InicioController@store') //validacion creacion de nuevo usuario
        ->name('users.crear');

        //editar
    Route::get('/usuarios/{user}/editar', 'InicioController@edit') //editar usuario
        ->name('users.edit');
    Route::put('/usuarios/{user}', 'InicioController@update'); //validacion edicion de usuario

       //eliminar    
    Route::get('/eliminar_usuario/{user}', 'InicioController@eliminar_usuario');
    //Route::delete('/usuarios/{user}', 'InicioController@destroy')->name('users.destroy');
        
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////catalogos///////////////////////////////
////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////Perfiles//////////////////

     Route::get('/perfiles', 'CatalogosController@index_perfil')
    ->name('perfiles.index');


       //nuevo
    Route::get('/perfiles/nuevo', 'CatalogosController@create_perfil') //crear nuevo perfil
        ->name('perfiles.create');
    Route::POST('/perfiles/crear', 'CatalogosController@store_perfil') //validacion creacion de nuevo perfil
        ->name('perfiles.crear');

        //editar
    Route::get('/perfiles/{perfil}/editar', 'CatalogosController@edit_perfil') //editar perfil
        ->name('perfiles.edit');
    Route::put('/perfiles/{perfil}', 'CatalogosController@update_perfil'); //validacion edicion de perfil

       //eliminar    
    Route::get('/eliminar_perfil/{perfil}', 'CatalogosController@eliminar_perfil');


  Route::get('api/resultado_perfiles', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(Perfil::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });


///////////////////////////////////////marcas/////////////////////////////////



     Route::get('/marcas', 'CatalogosController@index_marca')
    ->name('marcas.index');


       //nuevo
    Route::get('/marcas/nuevo', 'CatalogosController@create_marca') //crear nuevo marca
        ->name('marcas.create');
    Route::POST('/marcas/crear', 'CatalogosController@store_marca') //validacion creacion de nuevo marca
        ->name('marcas.crear');

        //editar
    Route::get('/marcas/{marca}/editar', 'CatalogosController@edit_marca') //editar marca
        ->name('marcas.edit');
    Route::put('/marcas/{marca}', 'CatalogosController@update_marca'); //validacion edicion de marca

       //eliminar    
    Route::get('/eliminar_marca/{marca}', 'CatalogosController@eliminar_marca');


  Route::get('api/resultado_marcas', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(marca::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });

///////////////////////////////modelo////////////////////////////////////////



     Route::get('/modelos', 'CatalogosController@index_modelo')
    ->name('modelos.index');


       //nuevo
    Route::get('/modelos/nuevo', 'CatalogosController@create_modelo') //crear nuevo modelo
        ->name('modelos.create');
    Route::POST('/modelos/crear', 'CatalogosController@store_modelo') //validacion creacion de nuevo modelo
        ->name('modelos.crear');

        //editar
    Route::get('/modelos/{modelo}/editar', 'CatalogosController@edit_modelo') //editar modelo
        ->name('modelos.edit');
    Route::put('/modelos/{modelo}', 'CatalogosController@update_modelo'); //validacion edicion de modelo

       //eliminar    
    Route::get('/eliminar_modelo/{modelo}', 'CatalogosController@eliminar_modelo');


  Route::get('api/resultado_modelos', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(modelo::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre_rol', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });




////////////////////////////////////////almacens//////////////////

     Route::get('/almacens', 'CatalogosController@index_almacen')
    ->name('almacens.index');


       //nuevo
    Route::get('/almacens/nuevo', 'CatalogosController@create_almacen') //crear nuevo almacen
        ->name('almacens.create');
    Route::POST('/almacens/crear', 'CatalogosController@store_almacen') //validacion creacion de nuevo almacen
        ->name('almacens.crear');

        //editar
    Route::get('/almacens/{almacen}/editar', 'CatalogosController@edit_almacen') //editar almacen
        ->name('almacens.edit');
    Route::put('/almacens/{almacen}', 'CatalogosController@update_almacen'); //validacion edicion de almacen

       //eliminar    
    Route::get('/eliminar_almacen/{almacen}', 'CatalogosController@eliminar_almacen');


  Route::get('api/resultado_almacens', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(Almacen::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });




////////////////////////////////////////variacions//////////////////

     Route::get('/variacions', 'CatalogosController@index_variacion')
    ->name('variacions.index');


       //nuevo
    Route::get('/variacions/nuevo', 'CatalogosController@create_variacion') //crear nuevo variacion
        ->name('variacions.create');
    Route::POST('/variacions/crear', 'CatalogosController@store_variacion') //validacion creacion de nuevo variacion
        ->name('variacions.crear');

        //editar
    Route::get('/variacions/{variacion}/editar', 'CatalogosController@edit_variacion') //editar variacion
        ->name('variacions.edit');
    Route::put('/variacions/{variacion}', 'CatalogosController@update_variacion'); //validacion edicion de variacion

       //eliminar    
    Route::get('/eliminar_variacion/{variacion}', 'CatalogosController@eliminar_variacion');


  Route::get('api/resultado_variacions', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(variacion::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });



////////////////////////////////////////categorias//////////////////

     Route::get('/categorias', 'CatalogosController@index_categoria')
    ->name('categorias.index');


       //nuevo
    Route::get('/categorias/nuevo', 'CatalogosController@create_categoria') //crear nuevo categoria
        ->name('categorias.create');
    Route::POST('/categorias/crear', 'CatalogosController@store_categoria') //validacion creacion de nuevo categoria
        ->name('categorias.crear');

        //editar
    Route::get('/categorias/{categoria}/editar', 'CatalogosController@edit_categoria') //editar categoria
        ->name('categorias.edit');
    Route::put('/categorias/{categoria}', 'CatalogosController@update_categoria'); //validacion edicion de categoria

       //eliminar    
    Route::get('/eliminar_categoria/{categoria}', 'CatalogosController@eliminar_categoria');


  Route::get('api/resultado_categorias', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(categoria::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });





////////////////////////////////////////fabricantes//////////////////

     Route::get('/fabricantes', 'CatalogosController@index_fabricante')
    ->name('fabricantes.index');


       //nuevo
    Route::get('/fabricantes/nuevo', 'CatalogosController@create_fabricante') //crear nuevo fabricante
        ->name('fabricantes.create');
    Route::POST('/fabricantes/crear', 'CatalogosController@store_fabricante') //validacion creacion de nuevo fabricante
        ->name('fabricantes.crear');

        //editar
    Route::get('/fabricantes/{fabricante}/editar', 'CatalogosController@edit_fabricante') //editar fabricante
        ->name('fabricantes.edit');
    Route::put('/fabricantes/{fabricante}', 'CatalogosController@update_fabricante'); //validacion edicion de fabricante

       //eliminar    
    Route::get('/eliminar_fabricante/{fabricante}', 'CatalogosController@eliminar_fabricante');


  Route::get('api/resultado_fabricantes', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(fabricante::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });




////////////////////////////////////////motors//////////////////

     Route::get('/motors', 'CatalogosController@index_motor')
    ->name('motors.index');


       //nuevo
    Route::get('/motors/nuevo', 'CatalogosController@create_motor') //crear nuevo motor
        ->name('motors.create');
    Route::POST('/motors/crear', 'CatalogosController@store_motor') //validacion creacion de nuevo motor
        ->name('motors.crear');

        //editar
    Route::get('/motors/{motor}/editar', 'CatalogosController@edit_motor') //editar motor
        ->name('motors.edit');
    Route::put('/motors/{motor}', 'CatalogosController@update_motor'); //validacion edicion de motor

       //eliminar    
    Route::get('/eliminar_motor/{motor}', 'CatalogosController@eliminar_motor');


  Route::get('api/resultado_motors', function () {
        $data = request()->all();

      return datatables()
            ->eloquent(motor::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('nombre', 'like', "%" . request('search')['value'] . "%");
                    
                }
                

            })
            ->toJson();
    });




////////////////////////////////////////productos//////////////////

     Route::get('/productos', 'CatalogosController@index_producto')
    ->name('productos.index');


       //nuevo
    Route::get('/productos/nuevo', 'CatalogosController@create_producto') //crear nuevo producto
        ->name('productos.create');
    Route::POST('/productos/crear', 'CatalogosController@store_producto') //validacion creacion de nuevo producto
        ->name('productos.crear');

        //editar
    Route::get('/productos/{producto}/editar', 'CatalogosController@edit_producto') //editar producto
        ->name('productos.edit');
    Route::put('/productos/{producto}', 'CatalogosController@update_producto'); //validacion edicion de producto

       //eliminar    
    Route::get('/eliminar_producto/{producto}', 'CatalogosController@eliminar_producto');

    /*
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

            $model = App\Producto::with('posts');

            return DataTables::eloquent($model)
                        ->addColumn('posts', function (User $user) {
                            return $user->posts->map(function($post) {
                                return str_limit($post->title, 30, '...');
                            })->implode('<br>');
                        })
                        ->toJson();


        });



        
/////////////////////////////////modal_imagen///////////////////////////////////////

Route::get('/modal_imagen/{producto}/', 'HomeController@modal_imagen') 
        ->name('modal.imagen');

Route::POST('/cambio_imagen_modal/{producto}/', 'HomeController@cambio_imagen_modal') 
        ->name('modal.cambio');


///////////////////////////////busqueda///////////////////////////////////////////
Route::get('/buscar/', 'HomeController@buscar') 
        ->name('busqueda.predictiva');

/////////////session de lo que tiene en la cesta cada usuario/////////////////////
Route::POST('/session_producto/', 'HomeController@session_producto') 
        ->name('session.producto');


/*
Route::get('/perfiles', 'CatalogosController@index_perfil')
    ->name('perfiles.index');
*/

///////////////////////////////////////////////////////////////////////////////////////



    //Autenticacion
    Auth::routes();

    //resultados para la tabla
    //https://yajrabox.com/docs/laravel-datatables/master/engine-eloquent 
    Route::get('api/midatatable', function () {
        $data = request()->all();


      return datatables()
            ->eloquent(App\User::query())
            ->filter(function ($query) {
                $cadena = request('search')['value'];                
                if ($cadena!='') {
                    $query->where('name', 'like', "%" . request('search')['value'] . "%");
                    $query->orWhere('email', 'like', "%" . request('search')['value'] . "%");
                }
                

            })
            ->toJson();
    });





   


    //use Illuminate\Support\Facades\Storage;


    //resultados para idioma de aplicacion
    Route::POST('idioma', function () {
        //$url = Storage::disk('local');

        //$url = "https://raw.githubusercontent.com/jpatokal/openflights/master/data/airports.dat";

        //$data = file_get_contents( resource_path('views/inicio.blade.php') );

        $data = file_get_contents( resource_path('lang/es/aplicacion.json') );
        
        $data=str_replace('=>',":",$data);

        $data=str_replace('<?php return',"",$data);

        $data=str_replace(']',"}",$data);
        $data=str_replace('[',"{",$data);
        $data=str_replace(';',"",$data);
        $data=str_replace('n',"",$data);
        
        $url = '{"a":1,"b":2,"c":3,"d":4,"e":5}';


        //dd(  json_encode( $data,true )  ) ;
        //resources/lang/es
        //$url = "https://raw.githubusercontent.com/jpatokal/openflights/master/data/airports.dat";
        //$url = Storage::files(  asset('storage/') );
        

        //
        //$products = json_decode($data, true);
        return $data;
        return  json_encode( (string)$url,true);  
      //return datatables()->eloquent(App\User::query())->toJson();
    })->where([ 
        'lang' => 'en|es'  //
    ]);







});	 

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/