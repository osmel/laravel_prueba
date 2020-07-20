<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoPromocionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_promocions', function (Blueprint $table) {

  
            $table->integer('producto_id')->unsigned();
            $table->integer('promocion_id')->unsigned();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('promocion_id')->references('id')->on('promocions');            


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
        Schema::dropIfExists('producto_promocions');
    }
}
