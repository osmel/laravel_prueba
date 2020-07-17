<?php

namespace App;

use App\Almacen;
use App\Producto;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producto_id',   'user_id',  // usuario son de creacion....

    ];  


    public function user()   { 
        return $this->belongsTo(User::class,'user_id','id'); 
    }



    public function almacen() {
        return $this->belongsToMany(Almacen::class);
    }    


///////////////////relacion 1 a 1
//hasOne


	public function producto() {
	  return $this->hasOne(Producto::class);
	}



}
