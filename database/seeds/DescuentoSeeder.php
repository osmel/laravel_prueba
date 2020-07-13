<?php

use App\Descuento; 
use Illuminate\Database\Seeder;

class DescuentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,10) as $index) {
	        Descuento::create([
	            'nombre'=>'descuento'.$index,
	            'valor'=>$index+100
	        ]);
		};          
    }
}
