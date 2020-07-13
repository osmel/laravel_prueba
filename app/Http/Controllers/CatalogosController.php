<?php

namespace App\Http\Controllers;

use App\Role as perfil; //modelo User del ORM eloquent

use App\Marca;
use App\Modelo;

use App\Almacen;
use App\Variacion;
use App\Categoria;

use App\Fabricante;
use App\Motor;

use App\Producto;




use Illuminate\Support\Facades\DB;  //para usar DB, para consultas nativas y constructor laravel

use App\Http\Servicios\NotificacionesInterface as NotificacionesInterface;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;


class CatalogosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //Sin importar cómo se resuelva esta inyección de dependencias, $miclase debe ser capaz de usar los métodos que dicta la interfaz.
    public function __construct(NotificacionesInterface $miclase)
    {
       
        //cuando trata de entrar en esta clase sino esta logueado lo redirecciona a login
        $this->middleware('auth');  
        $this->middleware('EsAdmin');  

    }


    //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de perfiles//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla perfiles
    public function index_perfil() {
        $perfiles= Perfil::all()->take(10); 
        return view('catalogos.perfiles.perfiles',['title'=>'Listado de perfiles','perfiles'=>$perfiles]); 
    }
 
    //Crear un nuevo perfil
    public function create_perfil() { //motrar el formulario
        return view('catalogos.perfiles.create');
    }

    
    //validacion creacion de nuevo perfil
    public function store_perfil() { //procesar el formulario
        $data = request()->validate([
            'nombre_rol' => 'required',
        ], [
            'nombre_rol.required' => 'El campo nombre es obligatorio',
        ]);
        Perfil::create([  //creando o insertando un registro en perfil
            'nombre_rol' => $data['nombre_rol'],
        ]);
        return redirect()->route('perfiles.index'); //redirigiendo a 
    }


    //editar perfil
    public function edit_perfil(Perfil $perfil) {
        return view('catalogos.perfiles.edit', ['perfil' => $perfil]);
    }

    //validacion de edicion de perfiles
    public function update_perfil(Perfil $perfil){
        $data = request()->validate([
            'nombre_rol' => 'required',
        ]);

        $data['nombre_rol'] = $data['nombre_rol'];

        $perfil->update($data);
        return redirect()->route('perfiles.index'); 
    }

  
    function eliminar_perfil(Perfil $perfil){
        $perfil->delete();
        return redirect()->route('perfiles.index'); 
    }


//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de marcas//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla marcas
    public function index_marca() {
        $marcas= Marca::all()->take(10); 
        return view('nomencladores.marcas.marcas',['title'=>'Listado de marcas','marcas'=>$marcas]); 
    }
 
    //Crear un nuevo marca
    public function create_marca() { //motrar el formulario
        return view('nomencladores.marcas.create');
    }

    
    //validacion creacion de nuevo marca
    public function store_marca() { //procesar el formulario
        $data = request()->validate([
            'nombre_rol' => 'required',
        ], [
            'nombre_rol.required' => 'El campo nombre es obligatorio',
        ]);
        Marca::create([  //creando o insertando un registro en marca
            'nombre_rol' => $data['nombre_rol'],
        ]);
        return redirect()->route('marcas.index'); //redirigiendo a 
    }


    //editar marca
    public function edit_marca(marca $marca) {
        return view('nomencladores.marcas.edit', ['marca' => $marca]);
    }

    //validacion de edicion de marcas
    public function update_marca(marca $marca){
        $data = request()->validate([
            'nombre_rol' => 'required',
        ]);

        $data['nombre_rol'] = $data['nombre_rol'];

        $marca->update($data);
        return redirect()->route('marcas.index'); 
    }

  
    function eliminar_marca(marca $marca){
        $marca->delete();
        return redirect()->route('marcas.index'); 
    }




//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de modelos//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla modelos
    public function index_modelo() {
        $modelos= Modelo::all()->take(10); 
        return view('nomencladores.modelos.modelos',['title'=>'Listado de modelos','modelos'=>$modelos]); 
    }
 
    //Crear un nuevo modelo
    public function create_modelo() { //motrar el formulario
        return view('nomencladores.modelos.create');
    }

    
    //validacion creacion de nuevo modelo
    public function store_modelo() { //procesar el formulario
        $data = request()->validate([
            'nombre_rol' => 'required',
        ], [
            'nombre_rol.required' => 'El campo nombre es obligatorio',
        ]);
        Modelo::create([  //creando o insertando un registro en modelo
            'nombre_rol' => $data['nombre_rol'],
        ]);
        return redirect()->route('modelos.index'); //redirigiendo a 
    }


    //editar modelo
    public function edit_modelo(modelo $modelo) {
        return view('nomencladores.modelos.edit', ['modelo' => $modelo]);
    }

    //validacion de edicion de modelos
    public function update_modelo(modelo $modelo){
        $data = request()->validate([
            'nombre_rol' => 'required',
        ]);

        $data['nombre_rol'] = $data['nombre_rol'];

        $modelo->update($data);
        return redirect()->route('modelos.index'); 
    }

  
    function eliminar_modelo(modelo $modelo){
        $modelo->delete();
        return redirect()->route('modelos.index'); 
    }



