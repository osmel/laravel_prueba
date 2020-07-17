<?php

namespace App;

use App\Marca;
use App\Variacion;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'nombre', 'motor_id','inicio','final','cilindraje','informacion',
        'nombre', 'informacion','marca_id',

    ];    


    ////belongsTo
    public function marca()   { 
        return $this->belongsTo(Marca::class, 'marca_id','id'); 
        //return $this->hasMany(Fabricante::class, 'producto_id','id'); 
    }       

    public function Variacion()   { 
        //return $this->belongsTo(Modelo::class, 'modelo_id','id'); 
        return $this->hasMany(Variacion::class, 'modelo_id','id'); 
    }   

}
