<?php

use App\Descripcion; 
use Illuminate\Database\Seeder;

class DescripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach (range(1,10) as $index) {
	        Descripcion::create([
	            'nombre'=>'descripcion'.$index,
                'producto_id'=>$index,
	        ]);
		};           
    }
}