//////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de almacens//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla almacens
    public function index_almacen() {
        $almacens= almacen::all()->take(10); 
        return view('nomencladores.almacens.almacens',['title'=>'Listado de almacens','almacens'=>$almacens]); 
    }
 
    //Crear un nuevo almacen
    public function create_almacen() { //motrar el formulario
        return view('nomencladores.almacens.create');
    }

    
    //validacion creacion de nuevo almacen
    public function store_almacen() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        almacen::create([  //creando o insertando un registro en almacen
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('almacens.index'); //redirigiendo a 
    }


    //editar almacen
    public function edit_almacen(almacen $almacen) {
        return view('nomencladores.almacens.edit', ['almacen' => $almacen]);
    }

    //validacion de edicion de almacens
    public function update_almacen(almacen $almacen){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $almacen->update($data);
        return redirect()->route('almacens.index'); 
    }

  
    function eliminar_almacen(almacen $almacen){
        $almacen->delete();
        return redirect()->route('almacens.index'); 
    }



 //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de variacions//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla variacions
    public function index_variacion() {
        $variacions= variacion::all()->take(10); 
        return view('nomencladores.variacions.variacions',['title'=>'Listado de variacions','variacions'=>$variacions]); 
    }
 
    //Crear un nuevo variacion
    public function create_variacion() { //motrar el formulario
        return view('nomencladores.variacions.create');
    }

    
    //validacion creacion de nuevo variacion
    public function store_variacion() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        variacion::create([  //creando o insertando un registro en variacion
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('variacions.index'); //redirigiendo a 
    }


    //editar variacion
    public function edit_variacion(variacion $variacion) {
        return view('nomencladores.variacions.edit', ['variacion' => $variacion]);
    }

    //validacion de edicion de variacions
    public function update_variacion(variacion $variacion){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $variacion->update($data);
        return redirect()->route('variacions.index'); 
    }

  
    function eliminar_variacion(variacion $variacion){
        $variacion->delete();
        return redirect()->route('variacions.index'); 
    }



 //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de categorias//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla categorias
    public function index_categoria() {
        $categorias= categoria::all()->take(10); 
        return view('nomencladores.categorias.categorias',['title'=>'Listado de categorias','categorias'=>$categorias]); 
    }
 
    //Crear un nuevo categoria
    public function create_categoria() { //motrar el formulario
        return view('nomencladores.categorias.create');
    }

    
    //validacion creacion de nuevo categoria
    public function store_categoria() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        categoria::create([  //creando o insertando un registro en categoria
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('categorias.index'); //redirigiendo a 
    }


    //editar categoria
    public function edit_categoria(categoria $categoria) {
        return view('nomencladores.categorias.edit', ['categoria' => $categoria]);
    }

    //validacion de edicion de categorias
    public function update_categoria(categoria $categoria){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $categoria->update($data);
        return redirect()->route('categorias.index'); 
    }

  
    function eliminar_categoria(categoria $categoria){
        $categoria->delete();
        return redirect()->route('categorias.index'); 
    }





 //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de fabricantes//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla fabricantes
    public function index_fabricante() {
        $fabricantes= fabricante::all()->take(10); 
        return view('nomencladores.fabricantes.fabricantes',['title'=>'Listado de fabricantes','fabricantes'=>$fabricantes]); 
    }
 
    //Crear un nuevo fabricante
    public function create_fabricante() { //motrar el formulario
        return view('nomencladores.fabricantes.create');
    }

    
    //validacion creacion de nuevo fabricante
    public function store_fabricante() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        fabricante::create([  //creando o insertando un registro en fabricante
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('fabricantes.index'); //redirigiendo a 
    }


    //editar fabricante
    public function edit_fabricante(fabricante $fabricante) {
        return view('nomencladores.fabricantes.edit', ['fabricante' => $fabricante]);
    }

    //validacion de edicion de fabricantes
    public function update_fabricante(fabricante $fabricante){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $fabricante->update($data);
        return redirect()->route('fabricantes.index'); 
    }

  
    function eliminar_fabricante(fabricante $fabricante){
        $fabricante->delete();
        return redirect()->route('fabricantes.index'); 
    }





 //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de motores//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla motors
    public function index_motor() {
        $motors= motor::all()->take(10); 
        return view('nomencladores.motors.motors',['title'=>'Listado de motors','motors'=>$motors]); 
    }
 
    //Crear un nuevo motor
    public function create_motor() { //motrar el formulario
        return view('nomencladores.motors.create');
    }

    
    //validacion creacion de nuevo motor
    public function store_motor() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        motor::create([  //creando o insertando un registro en motor
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('motors.index'); //redirigiendo a 
    }


    //editar motor
    public function edit_motor(motor $motor) {
        return view('nomencladores.motors.edit', ['motor' => $motor]);
    }

    //validacion de edicion de motors
    public function update_motor(motor $motor){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $motor->update($data);
        return redirect()->route('motors.index'); 
    }

  
    function eliminar_motor(motor $motor){
        $motor->delete();
        return redirect()->route('motors.index'); 
    }





 //////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////Gestion de productos//////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////

    //listado de tabla productos
    public function index_producto() {
        $productos= producto::all()->take(10); 
        return view('nomencladores.productos.productos',['title'=>'Listado de productos','productos'=>$productos]); 
    }
 
    //Crear un nuevo producto
    public function create_producto() { //motrar el formulario
        return view('nomencladores.productos.create');
    }

    
    //validacion creacion de nuevo producto
    public function store_producto() { //procesar el formulario
        $data = request()->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
        ]);
        producto::create([  //creando o insertando un registro en producto
            'nombre' => $data['nombre'],
        ]);
        return redirect()->route('productos.index'); //redirigiendo a 
    }


    //editar producto
    public function edit_producto(producto $producto) {
        return view('nomencladores.productos.edit', ['producto' => $producto]);
    }

    //validacion de edicion de productos
    public function update_producto(producto $producto){
        $data = request()->validate([
            'nombre' => 'required',
        ]);

        $data['nombre'] = $data['nombre'];

        $producto->update($data);
        return redirect()->route('productos.index'); 
    }

  
    function eliminar_producto(producto $producto){
        $producto->delete();
        return redirect()->route('productos.index'); 
    }





}
