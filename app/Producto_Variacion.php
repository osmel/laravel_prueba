<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_Variacion extends Model
{

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'producto_variacion';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'descripcion_id', 'codigo_id','modelo_id','categoria_id','precio',
        'producto_id','variacion_id',
    ]; 
}