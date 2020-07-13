<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variacions', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('nombre');


      
            $table->integer('motor_id')->unsigned();
            $table->foreign('motor_id')->nullable()->references('id')->on('motors');  //crea la referencia
            $table->integer('inicio')->nullable(); 
            $table->integer('final')->nullable(); 
            $table->integer('cilindraje')->nullable(); 

            $table->integer('modelo_id')->unsigned();
            $table->foreign('modelo_id')->references('id')->on('modelos');  

            $table->text('informacion')->nullable(); 
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
        Schema::dropIfExists('variacions');
    }
}
