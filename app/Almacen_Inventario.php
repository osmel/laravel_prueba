<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen_Inventario extends Model
{
    //

    
    protected $table = 'almacen_inventario';



 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventario_id','almacen_id', 'precio', 'cantidad',
    							//precio y cantidad, para q pueda existir el mismo producto, pero con diferentes precio, y por consecuencias, diferentes cantidades
    ];


//
}
