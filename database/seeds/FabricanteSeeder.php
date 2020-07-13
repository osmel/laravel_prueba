<?php

use App\Fabricante; 
use Illuminate\Database\Seeder;

class FabricanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach (range(1,10) as $index) {
	        Fabricante::create([
	            'nombre'=>'fabrica'.$index
	        ]);
		};        
    }
}
