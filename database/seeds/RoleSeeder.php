<?php

use App\Role; 
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
	    DB::table('roles')->insert([
            'nombre_rol'=>'admin'
        ]);

    	DB::table('roles')->insert([
            'nombre_rol'=>'Almacenista'
        ]);
        /*
        DB::table('roles')->insert([
            'nombre_rol'=>'usuario'  //cliente q se registra por fuera del sistema
        ]);        
        */
    }
}
