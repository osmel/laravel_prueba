<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');

            //$table->integer('descripcion_id')->unsigned();
            //$table->integer('foto_id')->unsigned();
            //$table->integer('codigo_id')->unsigned();

            //$table->integer('modelo_id')->unsigned();
            $table->string('surtido', 15); 
            $table->integer('fabricante_id')->unsigned();
            $table->integer('categoria_id')->unsigned();


            //$table->foreign('descripcion_id')->references('id')->on('descripcions');  
            //$table->foreign('foto_id')->references('id')->on('fotos');  //
            //$table->foreign('codigo_id')->references('id')->on('codigos');  //
            //$table->foreign('modelo_id')->references('id')->on('modelos');  
            $table->foreign('fabricante_id')->references('id')->on('fabricantes');  
            $table->foreign('categoria_id')->references('id')->on('categorias');  

            $table->decimal('precio', 8, 2);    

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
        Schema::dropIfExists('productos');
    }
}
