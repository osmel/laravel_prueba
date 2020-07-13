<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
   

        $this->call(RoleSeeder::class); //1

        factory(User::class)->create([ 
                'name'=>'osmel calderon bernal',
                'email'=>'osmel.calderon@gmail.com',
                'role_id'=>'1',
                'password'=>bcrypt('osmel5458'), //encriptarla
        ]); 


        factory(User::class)->create([ 
                'name'=>'jean duvan',
                'email'=>'duvi@gmail.com',
                'role_id'=>'2',
                'password'=>bcrypt('osmel5458'), //encriptarla
        ]); 

        factory(User::class)->create([ 
                'name'=>'alex jhon',
                'email'=>'alex@gmail.com',
                'role_id'=>'2',
                'password'=>bcrypt('osmel5458'), //encriptarla
        ]);         

        factory(User::class,20)->create();

        
        $this->call(AlmacenSeeder::class); //esto es para existencia, "no catalogo"
        $this->call(DescuentoSeeder::class);   //esto es para existencia, "no catalogo"

        //clientes, proveedores
        //registro de existencias
        

        $this->call(FabricanteSeeder::class); //1
        $this->call(CategoriaSeeder::class);  //1
        
        $this->call(MotorSeeder::class);
        $this->call(MarcasSeeder::class); 
        $this->call(ModelosSeeder::class);
        
        $this->call(VariacionSeeder::class);
        $this->call(ProductosSeeder::class); 
        $this->call(Producto_VariacionSeeder::class); //relacion mucho a mucho
        
        
        $this->call(CodigoSeeder::class);  // ultimo
        $this->call(DescripcionSeeder::class); // ultimo
        $this->call(FotoSeeder::class);  // ultimo

    }
}
