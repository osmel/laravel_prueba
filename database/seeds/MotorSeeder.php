<?php

use App\Motor; 
use Illuminate\Database\Seeder;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach (range(1,10) as $index) {
	        Motor::create([
	            'nombre'=>'motor'.$index
	        ]);
		};         
    }
}
