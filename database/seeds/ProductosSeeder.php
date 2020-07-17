<?php

use App\Producto; 
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,10) as $index) {
	        Producto::create([
	            //'descripcion_id'=>$index,
	            //'foto_id'=>$index,
	            //'codigo_id'=>$index,
	            //'modelo_id'=>$index,
	            'fabricante_id'=>$index,
	            'categoria_id'=>$index,
	            'precio'=>100+$index,
	            'surtido'=>9000+$index,
	            
	        ]);
		};   
        
    }
}
