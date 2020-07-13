<?php

use App\Marca;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,10) as $index) {
	        Marca::create([
	            'nombre'=>'marca'.$index,
	            //'modelo_id'=>$index,
	            
	        ]);
		};   
        
    }
}
