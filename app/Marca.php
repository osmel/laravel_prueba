<?php

namespace App;
use App\Modelo;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', //'modelo_id',
    ];


 	////belongsTo
    public function modelo()   { 
        //return $this->belongsTo(Marca::class, 'marca_id','id'); 
        return $this->hasMany(Modelo::class, 'marca_id','id'); 
    }   

}
