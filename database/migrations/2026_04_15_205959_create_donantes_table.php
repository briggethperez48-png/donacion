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
            $datoD->string('FechaNac');
            $datoD->string('estadoNac');
            $datoD->string('Ocupacion');
            $datoD->string('EstCiv');
            $datoD->string('Estudios');
            $datoD->string('EstadoProc');
            $datoD->string('Alcaldia');
            $datoD->string('Colonia');
            $datoD->string('Religion');
            $datoD->string('CURP');
            $datoD->string('Sexo');
            $datoD->string('Donador');
            $datoD->string('Organo')
                ->nullable()
                ->change();
            $datoD->string('Referencias');
            $datoD->string('Telefono');
            $datoD->string('Pregunta');
            $datoD->string('Respuesta');
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
