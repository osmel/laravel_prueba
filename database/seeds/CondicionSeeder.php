<?php

use App\Condicion; 
use Illuminate\Database\Seeder;

class CondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

		//foreach (range(1,1) as $index) {
	        /*
	        Condicion::create([
	        	'promocion_id'=>1,
	        	'campo'=>'almacen',
	        	'campo_id'=>1,
	        ]);

	        Condicion::create([
	        	'promocion_id'=>1,
	        	'campo'=>'almacen',
	        	'campo_id'=>2,
	        ]);

	        Condicion::create([
	        	'promocion_id'=>1,
	        	'campo'=>'fabricante',
	        	'campo_id'=>1,
	        ]);
	        */

	        Condicion::create([
	        	'promocion_id'=>2,
	        	'campo'=>'fabricante',
	        	'campo_id'=>1,
	        ]);


		//};  

        
    }
}
