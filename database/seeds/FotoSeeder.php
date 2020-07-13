<?php

use App\Foto; 
use Illuminate\Database\Seeder;

class FotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1,10) as $index) {
	        Foto::create([
	            'nombre'=>'foto'.$index,
                'producto_id'=>$index,
	            'url'=>'Pieza '.$index.'.jpg'
	        ]);
		};          
    }
}
