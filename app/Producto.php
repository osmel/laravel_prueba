<?php

namespace App;

use App\Foto;
use App\Codigo;
use App\Descripcion;

use App\Fabricante;
use App\Categoria;
use App\Variacion;

use App\Modelo; //tabla no relacionada directamente, si indirectamente
use App\Marca; //tabla no relacionada directamente, si indirectamente

use App\Inventario;

use App\Movimiento;
use App\Promocion;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'descripcion_id', 'codigo_id','modelo_id','precio',
        'precio','fabricante_id','categoria_id','surtido',
    ]; 







    public function promocions()   { 
        return $this->belongsToMany(Promocion::class);    //m-m

    }


///////////////////relacion 1 a 1
//hasOne
    
    public function inventario() {
      return $this->hasOne(Inventario::class,'producto_id');
    }
    




    
/*
    public function modelo()   { 
        //return $this->belongsTo(Modelo::class, 'modelo_id','id'); 
        return $this->hasMany(Modelo::class, 'producto_id','id'); 
    }

*/    

    ////belongsTo




    public function fabricante()   { 
        return $this->belongsTo(Fabricante::class, 'fabricante_id','id');  //
        //return $this->hasMany(Fabricante::class, 'producto_id','id'); 
    }

 

    public function categoria()   { 
        return $this->belongsTo(Categoria::class, 'categoria_id','id'); 
        //return $this->hasMany(Categoria::class, 'producto_id','id'); 
    }

    ////hasMany

    public function descripcion()   { 
        //return $this->belongsTo(Descripcion::class, 'descripcion_id','id'); 
        return $this->hasMany(Descripcion::class, 'producto_id','id'); 
    }    

    public function codigo()   { 
        //return $this->belongsTo(Codigo::class, 'codigo_id','id'); 
        return $this->hasMany(Codigo::class, 'producto_id','id'); 
    }


    public function foto()   { 
    	return $this->hasMany(Foto::class, 'producto_id','id'); 
    }


    public function movimientos()   { 
        return $this->hasMany(Movimiento::class);  //'producto_id', , 'id'
    }   

    /////////////// https://desarrolloweb.com/articulos/relaciones-modelos-through.html
    /*esto se aplica por ejemplo para saber el modelo q tiene un producto, q no hay una relacion directa*/
        //return json_encode( Producto::first()->modelo );
        //dd($courses[1]->resources);

    public function modelo() {

        return $this->hasManyThrough(
                
                Modelo::class, // Modelo destino
                Variacion::class, // Modelo intermedio
                
                //Variacion::class, // Modelo intermedio
                
                'id', // Clave foránea en la tabla intermedia
                'id' // Clave foránea en la tabla de destino

                /*
                  'id' // Clave primaria en la tabla de origen
                  'variacion_id' // Clave primaria en la tabla intermedia                
                  */

            );
    }


    public function marca() {

        return $this->hasManyThrough(
                Marca::class, // Modelo destino
                Modelo::class, // Modelo intermedio
                
                
                'id', // Clave foránea en la tabla intermedia
                'id' // Clave foránea en la tabla de destino

                /*
                  'id' // Clave primaria en la tabla de origen
                  'variacion_id' // Clave primaria en la tabla intermedia                
                  */

            );
    }



   ////belongsToMany

    public function variacions() {
        //return 'sad';

    	return $this->belongsToMany(Variacion::class);
	}

    function scopeNombre($query, $busq) //$query es el scope q se envia desde el controlador
    {
        //if (trim($busqueda)!="") 
        {


          $query->where('nombre', 'LIKE', '%'.$busq.'%')
             ->orWhere('nombre', 'LIKE', '%'.$busq.'%');


             /*
            $posts = Producto::with('variacions')->whereHas('variacions', function($q) use ($busqueda)
            {
                $q->variacions($busqueda);

            })->get();
            */

            /*
            return request('busqueda')[0];
            
            $posts = $this->whereHas('variacions', function ($query) { //todos los post q contengan al menos un comentario
                return request('busqueda');
                $query->where('fabricante_id', "LIKE", "%".$busqueda."%");   // // Recupere todos los post con al menos un 
                                                                //comentario que contenga palabras como foo%
            })->get();  
            */


            
        }
    }



/*

//$query->where("nombre",$nombre);
            //$query->where(\DB::raw("CONCAT(nombre,' ', apellidos)"),$name);
            //$query->where(\DB::raw("CONCAT(nombre,' ', apellidos)"),"LIKE", "%$name%");



//resultados para la tabla
    https://yajrabox.com/docs/laravel-datatables/master/manual-search
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

*/





}
