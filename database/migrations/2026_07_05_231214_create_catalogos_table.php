<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            //Para no tener tantas tablas como en la base anterior, todos los selects se van a juntar en una sola migración
        Schema::create('catalogos', function (Blueprint $table) {
            $table->increments('id_catalogo'); // Llave primaria
            $table->string('tipo')->nullable();            // Campo
            $table->string('valor')->nullable();           // Descripción
            $table->string('hist_valor')->nullable();      // Valor antiguo
            $table->timestamps();
            
            $table->index('tipo'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogos');
    }
}
