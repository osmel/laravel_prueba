<?php

namespace App;

Use App\Condicion;
Use App\Producto;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    

    protected $fillable = [
        'nombre','descuento','fecha_inicio','fecha_fin',
    ]; 



    public function condicions()   { 
        return $this->hasMany(Condicion::class);    //1-m
    }



    public function productos()   { 
        return $this->belongsToMany(Producto::class);    //m-m

    }


    



}
