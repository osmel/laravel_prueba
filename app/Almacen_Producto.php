<?php

namespace App;

use App\Producto;
use App\Almacen;
use Illuminate\Database\Eloquent\Model;

class Almacen_Producto extends Model
{
    //

    
    protected $table = 'almacen_producto';



 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producto_id','almacen_id', 'precio', 'cantidad',
    							//precio y cantidad, para q pueda existir el mismo producto, pero con diferentes precio, y por consecuencias, diferentes cantidades
    ];


    public function producto()   { 
        return $this->belongsTo(Producto::class); 
        //return $this->hasMany(Producto::class); 
    }

    public function almacen()   { 
        return $this->belongsTo(Almacen::class); 
        //return $this->hasMany(Producto::class); 
    }



//
}
