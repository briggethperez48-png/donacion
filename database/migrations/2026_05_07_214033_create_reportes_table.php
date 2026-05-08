<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $blueprint) {
            $blueprint->increments('id');

            $blueprint->integer('EstadoID')->unsigned();
            $blueprint->integer('MunicipioID')->unsigned();
            
            $blueprint->string('Estado');
            $blueprint->string('Municipio');

            $blueprint->string('Clave'); 
            
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
