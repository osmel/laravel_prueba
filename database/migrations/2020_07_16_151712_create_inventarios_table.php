<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->increments('id');

            //$table->string('surtido', 15);        

             $table->integer('producto_id')->unsigned();  //esto es para registrar, quien es el ultimo usuario q toca el inventario
             $table->foreign('producto_id')->references('id')->on('productos');


             $table->integer('user_id')->unsigned();  //esto es para registrar, quien es el ultimo usuario q toca el inventario
             $table->foreign('user_id')->references('id')->on('users');



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
        Schema::dropIfExists('inventarios');
    }
}
