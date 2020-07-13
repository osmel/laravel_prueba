<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoVariacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_variacion', function (Blueprint $table) {
            
            $table->integer('producto_id')->unsigned();
            $table->integer('variacion_id')->unsigned();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('variacion_id')->references('id')->on('variacions');
            
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
        Schema::dropIfExists('producto_variacion');
    }
}
