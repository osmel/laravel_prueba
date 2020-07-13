<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descripcions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre');    
             $table->integer('producto_id')->unsigned();
             $table->foreign('producto_id')->references('id')->on('productos');  //

            
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
        Schema::dropIfExists('descripcions');
    }
}
