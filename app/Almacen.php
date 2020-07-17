<?php

namespace App;

use App\Inventario;
use Illuminate\Database\Eloquent\Model;



class Almacen extends Model
{
    
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre',
    ];


    public function inventario() {
        return $this->belongsToMany(Inventario::class);
    }



    

}
