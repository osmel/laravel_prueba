<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacen_producto', function (Blueprint $table) {
            //$table->id();

            $table->increments('id');
  

             $table->integer('producto_id')->unsigned();  //esto es para registrar, quien es el ultimo usuario q toca el inventario
             $table->foreign('producto_id')->references('id')->on('productos');

  
            //$table->integer('inventario_id')->unsigned();
            $table->integer('almacen_id')->unsigned();

            //$table->foreign('inventario_id')->references('id')->on('inventarios');
            $table->foreign('almacen_id')->references('id')->on('almacens');

            $table->decimal('precio', 8, 2);    
            $table->integer('cantidad'); 



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('almacen_producto');
    }
}
