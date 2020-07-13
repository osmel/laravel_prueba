<?php

use App\Modelo; 
use Illuminate\Database\Seeder;

class ModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,10) as $index) {
	        Modelo::create([
	            'nombre'=>'modelo'.$index,
	            //'motor_id'=>$index,
	            //'inicio'=>2000+$index,
	            //'final'=>2000+$index,
	            //'cilindraje'=>$index+30,
	            'informacion'=>$index,
				'marca_id'=>$index,	            
	        ]);
		};   
        
    }
}
