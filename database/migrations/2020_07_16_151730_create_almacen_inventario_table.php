<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacen_inventario', function (Blueprint $table) {
            //$table->id();

            $table->increments('id');
  
            $table->integer('inventario_id')->unsigned();
            $table->integer('almacen_id')->unsigned();

            $table->foreign('inventario_id')->references('id')->on('inventarios');
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
        Schema::dropIfExists('almacen_inventario');
    }
}
