<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('donantes', function (Blueprint $datoD) {
            $datoD->increments('id');
            $datoD->string('Nombre');
            $datoD->string('ApPaterno');
            $datoD->string('ApMaterno');
            $datoD->string('Sexo');
            $datoD->string('FechaNac');
            $datoD->string('EstCiv');
            $datoD->string('Ocupacion');
            $datoD->string('Estudios');
            $datoD->string('CP');
            $datoD->string('EstadoProc');
            $datoD->string('Alcaldia');
            $datoD->string('Colonia');
            $datoD->string('Calle');    //Respuesta abierta
            $datoD->string('NumExt');
            $datoD->string('NumInt');
            $datoD->string('Telefono');
            $datoD->string('Referencias');
            $datoD->string('Tipo');
            $datoD->string('Fecha');
            $datoD->string('Hora');
            $datoD->string('CURP');
            $datoD->string('estadoNac');
            $datoD->string('Religion');
            $datoD->string('Donador');
            
            // $datoD->string('Organo')
            //     ->nullable();
            // $datoD->string('Pregunta');
            // $datoD->string('Respuesta');

            $datoD->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();
            $datoD->timestamp('created_at')
                ->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donantes');
    }
}
