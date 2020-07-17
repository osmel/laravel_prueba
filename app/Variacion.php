<?php

namespace App;
use App\Modelo;
use App\Motor;
use App\Producto;

use Illuminate\Database\Eloquent\Model;

class Variacion extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'motor_id','inicio','final','cilindraje','informacion','modelo_id',
    ];   


    ////belongsTo

    public function modelo()   { 
        return $this->belongsTo(Modelo::class, 'modelo_id','id'); 
        //return $this->hasMany(Fabricante::class, 'producto_id','id'); 
    }    

    public function motor()   { 
        return $this->belongsTo(Motor::class, 'motor_id','id'); 
        //return $this->hasMany(Fabricante::class, 'producto_id','id'); 
    }    

    public function producto() {
        //return 'sad';
        return $this->belongsToMany(Producto::class);
    }



    
}
