<?php

use Illuminate\Database\Seeder;
use App\Variacion; 

class VariacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1,10) as $index) {
	        Variacion::create([
	            'nombre'=>'variacion'.$index,
	            'inicio'=>2000+$index,
	            'final'=>2000+$index,
	            'cilindraje'=>$index+30,
	            'informacion'=>$index,

	            'motor_id'=>$index,
	            'modelo_id'=>$index,

           
	        ]);
		};   
    }
}
