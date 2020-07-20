<?php

namespace App;
Use App\Promocion;

Use App\Almacen;
Use App\Marca;
Use App\Producto;
Use App\Fabricante;

use Illuminate\Database\Eloquent\Model;

class Condicion extends Model
{
    

    protected $fillable = [
        'campo','promocion_id', 'campo_id',  //campo_id -> tiene relacion con el id de "almacen, marca, fabricante, producto"
    ]; 



    public function promocion()   { 
        return $this->belongsTo(Promocion::class);    //1-m
    }



    public function almacen()   { 
        return $this->belongsTo(Almacen::class, 'campo_id' );    //1-m
    }

    public function marca()   { 
        return $this->belongsTo(Marca::class, 'campo_id' );    //1-m
    }

    public function producto()   { 
        return $this->belongsTo(Producto::class, 'campo_id' );    //1-m
    }

    public function fabricante()   { 
        return $this->belongsTo(Fabricante::class, 'campo_id' );    //1-m
    }


  /*
    public function campos()   { 
        return $this->belongsTo(Fabricante::class, 'fabricante_id','id');  // m-1
        return $this->hasMany(Fabricante::class, 'producto_id','id');    //1-m
        return $this->belongsToMany(Variacion::class);    //m-m

    }
    */


}
