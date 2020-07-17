<?php

namespace App;

use App\Producto;
use App\Almacen;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cantidad','precio','almacen_id','producto_id','surtido','user_id', 
    ];


    public function productos()   { 
        return $this->belongsTo(Producto::class, 'producto_id');  ///, 'producto_id','id'
    }   


    public function almacens()   { 
        return $this->belongsTo(Almacen::class, 'almacen_id');  ///, 'producto_id','id'
    }       

    
	public function users() {
         return $this->belongsTo(User::class, 'id');  //,'id'
	}
	


    
}
