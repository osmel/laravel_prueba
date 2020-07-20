<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condicions', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('promocion_id')->unsigned();
            $table->foreign('promocion_id')->references('id')->on('promocions');  //

            $table->string('campo', 15);  //almacen, marca, fabricante, producto
            $table->integer('campo_id'); //id del campo


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
        Schema::dropIfExists('condicions');
    }
}
