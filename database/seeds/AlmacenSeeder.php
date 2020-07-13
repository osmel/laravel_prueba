<?php



use App\Almacen; 
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


		foreach (range(1,10) as $index) {
	        Almacen::create([
	            'nombre'=>'almacen'.$index
	        ]);
		};
			
    	/*
		 	$faker = Faker::create();
		    	foreach (range(1,10) as $index) {
			        DB::table('almacens')->insert([
			            'nombre' => $faker->name,
			            //'email' => $faker->email,
			            //'password' => bcrypt('secret'),
			        ]);
			}

		*/

        //
    	/*
       DB::insert('INSERT INTO professions(title) VALUES (:title)', ['desarrollador'] );


        DB::table('professions')->insert([
        	'title'=>'una'
        ]);

       Book::create([
        	'nombre'=>'almacen1'
        ]);

        DB::table('almacens')->insert([
            'nombre'=>'almacen1'
        ]);

        $factory->defineAs(App\Almacens::class, 'almacens', function ($faker) {
		    return [
		       'nombre'=>'almacen3'
		    ];
		});

        Almacens::create([
            'nombre'=>'almacen4'
        ]);


        */


        //factory(almacens::class,10)->create(); 

        
        //factory(Almacens::class,10)->create(); 

       // $almace = factory(App\Almacens::class, 2)->create();


    }
}
