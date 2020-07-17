<?php

namespace App;

use App\Role;
use App\Movimiento;
Use App\Inventario;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //relacion de "usuario y role", devolviendome todos los campos de la tabla role
    // Puedo acceder ------>  dd($this->role->nombre_rol ); //$this->role->id
    public function role()   { 
        return $this->belongsTo(Role::class); //->withTimestamps();
    }

 
    public function esAdministrador()  {
        
        //this=tabla usuario   dd($this->id);   dd($this->email);
        if ($this->role->nombre_rol=='admin') {
            return true;
        } 
        return false;
    }



    ////belongsTo

    public function inventario()   { 
        return $this->hasMany(Inventario::class); 
    }   


    public function movimientos()   { 
        return $this->hasMany(Movimiento::class);  //'producto_id', , 'id'
    }   



}
