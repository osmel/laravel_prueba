<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');  //

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');  //


            $table->string('surtido', 15);  //no hace falta
            $table->integer('almacen_id')->unsigned();


            $table->decimal('precio', 8, 2);    
            $table->integer('cantidad')->unsigned();



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
        Schema::dropIfExists('movimientos');
    }
}
