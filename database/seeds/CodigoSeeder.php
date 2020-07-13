<?php

use App\Codigo; 
use Illuminate\Database\Seeder;

class CodigoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,10) as $index) {
	        Codigo::create([
	            'nombre'=>'codigo'.$index,
                'producto_id'=>$index,
	            
	        ]);
		};    
        
    }
}
