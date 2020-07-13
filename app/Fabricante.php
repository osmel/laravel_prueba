<?php

namespace App;
Use App\Producto;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];


    ////belongsTo

    public function productos()   { 
        return $this->hasMany(Producto::class); 
    }    

}
