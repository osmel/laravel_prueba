<?php

use App\Promocion; 
use Illuminate\Database\Seeder;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    		/*
	        Promocion::create([
	        	'nombre'=>"promo1",
	        	'descuento'=>20,
	            'fecha_inicio'=>'2020-07-19',
	            'fecha_fin'=>'2020-07-19',
	        ]);
	        */
		
	        Promocion::create([
	        	'nombre'=>'promo2',
	        	'descuento'=>30,
	            'fecha_inicio'=>'2020-07-19',
	            'fecha_fin'=>'2020-07-19',
	        ]);
		


    }
}
