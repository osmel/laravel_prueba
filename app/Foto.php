<?php

namespace App;

Use App\Producto;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','url','producto_id',
    ];

    /*
    public function producto()   { 
        return $this->belongsTo(Producto::class, 'producto_id','id');  //nombre, url
    }
    */

}
