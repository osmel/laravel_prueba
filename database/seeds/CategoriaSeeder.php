<?php

use App\Categoria; 
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,10) as $index) {
	        Categoria::create([
	            'nombre'=>'categ'.$index
	        ]);
		};   
    }
}
