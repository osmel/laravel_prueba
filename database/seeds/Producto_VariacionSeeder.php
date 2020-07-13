<?php

use App\Producto_Variacion; 
use Illuminate\Database\Seeder;

class Producto_VariacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,10) as $index) {
	        Producto_Variacion::create([
	            'producto_id'=>$index,
	            'variacion_id'=>$index,
	        ]);
		};   

    }
}
